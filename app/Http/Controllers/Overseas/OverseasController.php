<?php

namespace App\Http\Controllers\Overseas;

use App\Http\Controllers\Controller;
use App\Services\Overseas\OverseasServices;
use Illuminate\Http\Request;

class OverseasController extends Controller
{
    private $overseasServices;

    public function __construct()
    {
        $this->overseasServices = new OverseasServices();

        view()->share([
            'userConfig' => getConfig('user'),
            'main_menu' => 'M5',
            'overseasConfig' => config('site.overseas'),
        ]);
    }
    public function index(Request $request)
    {
        view()->share(['sub_menu' => 'S2']);
        return view('overseas.index', $this->overseasServices->indexService($request));
    }

    public function guide(Request $request)
    {
        view()->share(['sub_menu' => 'S2']);
        return view('overseas.guide', $this->overseasServices->indexService($request));
    }

    public function preview(Request $request)
    {
        view()->share(['sub_menu' => 'S2']);
        if (!thisPK() ) {
            $ret_url = $request->path();
            authRedirect( $ret_url, "회원 로그인 후 신청 가능합니다." );
        }
        return view('overseas.preview', $this->overseasServices->previewService($request));
    }
    
    public function search(Request $request)
    {
        view()->share(['sub_menu' => 'S2']);
        if (!thisPK() ) {
            $ret_url = $request->path();
            authRedirect( $ret_url, "회원 로그인 후 신청 가능합니다." );
        }
        return view('overseas.search', $this->overseasServices->searchService($request));
    }

    public function upsert(Request $request)
    {
        view()->share(['sub_menu' => 'S2']);
        if (!thisPK() ) {
            $ret_url = $request->path();
            authRedirect( $ret_url, "회원 로그인 후 신청 가능합니다." );
        }
        return view('overseas.upsert', $this->overseasServices->upsertService($request));
    }

    public function modify(Request $request)
    {
        view()->share(['sub_menu' => 'S2']);
        if (!thisPK() ) {
            $ret_url = $request->path();
            authRedirect( $ret_url, "회원 로그인 후 신청 가능합니다." );
        }
        return view('overseas.modify', $this->overseasServices->modifyService($request));
    }

    public function report(Request $request)
    {
        view()->share(['sub_menu' => 'S2']);
        if (!thisPK() ) {
            $ret_url = $request->path();
            authRedirect( $ret_url, "회원 로그인 후 신청 가능합니다." );
        }
        return view('overseas.report.upsert', $this->overseasServices->reportService($request));
    }

    public function report_modify(Request $request)
    {
        view()->share(['sub_menu' => 'S2']);
        if (!thisPK() ) {
            $ret_url = $request->path();
            authRedirect( $ret_url, "회원 로그인 후 신청 가능합니다." );
        }
        return view('overseas.report.modify', $this->overseasServices->reportService($request));
    }


    public function report_preview(Request $request)
    {
        view()->share(['sub_menu' => 'S2']);
        if (!thisPK() ) {
            $ret_url = $request->path();
            authRedirect( $ret_url, "회원 로그인 후 신청 가능합니다." );
        }
        return view('overseas.report.preview', $this->overseasServices->reportService($request));
    }

    public function data(Request $request)
    {
        return $this->overseasServices->dataAction($request);
    }
}
