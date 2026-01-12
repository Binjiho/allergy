<?php

namespace App\Services\Board;

use App\Models\Board;
use App\Models\Heart;
use App\Models\BoardComment;
use App\Models\BoardFile;
use App\Models\BoardPopup;
use App\Models\BoardCounter;
use App\Models\BoardReply;
use App\Models\BoardReplyCounter;
use App\Models\BoardReplyFile;
use App\Services\AppServices;
use Illuminate\Http\Request;

/**
 * Class BoardServices
 * @package App\Services
 */
class BoardServices extends AppServices
{
    private $boardConfig;

    public function __construct()
    {
        $this->boardConfig = getConfig('board')[request()->code] ?? [];
    }
    private function getNoticeList($code)
    {
        $noticeQuery = Board::where([
            'code' => $code,
            'notice' => 'Y'
        ])
            ->withCount('files', 'comments')
            ->orderByDesc('sid');

        if (!isAdmin()) {
            $noticeQuery->where('hide', 'N');
        }

        return $noticeQuery->limit('10');
    }

    public function listService(Request $request)
    {
        $code = $request->code;
        $category = $request->category;
        $search = $request->search;
        $keyword = $request->keyword;
        $boardConfig = getConfig("board")[$code];

        if ($code == 'event-schedule') {
            // 학술대회 일정
            return $this->eventSchedule($request);
        }

        $query = Board::where('code', $code)->withCount('files', 'comments');

        if ($code == 'photo' || $code == 'past-workshop' || $code == 'overseas-workshop' || $code == 'domestic') {
            $query->orderByDesc('event_sDate'); // 학술대회 일정
        }else if ($code == 'newsletter') {
            $query->orderByDesc('year')->orderByDesc('month'); // 뉴스레터
        }else if ($code == 'treatment') {
            $query->orderByDesc('year')->orderByDesc('sid'); // 진료지침 게시판
        }else if ($code == 'branch' || $code == 'research-team') {
            $query->orderByDesc('created_at'); // 지회 게시판
        }else if ($code == 'notice') {
            $query->orderByDesc('created_at')->orderByDesc('sid'); // 공지사항 게시판
        } else {
            $query->orderByDesc('sid');
        }

        if ($code == 'treatment') {
            $query->where('gubun', $request->gubun); // 진료지침 게시판
        }

        if (!empty($category)) {
            $query->where('category', $category);
        }
        if (!isAdmin()) {
            $query->where('hide', 'N');
        }


        if ($request->filled('field')) {
            $fieldArr = $request->field; // 배열
            $query->where(function($q) use ($fieldArr) {
                foreach ($fieldArr as $val) {
                    $q->orWhere('field', 'like', "%{$val}%");
                }
            });
        }

        if (!empty($request->year)) {
            $query->where('year', $request->year);
        }


        if (!empty($search) && !empty($keyword)) {
            switch ($search) {
                case 'subject/contents':
                    $query->where(function ($q) use ($keyword) {
                        $q->where('subject', 'like', "%{$keyword}%")
                            ->orWhere('contents', 'like', "%{$keyword}%");
                    });
                    break;

                case 'ALL'/*진료지침*/:
                    $query->where(function ($q) use ($keyword) {
                        $q->where('subject', 'like', "%{$keyword}%")
                            ->orWhere('contents', 'like', "%{$keyword}%")
                            ->orWhere('author', 'like', "%{$keyword}%");
                    });
                    break;

                case 'year/subject':
                    $query->where(function ($q) use ($keyword) {
                        $q->where('year', 'like', "%{$keyword}%")
                            ->orWhere('subject', 'like', "%{$keyword}%");
                    });
                    break;

                default:
                    $query->where($search, 'like', "%{$keyword}%");
                    break;
            }
        }

        if ($request->bookmark) {
            $user_sid = thisPK();
            $query->whereHas('hearts', function ($q) use ($user_sid) {
                $q->where('user_sid', $user_sid);
            });
        }

        // 게시판 공지 사항 사용시 공지사항 리스트 추가 & 공지사항 제외하고 리스트 뽑기
        if ($boardConfig['use']['notice']) {
            $noticeQuery = $this->getNoticeList($code);

            if (!empty($category)) {
                $noticeQuery->where('category', $category);
            }

            if ($request->bookmark) {
                $user_sid = thisPK();
                $noticeQuery->whereHas('hearts', function ($q) use ($user_sid) {
                    $q->where('user_sid', $user_sid);
                });
            }

            $this->data['notice_list'] = $noticeQuery->get();
            $query->whereNotIn('sid', $this->data['notice_list']->pluck('sid'));
        }

        $this->data['tot_cnt'] = (clone $query)->count();

        $list = $query->paginate($boardConfig['paginate'])->appends($request->except(['page']));

        $this->data['list'] = setListSeq($list);

        return $this->data;
    }

