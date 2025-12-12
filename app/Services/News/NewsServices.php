<?php

namespace App\Services\News;

use App\Models\User;
use App\Models\ScolarPrize;
use App\Models\ResearchPrize;
//use App\Models\AbstractView;

use App\Services\AppServices;
use App\Services\CommonServices;
use Illuminate\Http\Request;

/**
 * Class EventServices
 * @package App\Services
 */
class NewsServices extends AppServices
{
    public function prizeService(Request $request)
    {
        $query = ScolarPrize::where(['del'=>'N'])->orderByDesc('year');

        if ($request->keyword) {
            $query->where(function ($q) use($request) {
                $q->where('year', $request->keyword)
                    ->orWhere('gubun', 'like', "%{$request->keyword}%")
                    ->orWhere('name_kr', 'like', "%{$request->keyword}%")
                    ->orWhere('sosok', 'like', "%{$request->keyword}%")
                   ;
            });
        }

        $list = $query->paginate(9999)->appends(request()->except(['page']));
        $this->data['list'] = setListSeq($list);

        return $this->data;
    }

    public function researchService(Request $request)
    {
        $query = ResearchPrize::where(['del'=>'N'])->orderByDesc('year');

        if ($request->keyword) {
            $query->where(function ($q) use($request) {
                $q->where('year', $request->keyword)
                    ->orWhere('gubun', 'like', "%{$request->keyword}%")
                    ->orWhere('name_kr', 'like', "%{$request->keyword}%")
                    ->orWhere('sosok', 'like', "%{$request->keyword}%")
                    ->orWhere('title', 'like', "%{$request->keyword}%")
                    ->orWhere('regnum', 'like', "%{$request->keyword}%");
            });
        }

        $list = $query->paginate(9999)->appends(request()->except(['page']));
        $this->data['list'] = setListSeq($list);

        return $this->data;
    }

    public function prizeUpsertService(Request $request)
    {
        $sid = $request->sid ?? null;
        $this->data['prize'] = empty($sid) ? null : ScolarPrize::findOrFail($sid);

        return $this->data;
    }

    public function researchUpsertService(Request $request)
    {
        $sid = $request->sid ?? null;
        $this->data['prize'] = empty($sid) ? null : ResearchPrize::findOrFail($sid);

        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {

            case 'prize-create':
                return $this->prizeCreate($request);
            case 'prize-update':
                return $this->prizeUpdate($request);
            case 'prize-delete':
                return $this->prizeDelete($request);
            case 'prize-individualDelete':
                return $this->prizeindividualDelete($request);
            case 'prize-collective-create':
                return $this->prizeCollectiveCreate($request);

            case 'research-create':
                return $this->researchCreate($request);
            case 'research-update':
                return $this->researchUpdate($request);
            case 'research-delete':
                return $this->researchDelete($request);
            case 'research-individualDelete':
                return $this->researchindividualDelete($request);
            case 'research-collective-create':
                return $this->researchCollectiveCreate($request);

            case 'sort-change':
                return $this->sortChange($request);
            default:
                return NotFoundRedirect();
        }
    }

    private function prizeCollectiveCreate(Request $request)
    {
        $this->transaction();

        try {
            $data = json_decode($request->data ?? [], true);

//            $max_ord = ResearchPrize::where('del','N')->max('order');

            foreach ($data as $index => $item) {
//                $item['order'] = (int)$max_ord + ( count($data) - $index );

                $prize = (new ScolarPrize());
                $prize->setByData($item);
                $prize->save();

            }

            $this->dbCommit('학술상 다건 등록');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '등록 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function prizeCreate(Request $request)
    {
        $this->transaction();

        try {
            $member = (new ScolarPrize());
            $member->setByData($request);
            $member->save();

            $this->dbCommit('학술상 단건 등록');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '등록 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function prizeUpdate(Request $request)
    {
        $this->transaction();

        try {
            $member = ScolarPrize::findOrFail($request->sid);

            $member->setByDataModify($request);
            $member->update();

            $this->dbCommit('학술상 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }

    private function prizeDelete(Request $request)
    {
        $this->transaction();

        try {
            $member = ScolarPrize::findOrFail($request->sid);

            $member->delete();

            $this->dbCommit('학술상 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function prizeindividualDelete(Request $request)
    {
        $this->transaction();

        try {
            $sid_arr = explode(',', $request->sid);
            foreach ($sid_arr as $sid){
                $member = ScolarPrize::findOrFail($sid);
                $member->delete();
            }

            $this->dbCommit('학술상수상내역 선택삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }


    private function researchCollectiveCreate(Request $request)
    {
        $this->transaction();

        try {
            $data = json_decode($request->data ?? [], true);

//            $max_ord = ResearchPrize::where('del','N')->max('order');

            foreach ($data as $index => $item) {
//                $item['order'] = (int)$max_ord + ( count($data) - $index );

                $prize = (new ResearchPrize());
                $prize->setByData($item);
                $prize->save();

            }

            $this->dbCommit('연구상수상내역 다건 등록');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '등록 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function researchCreate(Request $request)
    {
        $this->transaction();

        try {
            $member = (new ResearchPrize());
            $member->setByData($request);
            $member->save();

            $this->dbCommit('연구상수상내역 단건 등록');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '등록 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function researchUpdate(Request $request)
    {
        $this->transaction();

        try {
            $member = ResearchPrize::findOrFail($request->sid);

            $member->setByDataModify($request);
            $member->update();

            $this->dbCommit('연구상수상내역 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }

    private function researchDelete(Request $request)
    {
        $this->transaction();

        try {
            $member = ResearchPrize::findOrFail($request->sid);

            $member->delete();

            $this->dbCommit('연구상수상내역 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function researchindividualDelete(Request $request)
    {
        $this->transaction();

        try {
            $sid_arr = explode(',', $request->sid);
            foreach ($sid_arr as $sid){
                $member = ResearchPrize::findOrFail($sid);
                $member->delete();
            }

            $this->dbCommit('연구상수상내역 선택삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function sortChange(Request $request)
    {
        $this->transaction();
        try {
            $sid_arr = explode(',',$request->array_sid);
            $max_order = count($sid_arr);
            foreach ($sid_arr as $idx => $sid){
                $group = ResearchPrize::findOrFail($sid);
                $group->order = $max_order - $idx;
                $group->update();
            }

            $this->dbCommit('어드민 - 연구상수상내역 순서변경');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '순서가 수정되었습니다',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }
}
