<?php

namespace App\Http\Controllers\Admin\Education;

use App\Http\Controllers\Controller;
use App\Services\Admin\Education\EducationServices;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    private $educationServices;

    public function __construct()
    {
        $this->educationServices = new EducationServices();

        view()->share([
            'main_key' => 'M4',
            'sub_key' => 'S2',
            'userConfig' => config('site.user'),
            'defaultConfig' => config('site.default-workshop'),
        ]);
    }

    public function index(Request $request)
    {
        return view('admin.education.index', $this->educationServices->indexService($request));
    }

    public function upsert(Request $request)
    {
        return view('admin.education.upsert', $this->educationServices->upsertService($request));
    }

    public function data(Request $request)
    {
        return $this->educationServices->dataAction($request);
    }
}
