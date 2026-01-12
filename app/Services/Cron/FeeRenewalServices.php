<?php

namespace App\Services\Cron;

use App\Models\User;
use App\Models\Fee;
use App\Models\OldFee;
use App\Services\AppServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

/**
 * Class FeeRenewalServices
 * @package App\Services
 */
class FeeRenewalServices extends AppServices
{
    public function renewalService() // 회비 목록 갱신
    {
        // 쿼리 로그가 쌓이지 않도록 비활성화 (메모리 및 패킷 에러 방지)
        \DB::disableQueryLog();

        Log::channel('cronLog')->error("================================== 회비 목록 갱신 ===================================");


        $userList = User::where(['del'=>'N', 'del_request'=>'N', 'confirm'=>'Y'])->get(); // 탈퇴 or 삭제회원 제외



        try {
            foreach ($userList as $user) {

                Log::channel('cronLog')->error("USER sid: {$user->sid} | USER ID {$user->id} 차기 회비 셋팅");

                $this->feeSetting($user->sid, $user->level);

            }



            Log::channel('cronLog')->error("================================== END 회비 목록 갱신 SUC ===================================" . PHP_EOL);


            return 'suc';
        } catch (\Exception $e) {
//            if (php_sapi_name() == 'cli') {
            Log::channel('cronLog')->error("================================== END 회비 목록 갱신 ERROR ===================================" . PHP_EOL);
            Log::channel('cronLog')->error($e->getMessage()); // 에러 메시지 기록
            Log::channel('cronLog')->error($e->getTraceAsString()); // 에러 경로 기록

//            }

            return $this->dbRollback($e);
        }
    }

    private function feeSetting($user_sid, $level){
        $this->feeConfig = config('site.fee');

        /**
         * year 반드시 체크
         */
        $month = date('n'); // 정수형 월

        if ($month >= 12) {
            $yearv = date('Y')+1;
        } else {
            $yearv = date('Y');
        }

        $user = User::withTrashed()->findOrFail($user_sid);

//        $this->transaction();

        if($level == 'A'/*정회원*/){
            $feeCExist = Fee::where(['user_sid'=>$user_sid, 'category'=>'C', 'payment_status'=>'Y', 'del'=>'N'])->exists();
            if($feeCExist){

            }else{

                //입회비
                $feeAExist = Fee::where(['user_sid'=>$user_sid, 'level'=>$level, 'category'=>'A', 'del'=>'N'])->exists();
                if($feeAExist === false) {
                    $feeA = new Fee();
                    $data = [
                        'year' => $yearv,
                        'user_sid' => $user_sid,
                        'level' => $level,
                        'category' => 'A',
                        'price' => $this->feeConfig['price'][$level]['A']
                    ];
                    $feeA->setByData($data);
                    $feeA->save();
                }
                //연회비
                $feeBExist = Fee::where(['user_sid'=>$user_sid, 'level'=>$level, 'category'=>'B', 'del'=>'N', 'year'=>date('Y')])->exists();
                if($feeBExist === false) {
                    $feeB = new Fee();
                    $data = [
                        'year' => $yearv,
                        'user_sid' => $user_sid,
                        'level' => $level,
                        'category' => 'B',
                        'price' => $this->feeConfig['price'][$level]['B']
                    ];
                    $feeB->setByData($data);
                    $feeB->save();
                }

                //종신회비
                $lifeFeeExist = Fee::where(['user_sid'=>$user_sid, 'level'=>$level, 'category'=>'C', 'del'=>'N'])->exists();

                $isOlder = $this->isAge50Older($user->birth_date);
                if($isOlder){
                    $lifeFee = $this->feeConfig['price'][$level]['D'];
                }else{
                    $lifeFee = $this->feeConfig['price'][$level]['C'];
                }

                if($lifeFeeExist === false){
                    $feeC = New Fee();
                    $data = [
                        'year'=>$yearv,
                        'user_sid' => $user_sid,
                        'level'=>$level,
                        'category'=>'C',
                        'price'=>$lifeFee
                    ];
                    $feeC->setByData($data);
                    $feeC->save();
                }else{
                    /**
                     * 기존 종신회비 회원 생년이 50세 이상이 될때, 기존 종신회비 금액 update
                     */
                    if($isOlder){
                        $lifeFees = Fee::where(['user_sid'=>$user_sid, 'level'=>$level, 'category'=>'C', 'del'=>'N'])->get();
                        foreach ($lifeFees as $feeC){
                            $feeC->price = $lifeFee;
                            $feeC->update();
                        }
                    }
                }
            }


        }else if ($level == 'B'/*준회원*/){
            $feeCExist = Fee::where(['user_sid'=>$user_sid, 'category'=>'C', 'payment_status'=>'Y', 'del'=>'N'])->exists();
            if($feeCExist){

            }else{
                //입회비
                $feeAExist = Fee::where(['user_sid'=>$user_sid, 'level'=>$level, 'category'=>'A', 'del'=>'N'])->exists();
                if($feeAExist === false) {
                    $feeA = new Fee();
                    $data = [
                        'year' => $yearv,
                        'user_sid' => $user_sid,
                        'level' => $level,
                        'category' => 'A',
                        'price' => $this->feeConfig['price'][$level]['A']
                    ];
                    $feeA->setByData($data);
                    $feeA->save();
                }
                //연회비
                $feeBExist = Fee::where(['user_sid'=>$user_sid, 'level'=>$level, 'category'=>'B', 'del'=>'N', 'year'=>date('Y')])->exists();
                if($feeBExist === false) {
                    $feeB = new Fee();
                    $data = [
                        'year' => $yearv,
                        'user_sid' => $user_sid,
                        'level' => $level,
                        'category' => 'B',
                        'price' => $this->feeConfig['price'][$level]['B']
                    ];
                    $feeB->setByData($data);
                    $feeB->save();
                }
            }
        }

//        $this->dbCommit('관리자 - 회비 차기년도 자동 등록');
    }
    private function isAge50Older($birthDate = null) {

        // 1. 값이 없거나 유효하지 않은 기본값이면 false 반환
        if (empty($birthDate) || $birthDate == '0000-00-00' || $birthDate == '0000.00.00') {
            return false;
        }
        // 2. [정규식 체크] 숫자4자리-숫자2자리-숫자2자리 형태인지 확인
        // 1993-08-02 형태가 아니면 무조건 false 반환하고 종료
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $birthDate)) {
            // 형식이 틀린 데이터는 로그에만 남기고 넘어갑니다.
            // Log::channel('cronLog')->warning("형식 불일치 데이터 패스: {$birthDate}");
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
}
