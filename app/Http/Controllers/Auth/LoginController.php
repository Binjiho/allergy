<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\LoginServices;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    private $loginServices;

    public function __construct()
    {
        $this->loginServices = (new LoginServices());

        view()->share([
            'main_menu' => 'M8',
            'sub_menu' => 'S1',
            'userConfig' => getConfig('user'),
        ]);
    }

    public function login(Request $request)
    {
        if ( thisPK() ) {
            view()->share([
                'sub_menu' => 'S9',
            ]);
            return view("mypage.intro");
        }
        if ($request->isMethod('get')) {
            return view('auth.login');
        }

        return $this->loginServices->loginAction($request);
    }

    public function logout(Request $request)
    {
        return $this->loginServices->logoutAction($request);
    }
}
