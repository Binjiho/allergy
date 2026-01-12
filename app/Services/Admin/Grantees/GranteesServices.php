<?php

namespace App\Services\Admin\Grantees;

use App\Exports\GranteesExcel;
use App\Services\AppServices;
use App\Services\CommonServices;
use App\Models\Grantees;
use App\Models\OverseasSetting;
use App\Models\Registration;
use Illuminate\Http\Request;
/**
 * Class WorkshopDetailServices
 * @package App\Services
 */
class GranteesServices extends AppServices
{
    public function __construct()
    {
        /**
         * config
         */
        $this->data['granteesConfig'] = config("site.grantees") ?? [];
    }

    public function indexService(Request $request)
    {
        $li_page = $request->li_page ?? 20;
        $this->data['li_page'] = $li_page;

        $query = Grantees::where(['del'=>'N'])->orderByDesc('year')->orderByDesc('created_at'); // 삭제 제외 전체

        if ($request->year_sdate) {
            $query->where('year', '>=', $request->year_sdate);
        }
        if ($request->year_edate) {
            $query->where('year', '<=', $request->year_edate);
        }
        if ($request->name_kr) {
            $query->where('name_kr', 'like', "%{$request->name_kr}%");
        }
        if ($request->title) {
            $query->where('title', 'like', "%{$request->title}%");
        }
        if ($request->license_number) {
            $query->where('license_number', 'like', "%{$request->license_number}%");
        }

        // 엑셀 다운로드 할때
        if ($request->excel) {
            $this->data['total'] = $query->count();
            $this->data['collection'] = $query->lazy();
            $excelName = date('Y-m-d').'_수혜명단List';
            return (new CommonServices())->excelDownload(new GranteesExcel($this->data), $excelName);
        }

        $list = $query->paginate($li_page)->appends($request->query());
        $this->data['list'] = setListSeq($list);

        return $this->data;
    }

    public function upsertService(Request $request)
    {
        if(!empty($request->sid)){
            $this->data['grantees'] = Grantees::findOrFail($request->sid);
        }

        return $this->data;
    }


    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'grantees-create':
                return $this->granteesCreate($request);
            case 'grantees-update':
                return $this->granteesUpdate($request);
            case 'grantees-delete':
                return $this->granteesDelete($request);

            case 'db-change':
                return $this->dbChangeServices($request);
            case 'collective-create':
                return $this->collectiveCreateService($request);
            case 'memo-write':
                return $this->memoWrite($request);

            default:
                return NotFoundRedirect();
        }
    }

    private function granteesCreate(Request $request)
    {
        $this->transaction();

        try {
            $reg = new Grantees();
            $reg->setByData($request);
            $reg->save(); // created_at만 생성됨

            $this->dbCommit( ( checkUrl() == 'admin' ? '관리자 ' : '사용자' ).' - 수혜명단 생성');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '등록 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);

        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function granteesUpdate(Request $request)
    {
        $this->transaction();

        try {
            $grantees = Grantees::findOrFail($request->sid);

            $grantees->setByData($request);
            $grantees->timestamps = false; // updated_at 자동 업데이트 방지
            $grantees->update();

            $this->dbCommit('관리자 - 수혜명단 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function granteesDelete(Request $request)
    {
        $this->transaction();

        try {
            $registration = Grantees::findOrFail($request->sid);
            $registration->del='Y';
            $registration->deleted_at=date('Y-m-d H:i:s');

            $registration->timestamps = false; // updated_at 자동 업데이트 방지
            $registration->update();

            $this->dbCommit('관리자 - 수혜명단 삭제');

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

            $registration = Grantees::findOrFail($request->sid);
            $registration->{$field} = $value;

            $registration->timestamps = false; // updated_at 자동 업데이트 방지
            $registration->update();

            $this->dbCommit('관리자 - 수혜명단 변경');

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
//                $data->wsid = $request->wsid;
                $detail = new Grantees();
                $detail->setByData($data);

                $detail->save();
            }

            $this->dbCommit('관리자 - 수혜명단 일괄 등록');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => "등록 되었습니다.",
                'winClose' => $this->ajaxActionWinClose(true)
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }
    private function memoWrite(Request $request)
    {
        $this->transaction();

        try {
            $registration = Grantees::findOrFail($request->sid);
            $registration->memo = $request->memo;

            $registration->timestamps = false; // updated_at 자동 업데이트 방지
            $registration->update();

            $this->dbCommit('관리자 - 수혜명단 메모 작성');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '저장 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

}
