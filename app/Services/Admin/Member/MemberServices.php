<?php

namespace App\Services\Admin\Member;

use App\Models\User;
use App\Models\Fee;
use App\Exports\MemberExcel;
use App\Services\AppServices;
use App\Services\CommonServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Services\MailRealSendServices;
use Carbon\Carbon;

/**
 * Class MemberServices
 * @package App\Services
 */
class MemberServices extends AppServices
{
    public function indexService(Request $request)
    {
        $li_page = $request->li_page ?? 20;

        $memberCase = $request->case;

        $level = $request->level;
        $confirm = $request->confirm;
        $name_kr = $request->name_kr;
        $id = $request->id;
        $email = $request->email;
        $phone = $request->phone;
        $license_number = $request->license_number;
        $company = $request->company;

        $query = User::where('create_status','Y')->where(['del'=>'N', 'del_request'=>'N'])->orderByDesc('sid'); // 삭제 제외 전체 회원 (승인 & 미승인)

        switch ($memberCase) {
            case 'levelN' : // 대기자(미승인)
                $excelName = '대기자(미승인)';
                $query = User::where('create_status','Y')->where(['del'=>'N', 'del_request'=>'N'])->where('level', 'N')->orderByDesc('created_at');
                break;
            case 'levelA' : // 정회원
                $excelName = '정회원';
                $query = User::where('create_status','Y')->where(['del'=>'N', 'del_request'=>'N'])->where('level', 'A')->orderByDesc('created_at');
                break;
            case 'levelB' : // 준회원
                $excelName = '준회원';
                $query = User::where('create_status','Y')->where(['del'=>'N', 'del_request'=>'N'])->where('level', 'B')->orderByDesc('created_at');
                break;
            case 'levelC' : // 특별회원
                $excelName = '특별회원';
                $query = User::where('create_status','Y')->where(['del'=>'N', 'del_request'=>'N'])->where('level', 'C')->orderByDesc('created_at');
                break;
            case 'levelD' : // 명예회원
                $excelName = '명예회원';
                $query = User::where('create_status','Y')->where(['del'=>'N', 'del_request'=>'N'])->where('level', 'D')->orderByDesc('created_at');
                break;
            case 'withdraw' : // 탈퇴회원
                $excelName = '탈퇴회원';
                $query = User::where('create_status','Y')->where(['del_request'=>'Y','del'=>'N'])->orderByDesc('created_at');
                break;
            case 'elimination' : // 삭제회원
                $excelName = '삭제회원';
                $query = User::onlyTrashed()->where('create_status','Y')->where('del', 'Y')->orderByDesc('created_at');
                break;
            case 'admin' : // 관리자
                $excelName = '관리자';
                $query = User::where('create_status','Y')->where(['del'=>'N', 'del_request'=>'N'])->where('is_admin', 'Y')->orderByDesc('created_at');
                break;
        }

        if ($level) {
            $query->where('level', $level);
        }
        if ($confirm) {
            $query->where('confirm', $confirm);
        }

        if ($name_kr) {
            $query->where(function ($q) use($name_kr) {
                $q->where('name_kr', 'like', "%{$name_kr}%")
                    ->orWhere('first_name', 'like', "%{$name_kr}%")
                    ->orWhere('last_name', 'like', "%{$name_kr}%")
                    ->orWhere('name_han', 'like', "%{$name_kr}%");
            });
        }
        if ($id) {
            $query->where('id', 'like', "%{$id}%");
        }

        if ($email) {
            $query->where('email', 'like', "%{$email}%");
        }
        if ($phone) {
            $query->where(function ($q) use($phone) {
                $q->where('phone', 'like', "%{$phone}%")
                    ->orWhereRaw("REPLACE(phone, '-', '') LIKE ?", ["%" . str_replace('-', '', $phone) . "%"]);
            });
        }

        if ($license_number) {
            $query->where('license_number', 'like', "%{$license_number}%");
        }

        if ($company) {
            $query->where(function ($q) use($company) {
                $q->where('company_kr', 'like', "%{$company}%")
                    ->orWhere('company_en', 'like', "%{$company}%");
            });
        }


        // 엑셀 다운로드 할때
        if ($request->excel) {
            $this->data['total'] = $query->count();
            $this->data['collection'] = $query->lazy();
            return (new CommonServices())->excelDownload(new MemberExcel($this->data), date('Y-m-d').'_'.($excelName ?? '회원정보'));
        }

        $list = $query->paginate($li_page)->appends($request->except(['page']));;
        $this->data['list'] = setListSeq($list);
        $this->data['li_page'] = $li_page;
        $this->data['memberCase'] = empty($memberCase) ? [] : ['case' => $memberCase];

        // 레벨별 카운트
        $this->data['levelCnt'] = User::where('create_status','Y')->get('level')->groupBy('level')
            ->map(function ($group) {
                return $group->count();
            });

        /**
         * 전체회원 : 전체 회원 리스트 입니다. (탈퇴회원 / 삭제회원 제외한 list)
         * 대기자(미승인) : 회원등급이 미승인(대기자)인 list  (탈퇴회원 / 삭제회원 제외)
         * 정회원 : 회원등급이 정회원인 list (탈퇴회원 / 삭제회원 제외)
         * 준회원: 회원등급이 준회원인 list (탈퇴회원 / 삭제회원 제외)
         * 특별회원: 회원등급이 특별회원인 list (탈퇴회원 / 삭제회원 제외)
         * 명예회원: 회원등급이 명예회원인 list (탈퇴회원 / 삭제회원 제외)
         * 탈퇴회원 : 사용자 > 마이페이지 > 회원탈퇴 메뉴에서 탈퇴 완료한 list (del_request = 'Y')
         * 삭제회원 : 관리자 > 회원관리에서 관리자가 직접 삭제한 사용자 list (del = 'Y')
         */

        // 전체 유저 수 카운트
        $this->data['levelCnt']['total'] = User::where('create_status','Y')->count();
        // 탈퇴(요청)회원 카운트
        $this->data['levelCnt']['withdraw'] = User::withTrashed()->where('create_status','Y')->where(['del_request'=>'Y','del'=>'N'])->count();
        // 삭제회원 카운트
        $this->data['levelCnt']['elimination'] = User::withTrashed()->where('create_status','Y')->where(['del'=>'Y'])->count();
        // 어드민회원 카운트
        $this->data['levelCnt']['admin'] = User::withTrashed()->where('create_status','Y')->where(['is_admin'=>'Y'])->count();

        return $this->data;
    }

