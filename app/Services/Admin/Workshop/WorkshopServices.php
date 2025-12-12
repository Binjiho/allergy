<?php

namespace App\Services\Admin\Workshop;

use App\Services\AppServices;
use App\Models\Workshop;
use App\Models\Registration;
use App\Models\Abstracts;
use App\Models\User;

use Illuminate\Http\Request;

/**
 * Class WorkshopServices
 * @package App\Services
 */
class WorkshopServices extends AppServices
{
//    private $webWorkshopServices;

//    public function __construct()
//    {
//        $this->webWorkshopServices = new WebWorkshopServices();
//    }

    public function indexService(Request $request)
    {
        $query = Workshop::orderByDesc('sid');
        $query->where('del', 'N');

        if ( $request->year ) {
            $query->where('year', $request->year);
        }
        if ( $request->status ) {
            $query->where('status', $request->status);
        }
        if ( $request->event_title ) {
            $query->where('event_title', 'like', "%{$request->event_title}%");
        }

        $list = $query->paginate(10)->appends(request()->except(['page']));
        $this->data['list'] = setListSeq($list);

        return $this->data;
    }

    public function upsertService(Request $request)
    {
        if($request->sid){
            $this->data['workshop'] = Workshop::findOrFail($request->sid);
        }

        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'workshop-create':
                return $this->workshopCreate($request);
            case 'workshop-update':
                return $this->workshopUpdate($request);
            case 'workshop-delete':
                return $this->workshopDelete($request);
            case 'add-affi':
                return $this->addAffiliationServices($request);
            default:
                return NotFoundRedirect();
        }
    }
    private function workshopCreate(Request $request)
    {
        $this->transaction();

        try {
            $workshop = new Workshop();

//            //코드 생성
//            $maxCode = Workshop::where('year', $request->year)
//                ->max(\DB::raw("CAST(RIGHT(code, 2) AS UNSIGNED)"));
//
//            $nextNumber = ($maxCode ?? 0) + 1;
//            $code = $request->year . str_pad($nextNumber, 2, '0', STR_PAD_LEFT);
//
//            $request->merge(['code' => $code]);

            $res_fee = array();
            $res_cnt = count($request->member_gubun);

            for ($i=0; $i<$res_cnt; $i++){
                $res_fee[] = [
                    'member_gubun' => $request->member_gubun[$i],
                    'gubun' => $request->gubun[$i],
                    'amount' => $request->amount[$i],
                ];
            }
            $request->merge([ 'res_fee' => $res_fee ]);

            $codeExist = Workshop::where('code',$request->code)->exists();
            if($codeExist){
                return $this->returnJsonData('alert', [
                    'case' => true,
                    'msg' => '이미 등록되어 있는 코드가 있습니다.',
                    'location' => $this->ajaxActionLocation('reload',false),
                ]);
            }

            $workshop->setBydata($request);
            $workshop->save();

            $this->dbCommit('관리자 - 학술행사 등록');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '등록 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }
    private function workshopUpdate(Request $request)
    {
        $this->transaction();

        try {
            $workshop = Workshop::findOrFail($request->sid);

            $res_fee = array();
            $res_cnt = count($request->member_gubun);

            for ($i=0; $i<$res_cnt; $i++){
                $res_fee[] = [
                    'member_gubun' => $request->member_gubun[$i],
                    'gubun' => $request->gubun[$i],
                    'amount' => $request->amount[$i],
                ];
            }
            $request->merge([ 'res_fee' => $res_fee ]);

            $workshop->setBydata($request);
            $workshop->update();

            $this->dbCommit('관리자 - 학술행사 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function workshopDelete(Request $request)
    {
        $this->transaction();

        try {
            $workshop = Workshop::findOrFail($request->sid);
            $workshop->del='Y';
            $workshop->update();

            $this->dbCommit('관리자 - 학술행사 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }

    private function addAffiliationServices(Request $request)
    {
        $this->data['defaultConfig'] = config('site.default-workshop');

        return $this->returnJsonData('after', [
            $this->ajaxActionHtml('.aff_div:last', view('admin.workshop.form.add-affi', $this->data)->render()),
        ]);
    }

}
