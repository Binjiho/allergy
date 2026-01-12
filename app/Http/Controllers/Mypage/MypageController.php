<?php

namespace App\Http\Controllers\Mypage;

use App\Http\Controllers\Controller;
use App\Services\Mypage\MypageServices;
use App\Services\Board\BoardServices;
use Illuminate\Http\Request;

class MypageController extends Controller
{
    private $mypageServices;
    private $boardServices;

    public function __construct()
    {
        $this->mypageServices = (new MypageServices());
        $this->boardServices = (new BoardServices());

        view()->share([
            'main_menu' => 'MYPAGE',
            'userConfig' => getConfig('user'),
        ]);

//        if (!thisPK() ) {
//            return view("auth.login");
//        }
    }

    public function intro(Request $request)
    {
        view()->share(['sub_menu' => 'S6']);
        return view('mypage.intro', $this->mypageServices->indexService($request));
    }

    //회원찾기
    public function member_search(Request $request)
    {
        view()->share(['sub_menu' => 'S11']);

        return view('mypage.member_search', $this->mypageServices->searchService($request));
    }

    //개인정보수정
    public function pwCheck(Request $request)
    {
        view()->share(['sub_menu' => 'S7']);
        return view('mypage.pwCheck', $this->mypageServices->indexService($request));
    }
    public function modify(Request $request)
    {
        view()->share(['sub_menu' => 'S7']);
        return view('mypage.modify', $this->mypageServices->upsertService($request));
    }

    //비밀번호변경
    public function password(Request $request)
    {
        view()->share(['sub_menu' => 'S8']);
        return view('mypage.password', $this->mypageServices->indexService($request));
    }
    public function repassword(Request $request)
    {
        view()->share(['sub_menu' => 'S8']);
        return view('mypage.repassword', $this->mypageServices->indexService($request));
    }

    //학술대회 참석현황
    public function certi(Request $request)
    {
        view()->share(['sub_menu' => 'S10']);
        return view('mypage.certi', $this->mypageServices->certiService($request));
    }
    public function certiReceipt(Request $request)
    {
        view()->share(['sub_menu' => 'S4']);
        return view('mypage.certiReceipt', $this->mypageServices->certiReceiptService($request));
    }

    //책갈피
    public function bookmark(Request $request)
    {
        $code = request()->code ?? '';
        $this->boardConfig = getConfig("board")[$code] ?? [];

        view()->share([
            'sub_menu' => 'S12',
            'code' => $code,
            'boardConfig' => $this->boardConfig,
        ]);

        //책갈피 사용
        $request->merge(['bookmark' => true]);

        return view('mypage.bookmark', $this->boardServices->listService($request));
    }


    //회원탈퇴
    public function withdraw(Request $request)
    {
        view()->share(['sub_menu' => 'S13']);
        return view('mypage.withdraw', $this->mypageServices->indexService($request));
    }


    public function data(Request $request)
    {
        return $this->mypageServices->dataAction($request);
    }
}
