<?php

namespace App\Http\Controllers\Admin\Overseas;

use App\Http\Controllers\Controller;
use App\Services\Admin\Overseas\OverseasServices;
use Illuminate\Http\Request;

class OverseasController extends Controller
{
    private $overseasServices;

    public function __construct()
    {
//        $this->workshopConfig = getConfig("workshop")[$work_code] ?? [];
        $this->overseasServices = new OverseasServices();

        view()->share([
            'main_key' => 'M3',
            'sub_key' => 'S1',
            'userConfig' => config('site.user'),
            'defaultConfig' => config('site.default-workshop'),
        ]);
    }

    public function index(Request $request)
    {
        return view("admin.overseas.index", $this->overseasServices->indexService($request));
    }

    public function upsert(Request $request)
    {
        return view("admin.overseas.upsert", $this->overseasServices->upsertService($request));
    }
    
    public function collective(Request $request)
    {
        return view("admin.overseas.collective");
    }

    public function excel(Request $request)
    {
        $request->merge(['excel' => true]);
        return $this->overseasServices->indexService($request, $request->case ?? 'all');
    }

    public function data(Request $request)
    {
        return $this->overseasServices->dataAction($request);
    }
}
