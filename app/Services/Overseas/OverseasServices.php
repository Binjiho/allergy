<?php

namespace App\Services\Overseas;

use App\Services\AppServices;
use App\Models\OverseasSetting;
use App\Models\OverseasApply;
use App\Models\Grantees;
use App\Models\User;
use App\Services\MailRealSendServices;

use Illuminate\Http\Request;

/**
 * Class OverseasServices
 * @package App\Services
 */
class OverseasServices extends AppServices
{
    // 선정인원 limit넘을때
    private function isLimit(Request $request)
    {
        $overseasSetting = OverseasSetting::findOrFail($request->o_sid);

        $limit_person = $overseasSetting->limit_person;
        if($request->sid){
            $overseas_cnt = OverseasApply::where(['del'=>'N', 'o_sid'=>$request->o_sid])->whereNotIn('sid',[$request->sid])->count();
        }else{
            $overseas_cnt = OverseasApply::where(['del'=>'N', 'o_sid'=>$request->o_sid])->count();
        }


        if($limit_person <= $overseas_cnt){
            return errorRedirect('replace', "신청 제한 인원이 마감되었습니다.", route('overseas'));
        }

        return 'suc';
    }

    // 이미 등록되어있을때
    private function isAlreadyRegist(Request $request)
    {
        if($request->sid){
            $overseas = OverseasApply::where(['del'=>'N','user_sid'=>thisPK(), 'o_sid'=>$request->o_sid])->whereNotIn('sid',[$request->sid])->first();
        }else{
            $overseas = OverseasApply::where(['del'=>'N','user_sid'=>thisPK(), 'o_sid'=>$request->o_sid])->first();
        }

        if(!empty($overseas)){
            return errorRedirect('replace', "이미 신청하신 내역이 있습니다. [신청내역 확인 및 결과보고] 메뉴에서 확인해 주세요.", route('overseas'));
        }

        return 'suc';
    }

    // 정회원이 아닐때
    private function notLevel()
    {
//        if(isAdmin()){
//            return 'suc';
//        }
        if(thisLevel() === 'A'){
            return 'suc';
        }

        return errorRedirect('replace', "정회원만 신청 가능합니다. 정회원이신 경우 사무국으로 문의해 주세요.", route('overseas'));
    }

    // 등록및 수정 기간 아닐때
    private function notPeriod($o_sid)
    {
        if(masterIp()){
            return 'suc';
        }

        $overseasSetting = OverseasSetting::findOrFail($o_sid);

        $now = \Carbon\Carbon::now();
        $sdate = \Carbon\Carbon::parse($overseasSetting->regist_sdate);
        $edate = \Carbon\Carbon::parse($overseasSetting->regist_edate);

        // 2. 시작일보다 이전인 경우
        if ($now->lessThan($sdate)) {
            return errorRedirect('replace', "사전등록 기간이 아닙니다.", route('overseas'));
        }

        // 현재 시간이 종료일보다 크면(지났으면) 에러 리다이렉트
        if ($now->greaterThan($edate)) {
            return errorRedirect('replace', "사전등록 기간이 마감되었습니다.", route('overseas'));
        }

        return 'suc';
    }

    public function indexService(Request $request)
    {
        $today = date('Y-m-d'); // 오늘 날짜

        //진행중인 행사
        $ing_query = OverseasSetting::where(['del'=>'N'])->orderByDesc('regist_sdate');

        if (!isAdmin()) {
            $ing_query->where('hide', 'N');
        }

        $ing_query->where(function($q) use ($today) {
            // regist_edate가 NULL인 경우 → 시작일 ≤ 오늘 ≤ 종료일
            $q->where(function($sub) use ($today) {
                $sub->whereNotNull('regist_edate')
                    ->whereDate('regist_edate', '>=', $today);
            })
                // regist_edate가 NULL이 아닌 경우 → 시작일 == 오늘
                ->orWhere(function($sub) use ($today) {
                    $sub->whereNull('regist_edate')
                        ->whereDate('regist_sdate', '>=', $today);
                });
        });

        $this->data['ing_list'] = (clone $ing_query)->limit(6)->get();
        $this->data['overseasSetting'] = $this->data['ing_list']->first();

        //완료된 행사
        $query = OverseasSetting::where(['del'=>'N'])->orderByDesc('regist_sdate');

        if (!isAdmin()) {
            $query->where('hide', 'N');
        }

        $query->where(function($q) use ($today) {
            $q->where(function($sub) use ($today) {
                $sub->whereNull('regist_edate')
                    ->whereDate('regist_sdate', '<', $today);
            })
                ->orWhere(function($sub) use ($today) {
                    $sub->whereNotNull('regist_edate')
                        ->whereDate('regist_edate', '<', $today);
                });
        });

        $list = $query->paginate(4)->appends(request()->except(['page']));
        $this->data['list'] = setListSeq($list);

        return $this->data;
    }

