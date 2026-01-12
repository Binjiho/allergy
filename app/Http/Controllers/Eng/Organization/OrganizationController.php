<?php

namespace App\Http\Controllers\Eng\Organization;

use App\Http\Controllers\Controller;
//use App\Services\Intro\IntroServices;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function __construct()
    {

        view()->share([
            'userConfig' => getConfig('user'),
            'main_menu' => 'M2',
        ]);
    }
    public function committee(Request $request)
    {
        view()->share(['sub_menu' => 'S1']);
        return view('eng.organization.committee');
    }

    public function branch(Request $request)
    {
        view()->share(['sub_menu' => 'S2']);
        return view('eng.organization.branch');
    }

    public function working(Request $request)
    {
        view()->share(['sub_menu' => 'S3']);
        return view('eng.organization.working');
    }
    
}
