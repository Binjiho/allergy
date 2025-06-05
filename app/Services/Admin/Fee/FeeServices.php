<?php

namespace App\Services\Admin\Fee;

use App\Models\Fee;
use App\Models\FeeSetting;
use App\Exports\FeeExcel;
use App\Models\User;
use App\Services\AppServices;
use App\Services\CommonServices;
use App\Services\MailRealSendServices;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

/**
 * Class FeeServices
 * @package App\Services
 */
class FeeServices extends AppServices
{
    public function indexService(Request $request)
    {
        $li_page = $request->li_page ?? 20;
        $feeCase = $request->case;

        $level = $request->level;
        $id = $request->id;
        $name_kr = $request->name_kr;

        $year = $request->year;
        $category = $request->category;
        $payment_method = $request->payment_method;
        $payment_status = $request->payment_status;

        $sortBy = $request->sort_by ?? 'sid';
        $order = $request->order ?? 'desc';

        if(!empty($sortBy) && !empty($order)){
            $query = Fee::with('user')->orderBy($sortBy, $order);
        }else{
            $query = Fee::with('user')->orderByDesc('year')->orderByDesc('sid');
        }

        switch ($feeCase) {
            case 'full':
                $excelName = '완납회비';
                $query->where('payment_status', 'Y');
                break;

            case 'unpaid':
                $excelName = '미납회비';
                $query->whereIn('payment_status', ['N', 'R']);
                break;
        }

        if ($level) {
            $query->whereHas('user', function ($q) use($level) {
                $q->where('level', $level);
            });
        }
        if ($name_kr) {
            $query->whereHas('user', function ($q) use($name_kr) {
                $q->where('name_kr', 'like', "%{$name_kr}%")
                    ->orWhere('first_name', 'like', "%{$name_kr}%")
                    ->orWhere('last_name', 'like', "%{$name_kr}%")
                    ->orWhere('name_han', 'like', "%{$name_kr}%");
            });
        }
        if ($id) {
            $query->whereHas('user', function ($q) use($id) {
                $q->where('id', 'like', "%{$id}%");
            });
        }
        if ($request->license_number) {
            $query->whereHas('user', function ($q) use($request) {
                $q->where('license_number', 'like', "%{$request->license_number}%");
            });
        }
        if ($category) {
            $query->where('category', $category);
        }
        if ($payment_status) {
            $query->where('payment_status', $payment_status);
        }
        if ($payment_method) {
            $query->where('payment_method', $payment_method);
        }
        if ($request->sYear) {
            $query->where('year', '>=', $request->sYear);
        }
        if ($request->eYear) {
            $query->where('year', '<=', $request->eYear);
        }

        // 엑셀 다운로드 할때
        if ($request->excel) {
            $this->data['total'] = $query->count();
            $this->data['collection'] = $query->lazy();
            return (new CommonServices())->excelDownload(new FeeExcel($this->data), date('Y-m-d').'_'.($excelName ?? '전체 회비'));
        }

        $list = $query->paginate($li_page)->appends($request->query());

        $this->data['list'] = setListSeq($list);
        $this->data['li_page'] = $li_page;
        $this->data['feeCase'] = empty($feeCase) ? [] : ['case' => $feeCase];

        // case(payment_status)별 카운트
        $this->data['caseCnt'] = Fee::get('payment_status')->groupBy('payment_status')
            ->map(function ($group) {
                return $group->count();
            });

        // 전체 유저 수 카운트
        $this->data['caseCnt']['total'] = Fee::where('del','N')->count();

        return $this->data;
    }

    public function allListService(Request $request)
    {
        $user = User::withTrashed()->findOrFail($request->user_sid);
        $list = $user->fees()->paginate(10);

        $this->data['user'] = $user;
        $this->data['list'] = setListSeq($list);

        return $this->data;
    }

    public function upsertService(Request $request)
    {
        $sid = $request->sid;

        if (!empty($sid)) {
            $this->data['fee'] = Fee::with('user')->findOrFail($sid);
        }

        if(!empty($request->user_sid)){
            $user = User::withTrashed()->findOrFail($request->user_sid);
            $this->data['user'] = $user;
        }

        return $this->data;
    }

