<?php

namespace App\Http\Controllers\Admin\Grantees;

use App\Http\Controllers\Controller;
use App\Services\Admin\Grantees\GranteesServices;
use Illuminate\Http\Request;

class GranteesController extends Controller
{
    private $granteesServices;

    public function __construct()
    {
        $this->granteesServices = new GranteesServices();

        view()->share([
            'main_key' => 'M3',
            'sub_key' => 'S1',
            'userConfig' => config('site.user'),
            'overseasConfig' => config('site.overseas'),
        ]);
    }

    public function index(Request $request)
    {
        return view("admin.overseas.grantees.index", $this->granteesServices->indexService($request));
    }

    public function upsert(Request $request)
    {
        return view("admin.overseas.grantees.upsert", $this->granteesServices->upsertService($request));
    }

    public function memo(Request $request)
    {
        return view("admin.overseas.grantees.memo", $this->granteesServices->upsertService($request));
    }
    
    public function collective(Request $request)
    {
        return view("admin.overseas.grantees.collective");
    }

    public function excel(Request $request)
    {
        $request->merge(['excel' => true]);
        return $this->granteesServices->indexService($request, $request->case ?? 'all');
    }

    public function data(Request $request)
    {
        return $this->granteesServices->dataAction($request);
    }
}
