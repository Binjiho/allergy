<?php

namespace App\Http\Controllers\Workshop;

use App\Http\Controllers\Controller;
use App\Services\Workshop\RegistrationServices;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    private $registrationServices;

    public function __construct()
    {
        $wsid = request()->wsid ?? '';
        $this->registrationServices = new RegistrationServices();

        view()->share([
            'main_menu' => 'M5',
            'sub_menu' => 'S4',
            'userConfig' => config('site.user'),
            'wsid' => $wsid,
            'defaultConfig' => config('site.default-workshop'),
        ]);
    }

    public function index(Request $request)
    {
        return view("conference.workshop.detail.registration.index", $this->registrationServices->indexService($request));
    }

    //등록
    public function upsert(Request $request)
    {
        return view("conference.workshop.detail.registration.upsert", $this->registrationServices->upsertService($request));
    }
    public function preview(Request $request)
    {
        return view("conference.workshop.detail.registration.preview", $this->registrationServices->indexService($request));
    }
    public function complete(Request $request)
    {
        return view("conference.workshop.detail.registration.complete", $this->registrationServices->indexService($request));
    }
    public function office_search(Request $request)
    {
        return view("conference.workshop.detail.registration.office_search", $this->registrationServices->officeSearchService($request));
    }

    //조회
    public function search(Request $request)
    {
        return view("conference.workshop.detail.registration.search", $this->registrationServices->indexService($request));
    }
    public function search_result(Request $request)
    {
        return view("conference.workshop.detail.registration.search_result", $this->registrationServices->indexService($request));
    }
    public function receipt(Request $request)
    {
        return view("conference.workshop.detail.registration.receipt", $this->registrationServices->indexService($request));
    }



    public function data(Request $request)
    {
        return $this->registrationServices->dataAction($request);
    }
}
