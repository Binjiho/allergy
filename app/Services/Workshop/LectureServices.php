<?php

namespace App\Services\Workshop;

use App\Services\AppServices;
use App\Models\Workshop;
use App\Models\Registration;
use App\Models\Lecture;
use App\Models\User;

use Illuminate\Http\Request;

/**
 * Class WorkshopServices
 * @package App\Services
 */
class LectureServices extends AppServices
{
    public function indexService(Request $request)
    {
        $this->data['workshop'] = Workshop::findOrFail($request->wsid);

        $query = Lecture::orderByDesc('sid')->where('del', 'N');

//        if (!isAdmin()) {
//            $query->where('hide', 'N');
//        }

        $list = $query->paginate(6)->appends(request()->except(['page']));
        $this->data['list'] = setListSeq($list);

        return $this->data;
    }

    public function upsertService(Request $request)
    {
        $this->data['workshop'] = Workshop::findOrFail($request->wsid);

        if($request->sid){
            $this->data['lecture'] = Lecture::findOrFail($request->sid);
        }
        return $this->data;
    }


    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'lecture-create':
                return $this->lectureCreate($request);
            case 'lecture-update':
                return $this->lectureUpdate($request);
            case 'lecture-delete':
                return $this->lectureDelete($request);

            default:
                return NotFoundRedirect();
        }
    }

    private function lectureCreate(Request $request)
    {
        $this->transaction();

        try {
            $lecture = new Lecture();
            $lecture->setBydata($request);
            $lecture->save();

            $this->dbCommit('사용자 - 강의원고 등록');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '등록 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', route('lecture',['wsid'=>$lecture->wsid]) ),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }
    private function lectureUpdate(Request $request)
    {
        $this->transaction();

        try {
            $lecture = Lecture::findOrFail($request->sid);

            $lecture->setBydata($request);
            $lecture->update();

            $this->dbCommit('사용자 - 강의원고 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', route('lecture',['wsid'=>$lecture->wsid]) ),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function lectureDelete(Request $request)
    {
        $this->transaction();

        try {
            $lecture = Lecture::findOrFail($request->sid);
            $lecture->del='Y';
            $lecture->update();

            $this->dbCommit('사용자 - 강의원고 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }

}
