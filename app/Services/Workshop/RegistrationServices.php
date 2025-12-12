<?php

namespace App\Services\Workshop;

use App\Services\AppServices;
use App\Services\CommonServices;
use App\Services\MailRealSendServices;
use App\Models\Workshop;
use App\Models\Registration;
use App\Models\Office;
use Illuminate\Http\Request;
/**
 * Class RegistrationServices
 * @package App\Services
 */
class RegistrationServices extends AppServices
{
    // 접근법이 잘못되었을때
    private function isAlreadyRegist(Request $request)
    {
        return errorRedirect('replace', "이미 사전등록을 완료하였습니다.", route('registration',['wsid'=>$request->wsid]));
    }

    // 등록및 수정 기간 아닐때
    private function notPeriod(Request $request)
    {
        return errorRedirect('replace', "It's not the application period", route('workshop.detail',['mode'=>'registration','sid'=>$request->wsid]));
    }

    public function indexService(Request $request)
    {
        $this->data['workshop'] = Workshop::findOrFail($request->wsid);
        if(!empty($request->sid)) {
            $this->data['reg'] = Registration::findOrFail($request->sid);
        }
        $this->data['captcha'] = (new CommonServices())->captchaMakeService();

        //사전등록 기간체크
        $this->data['isRegistDue'] = now() <= $this->data['workshop']->regist_edate && now() >= $this->data['workshop']->regist_sdate;

        return $this->data;
    }

    public function upsertService(Request $request)
    {
        $this->data['workshop'] = Workshop::findOrFail($request->wsid);
        $this->data['wsid'] = $this->data['workshop']->sid;

        if(!empty($request->sid)){
            $this->data['reg'] = Registration::findOrFail($request->sid);
        }

        $this->data['member_gubun'] = $request->member_gubun;

        if($request->mode != 'modify'){
            //사전등록자 인지 체크
            $check = $this->registrationCheck($request);

            if ($check != 'suc') {
                return $check;
            }
        }

        $this->data['captcha'] = (new CommonServices())->captchaMakeService();

        //사전등록 기간체크
        $this->data['isRegistDue'] = now() <= $this->data['workshop']->regist_edate && now() >= $this->data['workshop']->regist_sdate;

        return $this->data;
    }
    
    public function officeSearchService(Request $request)
    {
        $query = Office::orderByDesc('sid');

        if( !empty($request->keyword) ){
            $query->where(function ($q) use ($request) {
                $q->where('office_kr', 'LIKE', "%{$request->keyword}%")
                    ->orWhere('office_zipcode', 'like', "%{$request->keyword}%")
                    ->orWhere('office_addr', 'like', "%{$request->keyword}%");
            });

            $list = $query->paginate(20)->appends($request->query());
            $this->data['list'] = setListSeq($list);
        }


        return $this->data;
    }



    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'registration-create':
                return $this->registrationCreateServices($request);
            case 'registration-complete':
                return $this->registrationCompleteServices($request);
            case 'registration-update':
                return $this->registrationUpdateServices($request);
            case 'registration-search':
                return $this->registrationSearchServices($request);

            case 'email-check':
                return $this->emailCheckServices($request);
            case 'license-check':
                return $this->licenseCheckServices($request);
            case 'captcha-compare':
                return $this->captchaCompareServices($request);