    public function eventSchedule(Request $request)
    {
        $code = $request->code;
        $year = $request->year ?? now()->format('Y');
        $month = $request->month ?? '';
        $gubun = $request->gubun ?? '';
        $category = $request->category;
//        $minYear = now()->subYear(2)->format('Y');
//        $maxYear = now()->addYear(2)->format('Y');
        $minYear = ($year - 2);
        $maxYear = ($year + 2);

        $boardConfig = getConfig("board")[$code];

        $query = Board::where('code', $code)->withCount('files')->orderBy('event_sDate');

        if (!isAdmin()) {
            $query->where('hide', 'N');
        }

        if (!empty($year)) {
            $query->whereYear('event_sDate', $year);
        }

        if (!empty($month)) {
            $query->whereMonth('event_sDate', $month);
        }

        if (!empty($gubun)) {
            $query->where('gubun', $gubun);
        }
        if (!empty($category)) {
            $query->where('category', $category);
        }

        if ($request->bookmark) {
            $user_sid = thisPK();
            $query->whereHas('hearts', function ($q) use ($user_sid) {
                $q->where('user_sid', $user_sid);
            });
        }

        // ->appends($request->except(['page'])) 없이 사용시 페이징에 파라미터 풀려서 추가 20251218 한상혁
        $list = $query->paginate($boardConfig['paginate'])->appends($request->except(['page']));
        $this->data['list'] = setListSeq($list);

        $this->data['year'] = $year;
        $this->data['month'] = $month;
        $this->data['gubun'] = $gubun;
        $this->data['minYear'] = $minYear;
        $this->data['maxYear'] = $maxYear;

        return $this->data;
    }

    public function upsertService(Request $request)
    {
        $sid = $request->sid ?? null;
        $this->data['board'] = empty($sid) ? null : Board::withCount('files')->findOrFail($sid);
        $this->data['popup'] = $this->data['board']->popups ?? null;

        return $this->data;
    }

