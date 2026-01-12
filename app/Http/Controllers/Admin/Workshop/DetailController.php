<?php

namespace App\Http\Controllers\Admin\Workshop;

use App\Http\Controllers\Controller;
use App\Services\Admin\Workshop\DetailServices;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    private $detailServices;

    public function __construct()
    {
//        $this->workshopConfig = getConfig("workshop")[$work_code] ?? [];
        $this->detailServices = new DetailServices();

        view()->share([
            'main_key' => 'M4',
            'sub_key' => 'S2',
            'userConfig' => config('site.user'),
            'defaultConfig' => config('site.default-workshop'),
        ]);
    }

    public function index(Request $request)
    {
        return view("admin.workshop.detail.index", $this->detailServices->indexService($request));
    }

    public function upsert(Request $request)
    {
        return view("admin.workshop.detail.upsert", $this->detailServices->upsertService($request));
    }
    
    public function collective(Request $request)
    {
        return view("admin.workshop.detail.collective");
    }

    public function excel(Request $request)
    {
        $request->merge(['excel' => true]);
        return $this->detailServices->indexService($request, $request->case ?? 'all');
    }

    public function data(Request $request)
    {
        return $this->detailServices->dataAction($request);
    }
}
