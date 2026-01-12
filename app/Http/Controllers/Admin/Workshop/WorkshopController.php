<?php

namespace App\Http\Controllers\Admin\Workshop;

use App\Http\Controllers\Controller;
use App\Services\Admin\Workshop\WorkshopServices;
use Illuminate\Http\Request;

class WorkshopController extends Controller
{
    private $workshopServices;

    public function __construct()
    {
        $this->workshopServices = new WorkshopServices();

        view()->share([
            'main_key' => 'M3',
            'sub_key' => 'S1',
            'userConfig' => config('site.user'),
            'defaultConfig' => config('site.default-workshop'),
        ]);
    }

    public function index(Request $request)
    {
        return view('admin.workshop.index', $this->workshopServices->indexService($request));
    }

    public function upsert(Request $request)
    {
        return view('admin.workshop.upsert', $this->workshopServices->upsertService($request));
    }

    public function data(Request $request)
    {
        return $this->workshopServices->dataAction($request);
    }
}
