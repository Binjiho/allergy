<?php

namespace App\Http\Controllers\Intro;

use App\Http\Controllers\Controller;
//use App\Services\Intro\IntroServices;
use Illuminate\Http\Request;

class IntroController extends Controller
{
    public function __construct()
    {

        view()->share([
            'userConfig' => getConfig('user'),
            'main_menu' => 'M1',
        ]);
    }
    public function greeting(Request $request)
    {
        view()->share(['sub_menu' => 'S1']);
        return view('intro.greeting');
    }

    public function history(Request $request)
    {
        view()->share(['sub_menu' => 'S2']);
        if(!empty($request->tab)){
            return view('intro.history'.$request->tab);
        }
        return view('intro.history');
    }

    public function mission(Request $request)
    {
        view()->share(['sub_menu' => 'S3']);
        return view('intro.mission');
    }
    public function regulation(Request $request)
    {
        view()->share(['sub_menu' => 'S4']);
        return view('intro.regulation');
    }
    public function executive(Request $request)
    {
        view()->share(['sub_menu' => 'S5']);
        if(!empty($request->tab)){
            return view('intro.executive'.$request->tab);
        }
        return view('intro.executive');
    }
    public function committee(Request $request)
    {
        view()->share(['sub_menu' => 'S6']);
        return view('intro.committee');
    }
    public function councilor(Request $request)
    {
        view()->share(['sub_menu' => 'S7']);
        return view('intro.councilor');
    }
    public function branch(Request $request)
    {
        view()->share(['sub_menu' => 'S8']);
        if(!empty($request->tab)){
            return view('intro.branch'.$request->tab);
        }
        return view('intro.branch');
    }
    public function research(Request $request)
    {
        view()->share(['sub_menu' => 'S9']);
        if(!empty($request->tab)){
            return view('intro.research'.$request->tab);
        }
        return view('intro.research');
    }
    public function direction(Request $request)
    {
        view()->share(['sub_menu' => 'S10']);
        return view('intro.direction');
    }
    
}
