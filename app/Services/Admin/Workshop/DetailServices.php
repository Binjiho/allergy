<?php

namespace App\Services\Admin\Workshop;

use App\Exports\DetailExcel;
use App\Services\AppServices;
use App\Services\CommonServices;
use App\Models\Workshop;
//use App\Models\WorkshopDetail;
use App\Models\Registration;
use Illuminate\Http\Request;
/**
 * Class WorkshopDetailServices
 * @package App\Services
 */
class DetailServices extends AppServices
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
        $this->data['workshop'] = Workshop::findOrFail($request->wsid);

        $li_page = $request->li_page ?? 20;
        $this->data['li_page'] = $li_page;

        $query = Registration::where(['wsid'=>$request->wsid, 'del'=>'N'])->orderByDesc('created_at'); // 삭제 제외 전체


        if ($request->name_kr) {
            $query->where('name_kr', 'like', "%{$request->name_kr}%");
        }
        if ($request->sosok) {
            $query->where('sosok_kr', 'like', "%{$request->sosok_kr}%");
        }
        if ($request->license_number) {
            $query->where('license_number', 'like', "%{$request->license_number}%");
        }

        // 엑셀 다운로드 할때
        if ($request->excel) {
            $this->data['total'] = $query->count();
            $this->data['collection'] = $query->lazy();
            $excelName = date('Y-m-d').'_'.$this->data['workshop']->title.'_상세등록List';
            return (new CommonServices())->excelDownload(new RegistrationExcel($this->data), $excelName);
        }

        $list = $query->paginate($li_page)->appends($request->query());
        $this->data['list'] = setListSeq($list);

        return $this->data;
    }

    public function upsertService(Request $request)
    {
        $this->data['workshop'] = Workshop::findOrFail($request->wsid);
        $this->data['wsid'] = $this->data['workshop']->sid;
        
        if(!empty($request->sid)){
            $this->data['reg'] = Registration::findOrFail($request->sid);
        }

        return $this->data;
    }


    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'detail-create':
                return $this->detailCreate($request);
            case 'detail-update':
                return $this->detailUpdate($request);
            case 'detail-delete':
                return $this->detailDelete($request);

            case 'db-change':
                return $this->dbChangeServices($request);
            case 'collective-create':
                return $this->collectiveCreateService($request);

            default:
                return NotFoundRedirect();
        }
    }

    private function detailCreate(Request $request)
    {
        $this->transaction();

        try {
            $reg = new Registration();
            $reg->setByAdmin($request);
            $reg->save(); // created_at만 생성됨

            $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - wokshop_detail 생성');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '등록 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);

        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function detailUpdate(Request $request)
    {
        $this->transaction();

        try {
            $detail = Registration::findOrFail($request->sid);

            $detail->setByAdmin($request);
            $detail->timestamps = false; // updated_at 자동 업데이트 방지
            $detail->update();

            $this->dbCommit('관리자 - wokshop_detail 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function detailDelete(Request $request)
    {
        $this->transaction();

        try {
            $registration = Registration::findOrFail($request->sid);
            $registration->del='Y';
            $registration->deleted_at=date('Y-m-d H:i:s');

            $registration->timestamps = false; // updated_at 자동 업데이트 방지
            $registration->update();

            $this->dbCommit('관리자 - wokshop_detail 삭제');

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

            $registration = Registration::findOrFail($request->sid);
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
                $detail = new Registration();

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
