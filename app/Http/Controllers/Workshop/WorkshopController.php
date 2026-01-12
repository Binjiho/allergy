<?php

namespace App\Http\Controllers\Workshop;

use App\Http\Controllers\Controller;
use App\Services\Workshop\WorkshopServices;
use Illuminate\Http\Request;

class WorkshopController extends Controller
{
    private $workshopServices;

    public function __construct()
    {
        $this->workshopServices = new WorkshopServices();

        view()->share([
            'userConfig' => getConfig('user'),
            'main_menu' => 'M5',
            'defaultConfig' => config('site.default-workshop'),
            'wsid' => request()->wsid,
        ]);
    }
    public function overseas(Request $request)
    {
        view()->share(['sub_menu' => 'S2']);
        if (!thisPK() ) {
            $ret_url = $request->path();
            authRedirect( $ret_url );
        }
        return view('conference.overseas');
    }

    public function education(Request $request)
    {
        view()->share(['sub_menu' => 'S4']);
        return view('conference.workshop.index', $this->workshopServices->indexService($request));
    }
    

    public function upsert(Request $request)
    {
        view()->share(['sub_menu' => 'S4']);

        return view('conference.workshop.upsert', $this->workshopServices->upsertService($request));
    }

    public function detail(Request $request)
    {
        view()->share(['sub_menu' => 'S4']);

        return view('conference.workshop.detail.index', $this->workshopServices->detailService($request));
    }

    public function data(Request $request)
    {
        return $this->workshopServices->dataAction($request);
    }
}