    public function upsertService(Request $request)
    {
        $this->data['user'] = User::withTrashed()->where('create_status','Y')->findOrFail($request->sid);
        $this->data['captcha'] = (new CommonServices())->captchaMakeService();

        return $this->data;
    }

    public function popupSearchService(Request $request)
    {
        $field = $request->field;
        $keyword = $request->keyword;

        if (!empty($field) && !empty($keyword)) {
            $query = User::where('create_status','Y')->orderByDesc('sid'); // 삭제 제외 전체 회원 (승인 & 미승인)

            switch ($field) {
                case 'id':
                    $query->where('id', 'like', "%{$keyword}%");
                    break;

                case 'name':
                    $query->where(function ($q) use ($keyword) {
                        $q->where('name_kr', 'like', "%{$keyword}%")
                            ->orWhere('name_han', 'like', "%{$keyword}%")
                            ->orWhere('first_name', 'like', "%{$keyword}%")
                            ->orWhere('last_name', 'like', "%{$keyword}%");
                    });
                    break;

                case 'company':
                    $query->where('company', 'like', "%{$keyword}%");
                    $query->where(function ($q) use ($keyword) {
                        $q->where('company_kr', 'like', "%{$keyword}%")
                            ->orWhere('company_en', 'like', "%{$keyword}%");
                    });
                    break;

            }

            $list = $query->paginate(20)->appends($request->except(['page']));;
            $this->data['list'] = setListSeq($list);
        }

        return $this->data;
    }


    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'user-update':
                return $this->userUpdateServices($request);
            case 'user-delete': // 어드민 회원 삭제 처리
                return $this->userDelete($request);
            case 'user-eliminationDelete': // 탈퇴 회원 삭제 처리
                return $this->userEliminationDelete($request);
            case 'user-restore': // 회원 정보 복원 (탈퇴회원)
                return $this->userRestore($request);
            case 'user-login':
                return $this->userLogin($request);
            case 'pw-reset':
                return $this->passwordReset($request);
            case 'change-confirm':
                return $this->changeConfirm($request);
            case 'change-level':
                return $this->changeLevel($request);
            case 'change-isAdmin':
                return $this->changeIsAdmin($request);
            case 'select-member-info':
                return $this->selectMemberInfo($request);
            case 'change-si':
                return $this->changeSi($request);
            default:
                return notFoundRedirect();
        }
    }

    private function userUpdateServices(Request $request)
    {
        $this->transaction();

        try {
            $user = User::findOrFail($request->sid);

            $user->timestamps = false; // updated_at 자동 갱신 비활성화


            $user->setByData($request);

            /**
             * 관리자페이지에서 레벨 변경시 업데이트
             */
            if($user->level != $request->level){
                $user->level = $request->level;
                if($request->confirm =='Y'){
                    $this->feeSetting($user->sid, $request->level);
                }
            }
            if($user->confirm != $request->confirm){
                $user->confirm = $request->confirm;

                if($request->confirm == 'Y'){
                    // 메일 발송
                    $mailData = [
                        'receiver_name' => $user->name_kr ?? '',
                        'receiver_email' => $user->email ?? '',
                        'body' => view("template.user-confirm", ['user' => $user])->render(),
                    ];

                    $mailResult = (new MailRealSendServices())->mailSendService($mailData, 'user-confirm');

                    if ($mailResult != 'suc') {
                        return $mailResult;
                    }
                    // END 메일 발송
                }
            }


            $user->update();

            $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - 회원정보 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '회원정보가 수정 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function userDelete(Request $request)
    {
        $this->transaction();

        try {
            $user = User::findOrFail($request->sid);

            $user->timestamps = false; // updated_at 자동 갱신 비활성화

            $user->delete();

            $this->dbCommit('관리자 - 회원 탈퇴처리');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function userEliminationDelete(Request $request)
    {
        $this->transaction();

        try {
            $user = User::findOrFail($request->sid);
            $user->timestamps = false; // updated_at 자동 갱신 비활성화
            $user->delete();

            $this->dbCommit('관리자 - 회원 삭제처리');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function userRestore(Request $request)
    {
        $this->transaction();

        try {
            $user = User::findOrFail($request->sid);

            $user->timestamps = false; // updated_at 자동 갱신 비활성화
            $user->del_request = 'N';
            $user->del_request_at = null;
            $user->update();

//            Fee::onlyTrashed()->where('user_sid', $user->sid)->restore(); // 회비 복구

            $this->dbCommit('관리자 - 회원 정보복원');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '복원 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function passwordReset(Request $request)
    {
        $this->transaction();

        try {
            $reset_pw = 'allergy1234';

            $user = User::withTrashed()->findOrFail($request->sid);

            $user->timestamps = false; // updated_at 자동 갱신 비활성화
            $user->password = Hash::make($reset_pw);
            $user->update();

            $this->dbCommit('관리자 회원 비밀번호 초기화');

            return $this->returnJsonData('alert', [
                'msg' => "비밀번호 초기화 되었습니다.\n초기화 비밀번호 : {$reset_pw}"
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function changeConfirm(Request $request)
    {
        $this->transaction();

        try {
            $user = User::withTrashed()->findOrFail($request->sid);

            $user->timestamps = false; // updated_at 자동 갱신 비활성화

            $user->confirm = $request->value;
            $user->update();

            if($request->value == 'Y'){

                // 메일 발송
                $mailData = [
                    'receiver_name' => $user->name_kr ?? '',
                    'receiver_email' => $user->email ?? '',
                    'body' => view("template.user-confirm", ['user' => $user])->render(),
                ];

                $mailResult = (new MailRealSendServices())->mailSendService($mailData, 'user-confirm');

                if ($mailResult != 'suc') {
                    return $mailResult;
                }
                // END 메일 발송

            }

            $this->dbCommit('관리자 - 회원상태 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다.',
                'location' => $this->ajaxActionLocation('reload')
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }
    private function changeLevel(Request $request)
    {
        $this->transaction();

        try {
            $user = User::withTrashed()->findOrFail($request->sid);

            $user->timestamps = false; // updated_at 자동 갱신 비활성화

            $user->level = $request->value;
            $user->update();

            $this->feeSetting($user->sid, $request->value);

            $this->dbCommit('관리자 - 회원등급 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다.',
                'location' => $this->ajaxActionLocation('reload')
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function feeSetting($user_sid, $level){
        $this->feeConfig = config('site.fee');

        $user = User::withTrashed()->findOrFail($user_sid);

        $this->transaction();

        if($level == 'A'/*정회원*/){
            //입회비
            $feeAExist = Fee::where(['user_sid'=>$user_sid, 'level'=>$level, 'category'=>'A', 'del'=>'N'])->exists();
            if($feeAExist === false) {
                $feeA = new Fee();
                $data = [
                    'year' => date('Y'),
                    'user_sid' => $user_sid,
                    'level' => $level,
                    'category' => 'A',
                    'price' => $this->feeConfig['price'][$level]['A']
                ];
                $feeA->setByData($data);
                $feeA->save();
            }

            $query = Fee::where(['user_sid'=>$user_sid, 'category'=>'A', 'del'=>'N'])->whereNotIn('level',['A']);
            if(!empty($feeA)){
                $query->whereNotIn('sid',[$feeA->sid]);
            }
            $feeAlist = $query->get();

            if ( $feeAlist->count() > 0 ){
                foreach ($feeAlist as $feeA){
                    $feeA->payment_status = 'E'; //해당없음
                    $feeA->update();
                }
            }

            //변경시 이전 회비 내역들이 있다면 미납처리로 원복
            $feeList = Fee::where(['user_sid'=>$user_sid, 'category'=>'A', 'del'=>'N', 'level'=>'A'])->get();
            if ( $feeList->count() > 0 ){
                foreach ($feeList as $fee){
                    $fee->payment_status = 'N'; //미납
                    $fee->update();
                }
            }

            //연회비
            $feeBExist = Fee::where(['user_sid'=>$user_sid, 'level'=>$level, 'category'=>'B', 'del'=>'N', 'year'=>date('Y')])->exists();
            if($feeBExist === false) {
                $feeB = new Fee();
                $data = [
                    'year' => date('Y'),
                    'user_sid' => $user_sid,
                    'level' => $level,
                    'category' => 'B',
                    'price' => $this->feeConfig['price'][$level]['B']
                ];
                $feeB->setByData($data);
                $feeB->save();
            }

            $query = Fee::where(['user_sid'=>$user_sid, 'category'=>'B', 'del'=>'N'])->whereNotIn('level',['A']);
            if(!empty($feeB)){
                $query->whereNotIn('sid',[$feeB->sid]);
            }
            $feeBlist = $query->get();

            if ( $feeBlist->count() > 0 ){
                foreach ($feeBlist as $feeB){
                    $feeB->payment_status = 'E'; //해당없음
                    $feeB->update();
                }
            }

            //변경시 이전 회비 내역들이 있다면 미납처리로 원복
            $feeList = Fee::where(['user_sid'=>$user_sid, 'category'=>'B', 'del'=>'N', 'level'=>'A'])->get();
            if ( $feeList->count() > 0 ){
                foreach ($feeList as $fee){
                    $fee->payment_status = 'N'; //미납
                    $fee->update();
                }
            }

            //종신회비
            $lifeFeeExist = Fee::where(['user_sid'=>$user_sid, 'level'=>$level, 'category'=>'C', 'del'=>'N'])->exists();
            if($lifeFeeExist === false){
                $isOlder = $this->isAge50Older($user->birth_date);
                if($isOlder){
                    $lifeFee = $this->feeConfig['price'][$level]['D'];
                }else{
                    $lifeFee = $this->feeConfig['price'][$level]['C'];
                }

                $feeC = New Fee();
                $data = [
                    'year'=>date('Y'),
                    'user_sid' => $user_sid,
                    'level'=>$level,
                    'category'=>'C',
                    'price'=>$lifeFee
                ];
                $feeC->setByData($data);
                $feeC->save();
            }

            //변경시 이전 회비 내역들이 있다면 미납처리로 원복
            $feeList = Fee::where(['user_sid'=>$user_sid, 'category'=>'C', 'del'=>'N', 'level'=>'A'])->get();
            if ( $feeList->count() > 0 ){
                foreach ($feeList as $fee){
                    $fee->payment_status = 'N'; //미납
                    $fee->update();
                }
            }

        }else if ($level == 'B'/*준회원*/){
            //입회비
            $feeAExist = Fee::where(['user_sid'=>$user_sid, 'level'=>$level, 'category'=>'A', 'del'=>'N'])->exists();
            if($feeAExist === false) {
                $feeA = new Fee();
                $data = [
                    'year' => date('Y'),
                    'user_sid' => $user_sid,
                    'level' => $level,
                    'category' => 'A',
                    'price' => $this->feeConfig['price'][$level]['A']
                ];
                $feeA->setByData($data);
                $feeA->save();
            }

            $query = Fee::where(['user_sid'=>$user_sid, 'category'=>'A', 'del'=>'N'])->whereNotIn('level',['B']);
            if(!empty($feeA)){
                $query->whereNotIn('sid',[$feeA->sid]);
            }
            $feeAlist = $query->get();

            if ( $feeAlist->count() > 0 ){
                foreach ($feeAlist as $feeA){
                    $feeA->payment_status = 'E'; //해당없음
                    $feeA->update();
                }
            }
            //변경시 이전 회비 내역들이 있다면 미납처리로 원복
            $feeList = Fee::where(['user_sid'=>$user_sid, 'category'=>'A', 'del'=>'N', 'level'=>'B'])->get();
            if ( $feeList->count() > 0 ){
                foreach ($feeList as $fee){
                    $fee->payment_status = 'N'; //미납
                    $fee->update();
                }
            }

            //연회비
            $feeBExist = Fee::where(['user_sid'=>$user_sid, 'level'=>$level, 'category'=>'B', 'del'=>'N', 'year'=>date('Y')])->exists();
            if($feeBExist === false) {
                $feeB = new Fee();
                $data = [
                    'year' => date('Y'),
                    'user_sid' => $user_sid,
                    'level' => $level,
                    'category' => 'B',
                    'price' => $this->feeConfig['price'][$level]['B']
                ];
                $feeB->setByData($data);
                $feeB->save();
            }

            $query = Fee::where(['user_sid'=>$user_sid, 'category'=>'B', 'del'=>'N'])->whereNotIn('level',['B']);
            if(!empty($feeB)){
                $query->whereNotIn('sid',[$feeB->sid]);
            }
            $feeBlist = $query->get();

            if ( $feeBlist->count() > 0 ){
                foreach ($feeBlist as $feeB){
                    $feeB->payment_status = 'E'; //해당없음
                    $feeB->update();
                }
            }

            //준회원으로 변경시 평생회비 있으면 해당없음으로 변경
            $lifeFeeExist = Fee::where(['user_sid'=>$user_sid, 'level'=>'A', 'category'=>'C', 'del'=>'N'])->first();
            if( !empty ($lifeFeeExist) ){
                $lifeFeeExist->payment_status = 'E'; //해당없음
                $lifeFeeExist->update();
            }

            //변경시 이전 회비 내역들이 있다면 미납처리로 원복
            $feeList = Fee::where(['user_sid'=>$user_sid, 'category'=>'B', 'del'=>'N', 'level'=>'B'])->get();
            if ( $feeList->count() > 0 ){
                foreach ($feeList as $fee){
                    $fee->payment_status = 'N'; //미납
                    $fee->update();
                }
            }

        }else{
            //명예회원 / 특별회원으로 회원 등급 변경 시 이전 회비 납부 해당없음으로 변경 부탁드립니다
            $fee_list = Fee::where(['user_sid'=>$user_sid, 'del'=>'N'])->get();
            foreach ($fee_list as $fee){
                $fee->payment_status = 'E'; //해당없음
                $fee->update();
            }
        }

        $this->dbCommit('관리자 - 회원등급 수정 - 회비 등록');
    }
    private function isAge50Older($birthDate = null) {

        if(empty($birthDate)){
            return false;
        }

        // 생년월일을 DateTime 객체로 변환
        $birthDateObj = Carbon::createFromFormat('Y-m-d', $birthDate);

        if (!$birthDateObj) {
            return false; // 잘못된 날짜 형식이면 false 반환
        }

        // 현재 날짜 가져오기
        $today = Carbon::today();

        // 나이 계산 (만 나이)
        $age = $today->diffInYears($birthDateObj);

        // 생일이 지나지 않았다면 나이 1살 빼기
        if ($today->isBefore($birthDateObj->copy()->year($today->year))) {
            $age--; // 생일이 지나지 않았다면 1살 빼기
        }

        return $age >= 50;
    }

    private function changeIsAdmin(Request $request)
    {
        $this->transaction();

        try {
            $user = User::withTrashed()->findOrFail($request->sid);

            $user->timestamps = false; // updated_at 자동 갱신 비활성화
            $user->is_admin = $request->value;
            $user->update();

            $this->dbCommit('관리자 - 관리자지정 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다.',
                'location' => $this->ajaxActionLocation('reload')
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function userLogin(Request $request)
    {
        $user = User::findOrFail($request->sid);
        auth('web')->login($user);

        return $this->returnJsonData('location', $this->ajaxActionLocation('blank', env('APP_URL')));
    }

    private function selectMemberInfo(Request $request)
    {
        $user = User::withTrashed()->findOrFail($request->user_sid);
        $customUser = $user->addCustomData();

        return $this->returnJsonData('user', $customUser);
    }

    private function changeSi(Request $request)
    {
        $this->userConfig = config('site.user');

//        $data = $this->userConfig['gu'][$request->si];

        $data = [];
        foreach ($this->userConfig['gu'][$request->si] as $k => $v) {
            $data[] = ['key' => $k, 'name' => $v];
        }

        return $this->returnJsonData('result', [
            'res' => 'SUC',
            'msg' => 'gu결과가 있습니다',
            'items' => $data,
        ]);
    }
}