            default:
                return notFoundRedirect();
        }
    }

    private function registrationCreateServices(Request $request)
    {
        $this->transaction();

        try {
            $reg = new Registration();

            // 현재 워크샵 코드 prefix (예: "CODE-")
            $workshop = Workshop::findOrFail($request->wsid);
            $work_code_prefix = $workshop->code . "-R";

            // 가장 큰 번호 가져오기
            $maxRnum = Registration::where('wsid', $workshop->sid)
                ->where('reg_num', 'LIKE', "{$work_code_prefix}%")
                ->max(\DB::raw("CAST(SUBSTRING(reg_num, LENGTH('{$work_code_prefix}') + 1) AS UNSIGNED)"));

            // 다음 번호 계산 (없으면 1부터 시작)
            $nextNumber = ($maxRnum ?? 0) + 1;

            // 자리수 맞춰서 등록번호 생성 (4자리 고정)
            $reg_num = $work_code_prefix . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

            // 생성된 regnum을 request에 추가
            $request->merge(['reg_num' => $reg_num]);

            $reg->setByData($request);
            $reg->save(); // created_at만 생성됨

            $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - 학술대회 사전등록 생성');

            return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('registration.preview',['wsid'=>$reg->wsid,'sid'=>$reg->sid]) ));

        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function registrationCompleteServices(Request $request)
    {
        $this->transaction();

        try {
            $reg = Registration::findOrFail($request->sid);

            $mail_send = $reg->complete; //현재 시점에서는 N

            if($request->pay_method == 'F'){
                $request->merge(['pay_status' => 'Y']);
                $request->merge(['pay_confirm_date' => time()]);
            }

            $reg->setByCompleteData($request);
            $reg->save(); // created_at만 생성됨


            //신청 완료 메일 발송
            if($mail_send != 'Y'){

                if($request->pay_method == 'F'){
                    $mailData = [
                        'receiver_name' => $reg->name_kr,
                        'receiver_email' => $reg->email,
                        'body' => view("template.registration-ok", ['reg' => $reg])->render(),
                        'etc' => null,
                    ];

                    $mailSubject = "[".env('APP_NAME')."] ".$reg->workshop->title." 사전등록이 완료되었습니다.";

                    $mailResult = (new MailRealSendServices())->mailSendService($mailData, 'registration-ok',['subject'=>$mailSubject]);

                    if ($mailResult != 'suc') {
                        return $mailResult;
                    }
                    //완료메일발송
                }else{
                    $mailData = [
                        'receiver_name' => $reg->name_kr,
                        'receiver_email' => $reg->email,
                        'body' => view("template.registration-bank", ['reg' => $reg])->render(),
                        'etc' => null,
                    ];

                    $mailSubject = "[".env('APP_NAME')."] ".$reg->workshop->title." 사전등록 접수 완료 안내 드립니다. (등록비 입금 요청).";

                    $mailResult = (new MailRealSendServices())->mailSendService($mailData, 'registration-bank',['subject'=>$mailSubject]);

                    if ($mailResult != 'suc') {
                        return $mailResult;
                    }
                    //완료메일발송
                }

            }

            $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - 학술대회 사전등록 완료');

            return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('registration.complete',['wsid'=>$reg->wsid,'sid'=>$reg->sid]) ));

        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function registrationUpdateServices(Request $request)
    {
        $this->transaction();

        try {
            $reg = Registration::findOrFail($request->sid);

            $reg->setByData($request);
            $reg->update(); // created_at만 생성됨

            $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - 학술대회 사전등록 수정');


            return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('registration.preview',['wsid'=>$reg->wsid,'sid'=>$reg->sid]) ));

        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function registrationSearchServices(Request $request)
    {
        $reg = Registration::where(['wsid'=>$request->wsid,'name_kr' => trim($request->name_kr), 'email' => trim($request->email), 'del'=>'N', 'complete'=>'Y'])->first();

        if (empty($reg)) {
            return $this->returnJsonData('alert', [
                'msg' => '일치하는 정보가 없습니다. 조회 조건 다시 확인해주세요.',
            ]);
        } else {
            return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('registration.search_result',['wsid'=>$reg->wsid,'sid'=>$reg->sid]) ));
        }
    }

    // 사전등록이 없다면 접수 가능여부 체크 && 사전등록이 있다면 수정 or preview 페이지 접근가능 여부 체크
    private function registrationCheck(Request $request)
    {
        if (isDev()) { // 개발자 패스
//            return 'suc';
        }

        if ( !empty(thisPK()) && thisPK() > 0 ) {

            // 이미 등록된 사전등록이 있다면 (사전등록은 한번만)
            $userRegistration = Registration::where(['usid'=>thisPK(),'wsid'=>$request->wsid, 'del'=>'N'])->first();

            if ($userRegistration) {
                if ($userRegistration->complete == 'Y') {
                    return $this->isAlreadyRegist($request);
                }
            }
        }

        return 'suc';
    }

    private function registrationPeriodCheck(Request $request)
    {
        if (isDev()) { // 개발자 패스
//            return 'suc';
        }

        if ( \Carbon\Carbon::parse($request->regist_edate) ) {

            return $this->notPeriod($request);
        }

        return 'suc';
    }


    private function emailCheckServices(Request $request)
    {
        $reg_chk = Registration::where(['email' => trim($request->email), 'del'=>'N','complete'=>'Y', 'wsid'=>$request->wsid])->exists();

        if ($reg_chk) {
            $this->setJsonData('focus', '#email');

            return $this->returnJsonData('alert', [
                'msg' => '사용중인 E-Mail입니다. 다른 E-Mail을 입력해주세요.',
            ]);
        } else {
            $this->setJsonData('data', [
                $this->ajaxActionData('#email', 'chk', 'Y'),
            ]);

            return $this->returnJsonData('alert', [
                'msg' => '사용가능한 E-Mail 입니다.',
            ]);
        }
    }
    private function licenseCheckServices(Request $request)
    {
        $reg_chk = Registration::where(['license_number' => trim($request->license_number), 'del'=>'N','complete'=>'Y', 'wsid'=>$request->wsid])->exists();

        if ($reg_chk) {
            $this->setJsonData('focus', '#license_number');

            return $this->returnJsonData('alert', [
                'msg' => '사용중인 의사면허번호 입니다. 다른 의사면허번호을 입력해주세요.',
            ]);
        } else {
            $this->setJsonData('data', [
                $this->ajaxActionData('#license_number', 'chk', 'Y'),
            ]);

            return $this->returnJsonData('alert', [
                'msg' => '사용가능한 의사면허번호 입니다.',
            ]);
        }
    }

    private function captchaCompareServices(Request $request)
    {
        if($request->captcha_input === session('captcha')){
            $this->setJsonData('log', 'suc');

            $this->setJsonData('data', [
                $this->ajaxActionData('#captcha_input', 'chk', 'Y'),
                'log' => 'suc',
            ]);

            return $this->returnJson();
        }
        $this->setJsonData('data', [
            $this->ajaxActionData('#captcha_input', 'chk', 'N'),
            'log' => 'fail',
        ]);

        return $this->returnJson();
    }
}
