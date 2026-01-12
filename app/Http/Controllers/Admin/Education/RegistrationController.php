<?php

namespace App\Http\Controllers\Admin\Education;

use App\Http\Controllers\Controller;
use App\Services\Admin\Education\RegistrationServices;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    private $registrationServices;

    public function __construct()
    {
//        $this->workshopConfig = getConfig("workshop")[$work_code] ?? [];
        $this->registrationServices = new RegistrationServices();

        view()->share([
            'main_key' => 'M4',
            'sub_key' => 'S2',
            'userConfig' => config('site.user'),
            'defaultConfig' => config('site.default-workshop'),
        ]);
    }

    public function index(Request $request)
    {
        return view("admin.education.registration.index", $this->registrationServices->indexService($request));
    }

    public function upsert(Request $request)
    {
        return view("admin.education.registration.upsert", $this->registrationServices->upsertService($request));
    }

    public function office_search(Request $request)
    {
        return view("conference.education.detail.registration.office_search", $this->registrationServices->officeSearchService($request));
    }


    public function receipt(Request $request)
    {
        return view("admin.education.registration.receipt", $this->registrationServices->upsertService($request));
    }

    public function memo(Request $request)
    {
        return view("admin.education.registration.memo", $this->registrationServices->upsertService($request));
    }
    public function resend(Request $request)
    {
        return view("admin.education.registration.resend", $this->registrationServices->upsertService($request));
    }

    public function collective(Request $request)
    {
        return view("admin.education.registration.collective");
    }

    public function excel(Request $request)
    {
        $request->merge(['excel' => true]);
        return $this->registrationServices->indexService($request, $request->case ?? 'all');
    }

    public function data(Request $request)
    {
        return $this->registrationServices->dataAction($request);
    }
}
