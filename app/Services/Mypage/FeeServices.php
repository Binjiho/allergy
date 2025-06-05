<?php

namespace App\Services\Mypage;

use App\Models\User;
use App\Models\Fee;
use App\Models\OldFee;
use App\Services\AppServices;
use App\Services\MailRealSendServices;
use App\Services\CommonServices;
use App\Services\Auth\AuthServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Class MypageServices
 * @package App\Services
 */
class FeeServices extends AppServices
{
    public function listService(Request $request)
    {
        $this->data['user'] = thisUser();
        $this->data['list'] = $this->data['user']->fees; // 전체 회비내역
        $this->data['lastFee'] = $this->data['user']->lastFee; // 가장 최근 회비
        $this->data['isLifeMember'] = $this->data['user']->isLifeMember(); // 종신회원 체크

        return $this->data;
    }

    public function upsertService(Request $request)
    {
        $this->feeConfig = getConfig('fee');
        $this->data['user'] = thisUser();

        $fee_sid_arr = explode(',',$request->sid);
        $fee_list = Fee::whereIn('sid', $fee_sid_arr)->get();

        $title_arr = $price_arr = array();
        $tot_price = 0;
        foreach ($fee_list as $key => $fee){
            $title_arr[] = $fee->year.'년 '.$this->feeConfig['category'][$fee->category] ?? '';
            $price_arr[] = $fee->price ?? 0;
            $tot_price += $fee->price ?? 0;
        }
        $this->data['title_arr'] = $title_arr;
        $this->data['price_arr'] = $price_arr;
        $this->data['tot_price'] = $tot_price;

        return $this->data;
    }
    public function receiptService(Request $request)
    {
        $this->feeConfig = getConfig('fee');

        $this->data['user'] = thisUser();

        $fee_list = Fee::where([
            'tid' => $request->tid,
            'user_sid' => thisPK(),
            'payment_status' => 'Y',
        ])->get();

        $this->data['fee_list'] = $fee_list;

        $target_category = array();
        $target_price = 0;
        foreach ($fee_list as $fee){
            $target_category[] = $this->feeConfig['category'][$fee->category] ?? '';
            $target_price += $fee->price;
        }
        $this->data['target_category'] = implode(',',$target_category);
        $this->data['target_price'] = $target_price;

        return $this->data;
    }


    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'payment-create':
                return $this->paymentCreate($request);
            default:
                return notFoundRedirect();
        }
    }

    private function paymentCreate(Request $request)
    {
        $this->transaction();

        try {
            $this->feeConfig = getConfig('fee');
            $fee_sid_arr = explode(',',$request->sid);
            $fee_list = Fee::whereIn('sid', $fee_sid_arr)->get();

            $title_arr = $price_arr = array();
            $tot_price = 0;

            foreach ($fee_list as $idx => $fee){

                $title_arr[] = $fee->year.'년 '.$this->feeConfig['category'][$fee->category] ?? '';
                $tot_price += $fee->price ?? 0;

                if ($request->payment_method === 'C' ) {
                    $fee->resultCode = $request->resultCode; // 카드결제 결과 코드
                    $fee->resultMsg = $request->resultMsg; // 카드결제 결과 메세지
                    $fee->TotPrice = $request->price; // 카드결제 금액
                    $fee->MOID = $request->MOID; // 카드결제 주문번호
                    $fee->tid = $request->tid; // 카드결제 거래번호
                    $fee->payment_method = $request->payment_method;
                    $fee->payment_status = 'Y';
                    $fee->payment_date = date('Y-m-d H:i:s');
                    $fee->update(); // 카드결제 정보 저장

                }else if($request->payment_method === 'B'){
                    $random = substr(Str::uuid(), 0, 15);
                    $fee->tid='bank'.$random;

                    $fee->TotPrice = $request->price; // 무통장 금액
                    $fee->payment_method = $request->payment_method;
                    $fee->payment_status = 'N';
                    $fee->depositor = $request->depositor;
                    $fee->deposit_date = $request->deposit_date;
                    $fee->update();

                } else {
                    $fee->TotPrice = 0; // 무료결제
                    $fee->payment_method = $request->payment_method;
                    $fee->payment_status = 'Y';
                    $fee->payment_date = date('Y-m-d H:i:s');
                    $fee->update();
                }
            }

            if($request->payment_method == 'B'){
                // 무통장
                $mailData = [
                    'receiver_name' => $fee->user->name_kr ?? '',
                    'receiver_email' => $fee->user->email ?? '',
                    'body' => view("template.fee-request", ['fee' => $fee, 'title_str'=> implode(',',$title_arr), 'tot_price'=> $tot_price ])->render(),
                ];

                $mailResult = (new MailRealSendServices())->mailSendService($mailData, 'fee-request');

                if ($mailResult != 'suc') {
                    return $mailResult;
                }
                // END 메일 발송
            }else{
                $mailData = [
                    'receiver_name' => $fee->user->name_kr ?? '',
                    'receiver_email' => $fee->user->email ?? '',
                    'body' => view("template.fee-ok", [ 'fee'=>$fee, 'title_str'=> implode(',',$title_arr), 'tot_price'=> $tot_price ])->render(),
                ];

                $mailResult = (new MailRealSendServices())->mailSendService($mailData, 'fee-ok');

                if ($mailResult != 'suc') {
                    return $mailResult;
                }
                // END 메일 발송
            }



            $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - 회비결제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '완료 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }


}
