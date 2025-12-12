<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Services\General\GeneralServices;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    private $generalServices;
    public function __construct()
    {
        $this->generalServices = (new GeneralServices());

        view()->share([
            'userConfig' => getConfig('user'),
            'main_menu' => 'M7',
        ]);
    }
    public function center(Request $request)
    {
        view()->share(['sub_menu' => 'S1']);
        return view('general.center');
    }

    public function hospitalSearch(Request $request)
    {
        view()->share(['sub_menu' => 'S2']);
        return view('general.hospitalSearch');
    }

    public function data(Request $request)
    {
        return $this->generalServices->dataAction($request);
    }
    
}
