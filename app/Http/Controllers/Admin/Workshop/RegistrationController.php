<?php

namespace App\Http\Controllers\Admin\Workshop;

use App\Http\Controllers\Controller;
use App\Services\Admin\Workshop\RegistrationServices;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    private $registrationServices;

    public function __construct()
    {
//        $this->workshopConfig = getConfig("workshop")[$work_code] ?? [];
        $this->registrationServices = new RegistrationServices();

        view()->share([
            'main_key' => 'M3',
            'sub_key' => 'S2',
            'userConfig' => config('site.user'),
            'defaultConfig' => config('site.default-workshop'),
        ]);
    }

    public function index(Request $request)
    {
        return view("admin.workshop.registration.index", $this->registrationServices->indexService($request));
    }

    public function upsert(Request $request)
    {
        return view("admin.workshop.registration.upsert", $this->registrationServices->upsertService($request));
    }

    public function office_search(Request $request)
    {
        return view("conference.workshop.detail.registration.office_search", $this->registrationServices->officeSearchService($request));
    }


    public function receipt(Request $request)
    {
        return view("admin.workshop.registration.receipt", $this->registrationServices->upsertService($request));
    }

    public function memo(Request $request)
    {
        return view("admin.workshop.registration.memo", $this->registrationServices->upsertService($request));
    }
    public function resend(Request $request)
    {
        return view("admin.workshop.registration.resend", $this->registrationServices->upsertService($request));
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
