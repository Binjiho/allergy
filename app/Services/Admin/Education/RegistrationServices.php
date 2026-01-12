<?php

namespace App\Services\Admin\Education;

use App\Exports\RegistrationExcel;
use App\Services\AppServices;
use App\Services\CommonServices;
use App\Services\MailRealSendServices;
use App\Models\Workshop;
use App\Models\Education;
use App\Models\Registration;
use App\Models\Office;
use App\Models\Hospital;
use Illuminate\Http\Request;
/**
 * Class RegistrationServices
 * @package App\Services
 */
class RegistrationServices extends AppServices
{
    public function __construct()
    {
        /**
         * config
         */
        $this->data['workshopConfig'] = config("site.workshop") ?? [];
    }

    public function indexService(Request $request)
    {
        $registCase = $request->case ?? null;
        $this->data['registCase'] = empty($registCase) ? [] : ['case' => $registCase];

        $this->data['workshop'] = Education::findOrFail($request->wsid);

        $li_page = $request->li_page ?? 20;
        $this->data['li_page'] = $li_page;

        $query = Registration::where(['wsid'=>$request->wsid])->orderByDesc('created_at'); // 삭제 제외 전체

        switch ($registCase) {
            case 'elimination' : // 삭제회원
                $excelName = '삭제list';
                $query->where('del','Y');
                break;
            default :
                $query->where('del','N');
                $excelName = '전체list';
                break;
        }

        if ($request->reg_num) {
            $query->where('reg_num', 'like', "%{$request->reg_num}%");
        }
        if ($request->name_kr) {
            $query->where('name_kr', 'like', "%{$request->name_kr}%");
        }
        if ($request->license_number) {
            $query->where('license_number', 'like', "%{$request->license_number}%");
        }

        if ($request->sosok) {
            $query->where(function ($q) use ($request) {
                $q->where('office_name', 'like', "%{$request->sosok}%")
                    ->orWhere('addr', 'like', "%{$request->sosok}%")
                    ->orWhere('addr_etc', 'like', "%{$request->sosok}%");
            });
        }
        if ($request->gubun) {
            $query->where('gubun', '=', $request->gubun);
        }
        if ($request->email) {
            $query->where('email', 'like', "%{$request->email}%");
        }

        if ($request->phone) {
            $query->where('phone', 'like', "%{$request->phone}%");
        }
        if ($request->member_gubun) {
            $query->where('member_gubun', '=', $request->member_gubun);
        }
        if ($request->pay_method) {
            $query->where('pay_method', '=', $request->pay_method);
        }
        if ($request->pay_status) {
            $query->where('pay_status', '=', $request->pay_status);
        }


        // 엑셀 다운로드 할때
        if ($request->excel) {
            $this->data['total'] = $query->count();
            $this->data['collection'] = $query->lazy();
            $excelName = date('Y-m-d').'_'.$this->data['workshop']->title.'_사전등록_'.$excelName;
            return (new CommonServices())->excelDownload(new RegistrationExcel($this->data), $excelName);
        }

//        // 등록비 카운트
//        $this->data['payStatusSum'] = $query->get(['pay_status','amount'])
//            ->groupBy('pay_status')
//            ->map(fn($group) => $group->sum('amount'));
//        // 전체 금액
//        $this->data['total_amount'] = $query->sum('amount');

//        // 참가구분별 카운트
//        $this->data['gubunCnt'] = $query->get('gubun')->groupBy('gubun')
//            ->map(function ($group) {
//                return $group->count();
//            });
//        // 전체 카운트
//        $this->data['total_cnt'] = $query->count();

        $list = $query->paginate($li_page)->appends($request->query());
        $this->data['list'] = setListSeq($list);

        return $this->data;
    }