    public function upsertService(Request $request)
    {
        $this->notLevel();
        $this->notPeriod($request->o_sid);
        $this->isAlreadyRegist($request);
        $this->isLimit($request);

        $this->data['step'] = $request->step;
        $this->data['overseasSetting'] = OverseasSetting::findOrFail($request->o_sid);

        if($request->sid){
            $this->data['overseas'] = OverseasApply::findOrFail($request->sid);
        }
        return $this->data;
    }

    public function modifyService(Request $request)
    {
        $this->data['step'] = $request->step;
        $this->data['overseasSetting'] = OverseasSetting::findOrFail($request->o_sid);

        if($request->sid){
            $this->data['overseas'] = OverseasApply::findOrFail($request->sid);
        }
        return $this->data;
    }

    public function previewService(Request $request)
    {
        $today = date('Y-m-d'); // 오늘 날짜

        //진행중인 행사
        $ing_query = OverseasSetting::where(['del'=>'N'])->orderByDesc('regist_sdate');

        if (!isAdmin()) {
            $ing_query->where('hide', 'N');
        }

        $ing_query->where(function($q) use ($today) {
            // regist_edate가 NULL인 경우 → 시작일 ≤ 오늘 ≤ 종료일
            $q->where(function($sub) use ($today) {
                $sub->whereNotNull('regist_edate')
                    ->whereDate('regist_edate', '>=', $today);
            })
                // regist_edate가 NULL이 아닌 경우 → 시작일 == 오늘
                ->orWhere(function($sub) use ($today) {
                    $sub->whereNull('regist_edate')
                        ->whereDate('regist_sdate', '>=', $today);
                });
        });

        $this->data['ing_list'] = (clone $ing_query)->limit(6)->get();
        $this->data['overseasSetting'] = $this->data['ing_list']->first();

        $this->data['overseas'] = OverseasApply::findOrFail($request->sid);
        return $this->data;
    }

    public function searchService(Request $request)
    {
        $today = date('Y-m-d'); // 오늘 날짜

        //신청한 행사
        $ing_query = OverseasApply::where(['del'=>'N','user_sid'=>thisPK()])->orderByDesc('sid');

        if (!isAdmin()) {
            $ing_query->where('hide', 'N');
        }
        $this->data['ing_list'] = (clone $ing_query)->limit(20)->get();

        //수혜 내역
        $query = Grantees::where(['del'=>'N','license_number'=>thisUser()->license_number])->orderBy('sid');

        if (!isAdmin()) {
            $query->where('hide', 'N');
        }

        $list = $query->paginate(10)->appends(request()->except(['page']));
        $this->data['list'] = setListSeq($list);

        return $this->data;
    }

