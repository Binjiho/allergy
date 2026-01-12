<?php

namespace App\Http\Controllers\Eng\About;

use App\Http\Controllers\Controller;
//use App\Services\Intro\IntroServices;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __construct()
    {

        view()->share([
            'userConfig' => getConfig('user'),
            'main_menu' => 'M1',
        ]);
    }
    public function welcome(Request $request)
    {
        view()->share(['sub_menu' => 'S1']);
        return view('eng.about.welcome');
    }

    public function history(Request $request)
    {
        view()->share(['sub_menu' => 'S2']);
        return view('eng.about.history');
    }
    public function journal(Request $request)
    {
        view()->share(['sub_menu' => 'S2']);
        return view('eng.about.journal');
    }
    public function meeting(Request $request)
    {
        view()->share(['sub_menu' => 'S2']);
        return view('eng.about.meeting');
    }
    public function society(Request $request)
    {
        view()->share(['sub_menu' => 'S2']);
        return view('eng.about.society');
    }
    public function past(Request $request)
    {
        view()->share(['sub_menu' => 'S2']);
        return view('eng.about.past');
    }

    public function contact(Request $request)
    {
        view()->share(['sub_menu' => 'S3']);
        return view('eng.about.contact');
    }
    
}
