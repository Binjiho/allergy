<?php

namespace App\Services\Journal;

use App\Models\User;
use App\Models\Journal;
use App\Models\Publication;

use App\Services\AppServices;
use App\Services\CommonServices;
use Illuminate\Http\Request;

/**
 * Class EventServices
 * @package App\Services
 */
class JournalServices extends AppServices
{
    public function indexService(Request $request)
    {
        $query = Publication::where('del', 'N')->orderByDesc('sid');

        if(isAdmin() == false){
            $query->where('hide','N');
        }

        if ($request->keyword) {
            $query->where(function ($q) use($request) {
                $q->where('title', 'like', "%{$request->keyword}%")
                    ->orWhere('name_kr', 'like', "%{$request->keyword}%")
                    ->orWhere('location', 'like', "%{$request->keyword}%")
                    ->orWhere('url', 'like', "%{$request->keyword}%");
            });
        }

        $list = $query->paginate(9999)->appends(request()->except(['page']));
        $this->data['list'] = setListSeq($list);

        return $this->data;
    }

    public function upsertService(Request $request)
    {
        $sid = $request->sid ?? null;
        $this->data['publication'] = empty($sid) ? null : Publication::findOrFail($sid);

        return $this->data;
    }
    public function searchService(Request $request)
    {
        $this->data['list'] = [];

        if($request->keyword1 || $request->keyword2 || $request->keyword3 || $request->keyword4){
            $query = Journal::where('del','N');

            if($request->year1){
                $query->where('year','>=',$request->year1);
            }
            if($request->year2){
                $query->where('year','<=',$request->year2);
            }

            if ($request->search1 && $request->keyword1) {
                if($request->search1 == 'authork'){
                    $query->where(function ($q) use ($request) {
                        $q->where('authork', 'like', '%' . trim($request->keyword1) . '%')
                            ->orWhere('author_common', 'like', '%' . trim($request->keyword1) . '%')
                            ->orWhere('exchange_author', 'like', '%' . trim($request->keyword1) . '%');
                    });
                } else{
                    $query->where($request->search1, 'like', '%' . trim($request->keyword1) . '%');
                }
            }

            if ($request->search2 && $request->keyword2) {
                $query->where($request->search2, 'like', '%' . trim($request->keyword2) . '%');
            }

            if($request->order){
                if($request->order == 'year'){
                    $query->orderByDesc($request->order);
                }else{
                    $query->orderBy($request->order);
                }
            }

            $li_page = $request->li_page ?? 10;
            $this->data['li_page'] = $li_page;

            $list = $query->paginate($li_page);
            $this->data['list'] = setListSeq($list);
        }

        return $this->data;
    }

    public function kwonListService(Request $request)
    {
        $query = Journal::where('del','N')->orderBy('regnum');

        if(!empty($request->vol)){
            $query->where('vol','=',$request->vol);
        }
        if(!empty($request->num)){
            $query->where('num','=',$request->num);
        }

        $li_page = $request->li_page ?? 10;
        $this->data['li_page'] = $li_page;

        $list = $query->paginate($li_page);
        $this->data['list'] = setListSeq($list);

        return $this->data;
    }


    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'add-search':
                return $this->addSearchServices($request);
            case 'publication-create':
                return $this->publicationCreate($request);
            case 'publication-update':
                return $this->publicationUpdate($request);
            case 'publication-delete':
                return $this->publicationDelete($request);
            case 'publication-fileDelete':
                return $this->publicationFileDelete($request);
            case 'publication-hide':
                return $this->publicationHide($request);
            default:
                return notFoundRedirect();
        }
    }

    private function publicationCreate(Request $request)
    {
        $this->transaction();

        try {
            $member = (new Publication());
            $member->setByData($request);
            $member->save();

            $this->dbCommit('교과서 단건 등록');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '등록 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function publicationUpdate(Request $request)
    {
        $this->transaction();

        try {
            $member = Publication::findOrFail($request->sid);

            $member->setByData($request);
            $member->update();

            $this->dbCommit('교과서 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }

    private function publicationDelete(Request $request)
    {
        $this->transaction();

        try {
            $member = Publication::findOrFail($request->sid);

            $member->del = 'Y';
            $member->update();

            $this->dbCommit('교과서 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }
    private function publicationFileDelete(Request $request)
    {
        $this->transaction();

        try {
            $member = Publication::findOrFail($request->sid);

            $member->filename = null;
            $member->realfile = null;
            $member->update();

            $this->dbCommit('교과서 첨부파일 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }
    private function publicationHide(Request $request)
    {
        $this->transaction();

        try {
            $member = Publication::findOrFail($request->sid);

            $member->hide = $request->val;
            $member->update();

            $this->dbCommit('교과서 공개값 변경');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function addSearchServices(Request $request)
    {
        $this->data['eq'] = $request->eq;

        $this->setJsonData('addCss', [
            $this->ajaxActionCss('.and_div', 'display', 'inline-flex'),
        ]);

        return $this->returnJsonData('after', [
            $this->ajaxActionHtml('.search_tr:last', view('journal.search.insert_search', $this->data)->render()),
        ]);
    }
}
