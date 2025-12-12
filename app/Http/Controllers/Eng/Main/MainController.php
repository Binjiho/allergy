<?php

namespace App\Http\Controllers\Eng\Main;

use App\Http\Controllers\Controller;
use App\Services\Eng\Main\MainServices;
use Illuminate\Http\Request;

class MainController extends Controller
{
    private $mainServices;

    public function __construct()
    {
        $this->mainServices = (new MainServices());
    }

    public function main(Request $request)
    {
        return view('eng.index', $this->mainServices->indexService($request));
    }

    public function data(Request $request)
    {
        return $this->mainServices->dataAction($request);
    }
}