    public function viewService(Request $request)
    {
        $this->data['board'] = Board::withCount('files', 'comments')->findOrFail($request->sid);
        $this->refCounter($request); // 조회수 업데이트

        // 댓글 사용시
        if ($this->boardConfig['use']['comment']) {
            $this->data['comments'] = $this->data['board']->comments()
                ->where([
                    'depth1' => 0,
                    'depth2' => 0,
                ])->paginate($this->boardConfig['comment_paginate'])->appends($request->query());
        }

        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'board-create':
                return $this->boardCreate($request);

            case 'board-update':
                return $this->boardUpdate($request);

            case 'board-delete':
                return $this->boardDelete($request);

            case 'db-change':
                return $this->dbChange($request);

            case 'popup-preview':
                return $this->popupPreview($request);

            case 'change-heart':
                return $this->changeHeart($request);

            case 'comment-postform':
                return $this->commentPostform($request);

            case 'comment-create':
                return $this->commentCreate($request);

            case 'comment-update':
                return $this->commentUpdate($request);

            case 'comment-delete':
                return $this->commentDelete($request);

            default:
                return notFoundRedirect();
        }
    }

    private function listUrl()
    {
        if(!empty(request()->category)){
            return route('board', ['code' => request()->code, 'category'=>request()->category ]);
        }
        return route('board', ['code' => request()->code]);
    }

    private function boardCreate(Request $request)
    {
        $this->transaction();

        try {
            $board = new Board();
            $board->setByData($request);
            $board->save();

            $this->dbCommit("게시글 등록");

            $ret_url = $this->listUrl();
            if ($request->code == 'treatment') {
                $ret_url = route('board', ['code' => request()->code, 'gubun'=>$request->gubun]);
            }

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '게시글이 등록 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', $ret_url),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function boardUpdate(Request $request)
    {
        $this->transaction();

        try {
            $board = Board::findOrFail($request->sid);
            $board->setByData($request);
            $board->update();

            $this->dbCommit('게시글 수정');

            $ret_url = $this->listUrl();
            if ($request->code == 'treatment') {
                $ret_url = route('board', ['code' => request()->code, 'gubun'=>$request->gubun]);
            }

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '게시글이 수정 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', $ret_url),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function boardDelete(Request $request)
    {
        $this->transaction();

        try {
            $board = Board::findOrFail($request->sid);
            $board->delete();

            $this->dbCommit('게시글 삭제');

            $ret_url = $this->listUrl();
            if ($request->code == 'treatment') {
                $ret_url = route('board', ['code' => request()->code, 'gubun'=>$request->gubun]);
            }

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '게시글이 삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', $ret_url),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function dbChange(Request $request)
    {
        $this->transaction();

        try {
            $board = Board::findOrFail($request->sid);
            $board->{$request->column} = $request->value;
            $board->update();

            $this->dbCommit('게시글 부분 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function popupPreview(Request $request)
    {
        $files = [];
        $popupSkin = $request->popup_skin;

        if ($request->sid != 0) {
            foreach (BoardFile::where('bsid', $request->sid)->whereNotIn('sid', $request->plupload_file_del ?? [])->get() as $row) {
                $files[] = (object)['filename' => $row->filename, 'download' => $row->download];
            }
        }

        foreach ($request->plupload ?? [] as $key => $val) {
            $files[] = (object)['filename' => $val, 'download' => 0];
        }

        $this->data['board'] = (object)$request->all();
        $this->data['board']->files = $files;
        $this->data['board']->files_count = count($files);

        $this->data['popup'] = (object)[
            'width' => $request->width ?? 500,
            'height' => $request->height ?? 400,
            'position_x' => $request->position_x ?? 0,
            'position_y' => $request->position_y ?? 0,
            'popup_detail' => $request->popup_detail ?? '',
            'popup_link' => $request->popup_link ?? '',
            'popup_skin' => $popupSkin,
            'popup_contents' => ($request->popup_select == '1') ? $request->contents : $request->popup_contents,
        ];

        $this->data['preview'] = true;

        return $this->returnJsonData('append', [
            $this->ajaxActionHtml('body', view("common.board.popup.template{$popupSkin}", $this->data)->render()),
        ]);
    }

    private function refCounter(Request $request)
    {
        // ip 기준으로 조회수 하루에 한번씩
        $check = BoardCounter::whereRaw("DATE_FORMAT(created_at, '%Y%m%d') = ?", [now()->format('Ymd')])
            ->where([
                'bsid' => $request->sid,
                'ip' => $request->ip()
            ])->exists();


        if (!$check) {
            $boardCounter = new BoardCounter();
            $boardCounter->setByData($request);
            $boardCounter->save();

            $this->data['board']->increment('ref');
        }
    }

    private function changeHeart(Request $request)
    {
        $this->transaction();

        try {
            $heart = Heart::where(['user_sid'=>thisPK(), 'bsid'=>$request->sid])->first();
            if($heart){
                $heart->delete();
                $target_msg = "책갈피 설정이 해제되었습니다.";
            }else{
                $heart = (new Heart());
                $request->merge([ 'user_sid' => thisPk(), 'bsid'=>$request->sid ]);
                $heart->setByData($request);
                $heart->save();
                $target_msg = "책갈피 설정되었습니다.";
            }

            $this->dbCommit('책갈피 신청');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => $target_msg,
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e,true);
        }
    }

    private function commentPostform(Request $request)
    {
        $sid = $request->sid;
        $b_sid = $request->b_sid;
        $action = $request->action;

        switch ($action) {
            case 'create': // 등록
                $reqDepth1 = $request->depth1;
                $reqDepth2 = $request->depth2;

                $depth1 = $reqDepth1;
                $depth2 = 0;

                if ($depth1 == 0) {
                    $depth1 = $sid;
                }

                if ($reqDepth1 != 0 && $reqDepth2 == 0) {
                    $depth2 = $sid;
                }

                $comment = (object)[
                    'depth1' => $depth1, // 1차 상위 댓글 sid
                    'depth2' => $depth2, // 2차 상위 댓글 sid
                ];
                break;

            case 'update': // 수정
                $comment = BoardComment::where('b_sid', $b_sid)->findOrFail($sid);
                break;

            default:
                return notFoundRedirect();
        }

        $this->data['action'] = $action;
        $this->data['comment'] = $comment;

        $view = view("board.{$request->code}.comment.upsert", $this->data)->render();

        return $this->returnJsonData('upsert', $view);
    }

    private function commentCreate(Request $request)
    {
//        dd($request->all());
        $this->transaction();

        try {
            $comment = new BoardComment();
            $comment->setByData($request);
            $comment->save();

            $this->dbCommit("댓글 등록");

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '댓글이 등록 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function commentUpdate(Request $request)
    {
        $this->transaction();

        try {
            $comment = BoardComment::where('b_sid', $request->b_sid)->findOrFail($request->sid);
            $comment->setByData($request);
            $comment->update();

            $this->dbCommit("댓글 수정");

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '댓글이 수정 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function commentDelete(Request $request)
    {
        $this->transaction();

        try {
            $comment = BoardComment::where('b_sid', $request->b_sid)->findOrFail($request->sid);
            $comment->delete();

            $this->dbCommit("댓글 삭제");

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '댓글이 삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }
}
