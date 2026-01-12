<?php

namespace App\Http\Controllers\Admin\Overseas;

use App\Http\Controllers\Controller;
use App\Services\Admin\Overseas\ApplyServices;
use Illuminate\Http\Request;

class ApplyController extends Controller
{
    private $applyServices;

    public function __construct()
    {
        $this->applyServices = new ApplyServices();

        view()->share([
            'main_menu' => 'M3',
            'userConfig' => config('site.user'),
            'overseasConfig' => getConfig('overseas'),
        ]);
    }

    public function index(Request $request)
    {
        return view("admin.overseas.apply.index", $this->applyServices->indexService($request));
    }

    public function modify(Request $request)
    {
        return view("admin.overseas.apply.modify", $this->applyServices->modifyService($request));
    }

    public function report_modify(Request $request)
    {
        return view("admin.overseas.apply.report_modify", $this->applyServices->modifyService($request));
    }

    public function memo(Request $request)
    {
        return view("admin.overseas.apply.memo", $this->applyServices->popupService($request));
    }
    public function allJudgeChange(Request $request)
    {
        return view("admin.overseas.apply.all-audit-change", $this->applyServices->allJudgeChangeService($request));
    }

//    public function search(Request $request)
//    {
//        return view("workshop.{$request->work_code}.registration.search", $this->registrationServices->popupService($request));
//    }

    public function completeZip(Request $request)
    {
        $request->merge(['completeZip' => true]);
        return $this->applyServices->indexService($request, $request->case ?? 'all');
    }

    public function reportZip(Request $request)
    {
        $request->merge(['reportZip' => true]);
        return $this->applyServices->indexService($request, $request->case ?? 'all');
    }

    public function excel(Request $request)
    {
        $request->merge(['excel' => true]);
        return $this->applyServices->indexService($request, $request->case ?? 'all');
    }

    public function data(Request $request)
    {
        return $this->applyServices->dataAction($request);
    }
}
