<?php

namespace App\Http\Controllers\EasyPay;

use App\Http\Controllers\Controller;
use App\Services\EasyPay\EasyPayServices;
use Illuminate\Http\Request;

class EasyPayController extends Controller
{
    private $easyPayServices;

    public function __construct()
    {
        $this->easyPayServices = (new EasyPayServices());
    }

    public function test(Request $request)
    {
        return view('easyPay.test');
    }

    public function result(Request $request)
    {
        return $this->easyPayServices->resultAction($request);
    }

    public function data(Request $request)
    {
        return $this->easyPayServices->dataAction($request);
    }
}
