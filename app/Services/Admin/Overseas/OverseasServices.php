<?php

namespace App\Services\Admin\Overseas;

use App\Exports\OverseasExcel;
use App\Services\AppServices;
use App\Services\CommonServices;
use App\Models\OverseasSetting;
use App\Models\Grantees;
//use App\Models\WorkshopDetail;
use App\Models\Registration;
use Illuminate\Http\Request;
/**
 * Class WorkshopDetailServices
 * @package App\Services
 */
class OverseasServices extends AppServices
{
    public function __construct()
    {
        /**
         * config
         */
        $this->data['overseasConfig'] = config("site.overseas") ?? [];
    }

    public function indexService(Request $request)
    {
        $li_page = $request->li_page ?? 20;
        $this->data['li_page'] = $li_page;

        $query = OverseasSetting::where(['del'=>'N'])->orderByDesc('sid'); // 삭제 제외 전체

        if ($request->hide) {
            $query->where('hide', $request->hide);
        }
        if ($request->title) {
            $query->where('title', 'like', "%{$request->title}%");
        }


        $list = $query->paginate($li_page)->appends($request->query());
        $this->data['list'] = setListSeq($list);

        return $this->data;
    }

    public function upsertService(Request $request)
    {
        if(!empty($request->sid)){
            $this->data['overseasSetting'] = OverseasSetting::findOrFail($request->sid);
        }

        return $this->data;
    }


    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'overseasSetting-create':
                return $this->overseasSettingCreate($request);
            case 'overseasSetting-update':
                return $this->overseasSettingUpdate($request);
            case 'overseasSetting-delete':
                return $this->overseasSettingDelete($request);

            case 'db-change':
                return $this->dbChangeServices($request);
            case 'collective-create':
                return $this->collectiveCreateService($request);

            default:
                return NotFoundRedirect();
        }
    }

    private function overseasSettingCreate(Request $request)
    {
        $this->transaction();

        try {
            $reg = new OverseasSetting();
            $reg->setByData($request);
            $reg->save(); // created_at만 생성됨

            $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - overseasSetting 생성');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '등록 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);

        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function overseasSettingUpdate(Request $request)
    {
        $this->transaction();

        try {
            $overseasSetting = OverseasSetting::findOrFail($request->sid);

            $overseasSetting->setByData($request);
            $overseasSetting->timestamps = false; // updated_at 자동 업데이트 방지
            $overseasSetting->update();

            $this->dbCommit('관리자 - overseasSetting 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function overseasSettingDelete(Request $request)
    {
        $this->transaction();

        try {
            $registration = OverseasSetting::findOrFail($request->sid);
            $registration->del='Y';
            $registration->deleted_at=date('Y-m-d H:i:s');

            $registration->timestamps = false; // updated_at 자동 업데이트 방지
            $registration->update();

            $this->dbCommit('관리자 - overseasSetting 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '삭제 되었습니다.',
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

            $registration = OverseasSetting::findOrFail($request->sid);
            $registration->{$field} = $value;

            $registration->timestamps = false; // updated_at 자동 업데이트 방지
            $registration->update();

            $this->dbCommit('관리자 - wokshop_detail 변경');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e,true);
        }
    }


    private function collectiveCreateService(Request $request)
    {
        $this->transaction();

        try {
            foreach (json_decode($request->data) ?? [] as $data) {
                $data->wsid = $request->wsid;
                $detail = new OverseasSetting();

                switch (trim($data->str_pay_method)){
                    case 'Credit Card':
                        $pay_method = 'C';
                        break;
                    case 'Bank Transfer':
                        $pay_method = 'B';
                        break;
                    case '현금':
                        $pay_method = 'M';
                        break;
                    case '기타':
                        $pay_method = 'Z';
                        break;
                    case '면제':
                        $pay_method = 'W';
                        break;
                    default:
                        $pay_method = 'C';
                        break;
                }

                switch (trim($data->str_pay_status)){
                    case '미결제':
                        $pay_status = 'N';
                        break;
                    case '결제완료':
                        $pay_status = 'Y';
                        break;
                    case '무료':
                        $pay_status = 'F';
                        break;
                    default:
                        $pay_status = 'N';
                        break;
                }

                $data->pay_method = $pay_method;
                $data->pay_status = $pay_status;
                
                $detail->setByAdmin($data);

                $detail->save();
            }

            $this->dbCommit('관리자 - workshop detail 일괄 등록');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => "등록 되었습니다.",
                'winClose' => $this->ajaxActionWinClose(true)
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

//    private function searchCodeByValue(array $array, string $value): ?string
//    {
//        $key = array_search($value, $array);
//        return $key !== false ? (string)$key : null;
//    }
//    private function collectiveCreateService(Request $request)
//    {
//        $this->transaction();
//
//        $userConfig = config('site.user');
//
//        try {
//            foreach (json_decode($request->data) ?? [] as $data) {
////                $data->ex_sid = $request->ex_sid;
//
//                $hospital = Hospital::where(['name_kr'=>$data->name_kr,'chief_name'=>$data->chief_name])->first();
//                $si = $this->searchCodeByValue($userConfig['si'],$data->si);
//                $gu = $this->searchCodeByValue($userConfig['gu'][$si],$data->gu);
//
//                $hospital->gu = $gu;
//                $hospital->address = trim($data->address);
//                $hospital->update();
////                $executiveDetail->setByData($data);
////                $executiveDetail->save();
//            }
//
//            $this->dbCommit('관리자 - hospital 일괄 등록');
//
//            return $this->returnJsonData('alert', [
//                'case' => true,
//                'msg' => "등록 되었습니다.",
//                'winClose' => $this->ajaxActionWinClose(true)
//            ]);
//        } catch (\Exception $e) {
//            return $this->dbRollback($e);
//        }
//    }

}
