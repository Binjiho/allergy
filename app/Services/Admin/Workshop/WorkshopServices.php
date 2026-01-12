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
        $query = Workshop::where(['del'=>'N','kind'=>'W'])->orderByDesc('event_sdate');
        $query->where('del', 'N');

        if ( $request->title ) {
            $query->where('title', 'like', "%{$request->title}%");
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
            $this->ajaxActionHtml('.aff_div:last', view('admin.education.form.add-affi', $this->data)->render()),
        ]);
    }

}
