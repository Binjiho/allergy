<?php

namespace App\Http\Controllers\Eng\Publication;

use App\Http\Controllers\Controller;
//use App\Services\Intro\IntroServices;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function __construct()
    {

        view()->share([
            'userConfig' => getConfig('user'),
            'main_menu' => 'M3',
        ]);
    }
    public function aair(Request $request)
    {
        view()->share(['sub_menu' => 'S1']);
        return view('eng.publication.aair');
    }

    public function aard(Request $request)
    {
        view()->share(['sub_menu' => 'S2']);
        return view('eng.publication.aard');
    }

    public function textbook(Request $request)
    {
        view()->share(['sub_menu' => 'S3']);
        return view('eng.publication.textbook');
    }
    
}
