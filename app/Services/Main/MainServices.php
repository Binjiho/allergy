<?php

namespace App\Services\Main;

use App\Models\Board;
use App\Services\AppServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class MainServices
 * @package App\Services
 */
class MainServices extends AppServices
{
    public function indexService(Request $request)
    {
        $exceptionBoardPopup = [];
        $allCookies = $request->cookies->all();

        foreach ($allCookies as $key => $val) {
            // 게시판 팝업 오늘하루 보지않기 있는지 체크
            if (strpos($key, 'board-popup-') !== false) {
                $boardSid = (int)str_replace('board-popup-', '', $key);
                $exceptionBoardPopup[] = $boardSid;
            }
        }
//TODO : 서버 이동 우선 막기
        // 게시판 팝업
        $this->data['boardPopupList'] = Board::withCount('files')
            ->where(['hide' => 'N', 'popup' => 'Y'])
            ->whereNotIn('sid', $exceptionBoardPopup)
            ->whereHas('popups', function ($q) {
                $q->where('popup_sDate', '<=', now()->format('Y-m-d'))
                    ->where('popup_eDate', '>=', now()->format('Y-m-d'));

            })
            ->get();

//TODO : 서버 이동 우선 막기
        // 메인 상단 게시판
        $query = Board::where(['hide' => 'N', 'main' => 'Y'])->whereIn('code', ['notice'])->orderByDesc('sid');
        if(!empty($request->category)){
            $query->where('category',$request->category);
        }else{
            $query->where('category',1);
        }
        $this->data['notice_list'] = $query->limit(4)->get();


        // 메인 중단 뉴스레터
        $this->data['newsletter'] = Board::where(['code' => 'newsletter', 'hide' => 'N', 'year'=>date('Y')])->orderByDesc('month')->first();
        // 메인 중단 진료지침
        $this->data['guideline'] = Board::where(['code' => 'guideline', 'hide' => 'N', 'main'=>'Y'])->orderByDesc('sid')->limit(2)->get();
        // 메인 중단 최신논문소식
        $this->data['absnews'] = Board::where(['code' => 'abs-news', 'hide' => 'N', 'main'=>'Y'])->orderByDesc('sid')->limit(2)->get();

        // 학술대회 일정
        $query = Board::where(['code' => 'event-schedule', 'hide' => 'N'])->orderBy('event_sDate');
        if (!empty($request->year)) {
            $query->whereYear('event_sDate', $request->year);
        }
        if (!empty($request->month)) {
            $query->whereMonth('event_sDate', $request->month);
        }
        $this->data['event_list'] = $query->get();

        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            default:
                return notFoundRedirect();
        }
    }
}