    public function receiptService(Request $request)
    {
        $this->feeConfig = getConfig('fee');

        $user_sid = $request->user_sid;
        $this->data['user'] = User::findOrFail($user_sid);

        $fee_list = Fee::where([
            'tid' => $request->tid,
            'user_sid' => $user_sid,
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

    public function remailService(Request $request)
    {
        $this->feeConfig = getConfig('fee');

        $this->data['fee'] = Fee::withTrashed()->findOrFail($request->sid);
        $this->data['type'] = $request->type;
        $this->data['title_str'] = $this->data['fee']->year.'년 '.$this->feeConfig['category'][$this->data['fee']->category] ?? '';
        $this->data['tot_price'] = $this->data['fee']->price ?? 0;

        return $this->data;
    }


    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'fee-create':
                return $this->feeCreate($request);

            case 'fee-update':
                return $this->feeUpdate($request);

            case 'fee-delete':
                return $this->feeDelete($request);

            case 'change-payment_status':
                return $this->changePaymentStatus($request);

            case 'fee-renew':
                return $this->feeRenew($request);

            case 'send-mail':
                return $this->sendMail($request);

            default:
                return notFoundRedirect();
        }
    }

    private function feeCreate(Request $request)
    {
        $this->transaction();

        try {
            $fee = new Fee();
            $fee->setByData($request);
            $fee->save();

            /**
             * tid가 없는 상태인데 넣으려할때 random값 넣기
             */
            if(empty($fee->tid) && $request->payment_status == 'Y'){
                $random = substr(Str::uuid(), 0, 15);
                $fee->tid='admin'.$random;
            }
            $fee->timestamps = false; // updated_at 자동 갱신 비활성화
            $fee->update();

            $this->dbCommit('관리자 - 회비 등록');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '등록 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function feeUpdate(Request $request)
    {
        $this->transaction();

        try {
            $fee = Fee::findOrFail($request->sid);
            $fee->setByData($request);

            /**
             * tid가 없는 상태인데 넣으려할때 random값 넣기
             */
            if($request->payment_status == 'Y'){
                $random = substr(Str::uuid(), 0, 15);
                $fee->tid='admin'.$random;
            }else{
                $fee->tid = null;
                $fee->payment_date = null;
            }
            $fee->update();

            $this->dbCommit('관리자 - 회비 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function feeDelete(Request $request)
    {
        $this->transaction();

        try {
            $fee = Fee::findOrFail($request->sid);
            $fee->del='Y';
            $fee->deleted_at=date('Y-m-d H:i:s');
            $fee->update();

            $this->dbCommit('관리자 - 회비 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function changePaymentStatus(Request $request)
    {
        $this->transaction();

        try {
            $this->feeConfig = getConfig('fee');

            $fee = Fee::withTrashed()->findOrFail($request->sid);
            $fee->payment_status = $request->value;

            $title_arr[] = $fee->year.'년 '.$this->feeConfig['category'][$fee->category] ?? '';
            $tot_price = $fee->price ?? 0;

            if($request->value=='Y'){
                //처음에 같이 결제한 건이어도 하나씩 개별 발송으로 함 (같이 결제한 건의 경우 status도 같이 바꿔줘야하고 DB이전했을때 이슈생길수 있음)
                $fee->payment_date = date('Y-m-d H:i:s');

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
            }else{
                $fee->payment_date = null;
            }
            $fee->update();

            $this->dbCommit('관리자 - 회비 납부상태 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '변경 되었습니다.',
                'location' => $this->ajaxActionLocation('reload')
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function feeRenew(Request $request)
    {
        /**
         * 회비 관리에서 {당해연도}.12.01부터 회비 셋팅
         */
        $currentDate = date('Y-m-d'); // 서버 현재 날짜
        $compareDate = date('Y') . '-12-01'; // 당해연도 12월 1일

        if ( ($currentDate < $compareDate) && masterIp() === false) {
            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '차기연도 연회비 세팅은 당해연도 12월 1일부터 가능합니다.',
                'location' => $this->ajaxActionLocation('reload')
            ]);
        }

        $renewalServices = (new \App\Services\Cron\FeeRenewalServices());
        $renewResult = $renewalServices->renewalService();

        if ($renewResult != 'suc') {
            return $renewResult;
        }

        return $this->returnJsonData('alert', [
            'case' => true,
            'msg' => '갱신 되었습니다.',
            'location' => $this->ajaxActionLocation('reload')
        ]);
    }

    private function sendMail(Request $request)
    {
        $this->feeConfig = getConfig('fee');

        switch ($request->type) {
            case 'request': // 관리자 - 납부요청
                $template = 'template.fee-request';
                $mailType = 'fee-request';
                break;

            case 'ok': // 관리자 - 완료메일
                $template = 'template.fee-ok';
                $mailType = 'fee-ok';
                break;

            default:
                return notFoundRedirect();
        }

        $fee = Fee::with('user')->findOrFail($request->sid);
        $title_str = $fee->year.'년 '.$this->feeConfig['category'][$fee->category] ?? '';
        $tot_price = $fee->price ?? 0;

        // 메일 발송
        $mailData = [
            'receiver_name' => $fee->user->name_kr,
            'receiver_email' => $fee->user->email,
            'body' => view($template, ['fee' => $fee, 'title_str'=> $title_str, 'tot_price'=> $tot_price])->render(),
        ];

        $mailResult = (new MailRealSendServices())->mailSendService($mailData, $mailType);

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
}