    public function reportService(Request $request)
    {
        $this->data['overseas'] = OverseasApply::findOrFail($request->sid);
        $this->data['overseasSetting'] = OverseasSetting::findOrFail($this->data['overseas']->o_sid);
        return $this->data;
    }


    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'overseas-step1':
                return $this->step1Services($request);
            case 'overseas-step2':
                return $this->step2Services($request);
            case 'overseas-step3':
                return $this->step3Services($request);
            case 'report-create':
                return $this->reportCreateServices($request);
            case 'report-modify':
                return $this->reportModifyServices($request);
            case 'get-myInfo':
                return $this->getInfoServices($request);
            default:
                return NotFoundRedirect();
        }
    }

    private function step1Services(Request $request)
    {
        $this->transaction();

        try {
            if(!empty($request->sid)){
                $overseas = OverseasApply::findOrFail($request->sid);
            }else{
                $overseas = new OverseasApply();

                $overseas->setByStep1($request);
                $overseas->save(); // created_at만 생성됨
            }

            if($request->modify == 'Y'){

                $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - 국외학술지원 step1 수정');

                return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('overseas.modify',['step'=>'2','sid'=>$overseas->sid, 'o_sid'=>$overseas->o_sid]) ));

            }else{

                $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - 국외학술지원 step1 생성');

                return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('overseas.upsert',['step'=>'2','sid'=>$overseas->sid, 'o_sid'=>$overseas->o_sid]) ));
            }

        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function step2Services(Request $request)
    {
        $this->transaction();

        try {
            $overseas = OverseasApply::findOrFail($request->sid);

            $overseas->setByStep2($request);
            $overseas->update();

            if($request->imsi == 'Y'){
                $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - 국외학술지원 step2 생성');

                return $this->returnJsonData('alert', [
                    'case' => true,
                    'msg' => '임시 저장 되었습니다.',
                    'location' => $this->ajaxActionLocation('reload'),
                ]);

            }else{

                if($request->modify == 'Y'){

                    $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - 국외학술지원 step2 수정');

                    return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('overseas.modify',['step'=>'3','sid'=>$overseas->sid, 'o_sid'=>$overseas->o_sid]) ));

                }else{

                    $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - 국외학술지원 step2 생성');

                    return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('overseas.upsert',['step'=>'3','sid'=>$overseas->sid, 'o_sid'=>$overseas->o_sid]) ));
                }
            }


        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function step3Services(Request $request)
    {
        $userConfig = config('site.user');

        $this->transaction();

        try {
            $overseas = OverseasApply::findOrFail($request->sid);

            $overseasSetting = OverseasSetting::findOrFail($overseas->o_sid);
            $request->merge(['title' => $overseasSetting->title]);
            $request->merge(['name_kr' => $overseas->user->name_kr]);

            $overseas->setByStep3($request);

            if($request->imsi == 'Y'){
                $overseas->update(); // created_at만 생성됨
                $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - 국외학술지원 step3 생성');

                return $this->returnJsonData('alert', [
                    'case' => true,
                    'msg' => '임시 저장 되었습니다.',
                    'location' => $this->ajaxActionLocation('reload'),
                ]);

            }else{

                if($request->modify == 'Y'){
                    if($overseas->complete != 'Y'){
                        // 메일 발송
                        $mailData = [
                            'receiver_name' => $overseas->user->name_kr,
                            'receiver_email' => $overseas->email,
                            'body' => view("template.overseas-create", ['overseas' => $overseas])->render(),
                        ];

                        $mailSubject = "[".env('APP_NAME')."] ".$overseasSetting->title." 지원 신청이 완료되었습니다.";

                        $mailResult = (new MailRealSendServices())->mailSendService($mailData, 'overseas-create',['subject'=>$mailSubject]);

                        if ($mailResult !== 'suc') {
                            return $mailResult;
                        }
                        // END 회원가입 메일 발송

                        $overseas->complete='Y';
                        $overseas->completed_at=date('Y-m-d H:i:s');
                    }

                    $overseas->update();
                    $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - 국외학술지원 step3 수정');

                    return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('overseas.search') ));

                }else{

                    if($overseas->complete != 'Y') {
                        // 메일 발송
                        $mailData = [
                            'receiver_name' => $overseas->user->name_kr,
                            'receiver_email' => $overseas->email,
                            'body' => view("template.overseas-create", ['overseas' => $overseas])->render(),
                        ];

                        $mailSubject = "[".env('APP_NAME')."] ".$overseasSetting->title." 지원 신청이 완료되었습니다.";

                        $mailResult = (new MailRealSendServices())->mailSendService($mailData, 'overseas-create',['subject'=>$mailSubject]);

                        if ($mailResult !== 'suc') {
                            return $mailResult;
                        }
                        // END 회원가입 메일 발송
                    }

                    $overseas->complete='Y';
                    $overseas->completed_at=date('Y-m-d H:i:s');
                    $overseas->update(); // created_at만 생성됨

                    $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - 국외학술지원 step3 생성');

                    return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('overseas.upsert',['step'=>'4','sid'=>$overseas->sid, 'o_sid'=>$overseas->o_sid]) ));
                }

            }


        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function reportCreateServices(Request $request)
    {
        $this->transaction();

        try {
            $overseas = OverseasApply::findOrFail($request->sid);
            $overseasSetting = OverseasSetting::findOrFail($overseas->o_sid);

            $request->merge(['title' => $overseasSetting->title]);
            $request->merge(['name_kr' => $overseas->user->name_kr]);

            $overseas->setByReport($request);
            $overseas->report = 'Y';
            $overseas->reported_at = date('Y-m-d H:i:s');
            $overseas->update();

            $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - 국외학술지원 결과보고서 생성');

            if($request->imsi == 'Y'){
                return $this->returnJsonData('alert', [
                    'case' => true,
                    'msg' => '임시 저장 되었습니다.',
                    'location' => $this->ajaxActionLocation('reload'),
                ]);
            }

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '신청 완료 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', route('overseas.search') ),
            ]);

        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function reportModifyServices(Request $request)
    {
        $this->transaction();

        try {
            $overseas = OverseasApply::findOrFail($request->sid);
            $overseasSetting = OverseasSetting::findOrFail($overseas->o_sid);

            $request->merge(['title' => $overseasSetting->title]);
            $request->merge(['name_kr' => $overseas->user->name_kr]);

            $overseas->setByReport($request);
            $overseas->update();

            $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - 국외학술지원 결과보고서 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', route('overseas.search') ),
            ]);


        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function getInfoServices(Request $request)
    {
        $this->transaction();

        try {
            $user = User::findOrFail($request->user_sid);

            $sosok_kr = $user->company_kr ?? '';
            $phone = str_replace('-','',$user->phone) ?? '';
            $email = $user->email ?? '';

            $this->setJsonData('input', [
                $this->ajaxActionInput('#register-frm input[name=sosok_kr]', $sosok_kr),
                $this->ajaxActionInput('#register-frm input[name=email]', $email),
                $this->ajaxActionInput('#register-frm input[name=phone]', $phone),
            ]);

            return $this->returnJson();

        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

}
