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
        $show_list = ['subject','author','sosok','keywords','abstract','publisher'];

        if(!empty($request->show_list)){
            $show_list = $request->show_list;
        }
        
        $this->data['show_list'] = $show_list;

        $query = Journal::where('del','N');

        $searches = $request->search ?? [];
        $keywords = $request->keyword ?? [];

        // 💡 검색 조건 동적 처리 (배열을 순회하며 쿼리 연결)
        foreach ($searches as $index => $searchType) {
            $keyword = trim($keywords[$index] ?? '');

            // 1. 검색 유형과 키워드가 유효할 때만 처리
            if (empty($searchType) || empty($keyword)) {
                continue;
            }

            // 2. 연산자 결정 (두 번째 조건부터 'and' 또는 'or' 값 가져오기)
            $method = 'where';

            // 첫 번째 조건(index 0) 다음부터 추가 조건이 시작됩니다.
            if ($index > 0) {
                // 요청 변수 이름을 동적으로 구성 (예: index=1일 때 'and1')
                $operatorField = 'and' . $index;
                $operator = $request->$operatorField;

                // 연산자 값에 따라 메서드를 결정합니다. (기본은 AND, 즉 where)
                if ($operator === 'or') {
                    $method = 'orWhere';
                }
            }

            // 4. 필터링 로직 (클로저)
            $callback = function ($q) use ($searchType, $keyword) {
                switch ($searchType) {
                    case 'title':
                        $q->where('subject_kr', 'like', '%' . $keyword . '%')
                            ->orWhere('subject_en', 'like', '%' . $keyword . '%');
                        break;
                    case 'author':
                        $q->where('author_kr', 'like', '%' . $keyword . '%')
                            ->orWhere('author_en', 'like', '%' . $keyword . '%');
                        break;
                    case 'keywords':
                        $q->where('keywords', 'like', '%' . $keyword . '%');
                        break;
                    case 'abstract':
                        $q->where('abstract_kr', 'like', '%' . $keyword . '%')
                            ->orWhere('abstract_en', 'like', '%' . $keyword . '%');
                        break;
                }
            };

            // 5. 쿼리 빌더에 조건 적용
            $query->$method($callback);
        }

        if($request->sdate){
            $query->where('published_at','>=',$request->sdate);
        }
        if($request->edate){
            $query->where('published_at','<=',$request->edate);
        }

        if($request->orderby){
            if($request->orderby == 'year'){
                $query->orderByDesc($request->orderby);
            }else{
                $query->orderBy($request->orderby);
            }
        }

        $li_page = $request->li_page ?? 10;
        $this->data['li_page'] = $li_page;

        $list = $query->paginate($li_page)->appends($request->except(['page']));
        $this->data['list'] = setListSeq($list);

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

        $list = $query->paginate($li_page)->appends(request()->except(['page']));;
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
