<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\AuthServices;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $authServices;

    public function __construct()
    {
        $this->authServices = (new AuthServices());

        view()->share([
            'main_menu' => 'M8',
            'userConfig' => getConfig('user'),
        ]);
    }

    public function join(Request $request)
    {
        if ( thisPK() ) {
            view()->share([
                'sub_menu' => 'S9',
            ]);
            return view("mypage.intro");
        }
        
        view()->share([
            'sub_menu' => 'S1',
        ]);
        return view('auth.join.step0'.$request->step ,$this->authServices->signupAction($request) );
    }
    
    public function findId(Request $request)
    {
        if ( thisPK() ) {
            view()->share([
                'sub_menu' => 'S9',
            ]);
            return view("mypage.intro");
        }
        view()->share([
            'sub_menu' => 'S3',
        ]);
        return view('auth.forget-id');
    }
    public function findPw (Request $request)
    {
        if ( thisPK() ) {
            view()->share([
                'sub_menu' => 'S9',
            ]);
            return view("mypage.intro");
        }
        view()->share([
            'sub_menu' => 'S3',
        ]);
        return view('auth.forget-pw');
    }

    public function data(Request $request)
    {
        return $this->authServices->dataAction($request);
    }
}