    public function upsertService(Request $request)
    {
        $this->data['workshop'] = Education::findOrFail($request->wsid);
        $this->data['wsid'] = $this->data['workshop']->sid;
        
        if(!empty($request->sid)){
            $this->data['reg'] = Registration::findOrFail($request->sid);
            $this->data['member_gubun'] = $this->data['reg']->member_gubun;
        }

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
                return $this->registrationCreate($request);
            case 'registration-update':
                return $this->registrationUpdate($request);
            case 'registration-delete':
                return $this->registrationDelete($request);
            case 'registration-restore':
                return $this->registrationRestore($request);

            case 'db-change':
                return $this->dbChangeServices($request);
            case 'memo-write':
                return $this->memoWrite($request);
            case 'resend-mail':
                return $this->resendMail($request);
            case 'collective-create':
                return $this->collectiveCreateService($request);

            default:
                return NotFoundRedirect();
        }
    }

    private function registrationCreate(Request $request)
    {
        $this->transaction();

        try {
            $reg = new Registration();

            $workshop = Education::findOrFail($request->esid);

            // 현재 워크샵 코드 prefix (예: "CODE-")
            $work_code_prefix = $workshop->code . "-";

            // 가장 큰 번호 가져오기
            $maxRnum = Registration::where('esid', $workshop->sid)
                ->where('rnum', 'LIKE', "{$work_code_prefix}%")
                ->max(\DB::raw("CAST(SUBSTRING(rnum, LENGTH('{$work_code_prefix}') + 1) AS UNSIGNED)"));

            // 다음 번호 계산 (없으면 1부터 시작)
            $nextNumber = ($maxRnum ?? 0) + 1;

            // 자리수 맞춰서 등록번호 생성 (3자리 고정)
            $rnum = $work_code_prefix . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

            // 생성된 regnum을 request에 추가
            $request->merge(['rnum' => $rnum]);
            $request->merge(['code'=>$workshop->code]);

            if($request->amount < 1){
                $request->merge(['pay_status' => 'Y']);
                $request->merge(['pay_confirm_date' => time()]);
            }

            $reg->setByData($request);
            $reg->save(); // created_at만 생성됨

            //신청 완료 메일 발송
            $mailData = [
                'receiver_name' => $reg->name_kr,
                'receiver_email' => $reg->email,
                'body' => view("kr.template.registration-create", ['reg' => $reg])->render(),
                'etc' => null,
            ];

            $mailSubject = "[".env('APP_NAME')."] ".$reg->workshop->title." 사전등록 접수 완료 안내 드립니다. (등록비 입금 요청)";

            $mailResult = (new MailRealSendServices())->mailSendService($mailData, 'registration-create',['subject'=>$mailSubject]);

            if ($mailResult != 'suc') {
                return $mailResult;
            }

            $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - 학술대회 사전등록 생성');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '등록 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);

        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function registrationUpdate(Request $request)
    {
        $this->transaction();

        try {
            $registration = Registration::findOrFail($request->sid);

            $registration->setBydata($request);
            $registration->timestamps = false; // updated_at 자동 업데이트 방지
            $registration->update();

            $this->dbCommit('관리자 - 사전등록 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function registrationDelete(Request $request)
    {
        $this->transaction();

        try {
            $registration = Registration::findOrFail($request->sid);
            $registration->del='Y';
            $registration->deleted_at=date('Y-m-d H:i:s');

            $registration->timestamps = false; // updated_at 자동 업데이트 방지
            $registration->update();

            $this->dbCommit('관리자 - 사전등록 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }

    private function registrationRestore(Request $request)
    {
        $this->transaction();

        try {
            $registration = Registration::findOrFail($request->sid);
            $registration->del='N';
            $registration->deleted_at=null;

            $registration->timestamps = false; // updated_at 자동 업데이트 방지
            $registration->update();

            $this->dbCommit('관리자 - 사전등록 복원');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '복원 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }
    private function dbChangeServices(Request $request)
    {
        $this->transaction();

        try {

            $field = $request->field;
            $value = $request->value;

            $registration = Registration::findOrFail($request->sid);
            $registration->{$field} = $value;

            if($field == 'category'){
                $registration->price = $this->workshopConfig['category'][$value]['price'];
            }

            if($field == 'pay_status'){
                if($value == 'Y'){
                    $registration->pay_confirm_date = time();

                    //입금완료 메일발송
                    $mailData = [
                        'receiver_name' => $registration->name_kr,
                        'receiver_email' => $registration->email,
                        'body' => view("template.registration-ok", ['reg' => $registration])->render(),
                        'etc' => null,
                    ];

                    $mailSubject = "[".env('APP_NAME')."] ".$registration->workshop->title." 사전등록 완료 안내드립니다.";

                    $mailResult = (new MailRealSendServices())->mailSendService($mailData, 'registration-ok',['subject'=>$mailSubject]);

                    if ($mailResult != 'suc') {
                        return $mailResult;
                    }


                }else if($value == 'N'){
                    $registration->pay_confirm_date = null;
                }
            }

            $registration->timestamps = false; // updated_at 자동 업데이트 방지
            $registration->update();

            $this->dbCommit('관리자 - 사전등록 변경');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e,true);
        }
    }

    private function memoWrite(Request $request)
    {
        $this->transaction();

        try {
            $registration = Registration::findOrFail($request->sid);
            $registration->memo = $request->memo;

//            $registration->timestamps = false; // updated_at 자동 업데이트 방지
            $registration->update();

            $this->dbCommit('관리자 - 사전등록 메모 작성');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '저장 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function resendMail(Request $request)
    {
        $this->transaction();

        $reg = Registration::findOrFail($request->sid);

        if(empty($request->email)){
            $email['email'] = $reg->email;
            $email['name_kr'] = $reg->name_kr;
        }else{
            $email['email'] = $request->email;
            $email['name_kr'] = '테스트발송';
        }

        $mailType = $request->mail_type;
        if($mailType == 'ok'){
            $mailSubject = "[".env('APP_NAME')."] ".$reg->workshop->title." 사전등록 완료 안내드립니다.";
        }else{
            $mailSubject = "[".env('APP_NAME')."] ".$reg->workshop->title." 사전등록 접수 완료 안내 드립니다. (등록비 입금 요청)";
        }

        // 메일 한번만 발송
        $mailData = [
            'receiver_name' => $email['name_kr'] ?? '테스트발송',
            'receiver_email' => $email['email'] ?? '',
            'body' => view("template.registration-".$mailType, ['reg'=>$reg ])->render(),
        ];

        $mailResult = (new MailRealSendServices())->mailSendService($mailData, 'registration-'.$mailType,['subject'=>$mailSubject]);

        if ($mailResult != 'suc') {
            return $mailResult;
        }
        // END 메일 발송

        return $this->returnJsonData('alert', [
            'case' => true,
            'msg' => '발송 되었습니다.',
            'winClose' => $this->ajaxActionWinClose(),
        ]);
    }

    private function searchCodeByValue(array $array, string $value): ?string
    {
        $key = array_search($value, $array);
        return $key !== false ? (string)$key : null;
    }
    private function collectiveCreateService(Request $request)
    {
        $this->transaction();

        $userConfig = config('site.user');

        try {
            foreach (json_decode($request->data) ?? [] as $data) {
//                $data->ex_sid = $request->ex_sid;

                $hospital = Hospital::where(['name_kr'=>$data->name_kr,'chief_name'=>$data->chief_name])->first();
                $si = $this->searchCodeByValue($userConfig['si'],$data->si);
                $gu = $this->searchCodeByValue($userConfig['gu'][$si],$data->gu);

                $hospital->gu = $gu;
                $hospital->address = trim($data->address);
                $hospital->update();
//                $executiveDetail->setByData($data);
//                $executiveDetail->save();
            }

            $this->dbCommit('관리자 - hospital 일괄 등록');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => "등록 되었습니다.",
                'winClose' => $this->ajaxActionWinClose(true)
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

}
