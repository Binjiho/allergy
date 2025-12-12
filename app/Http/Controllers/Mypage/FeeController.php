<?php

namespace App\Http\Controllers\Mypage;

use App\Http\Controllers\Controller;
use App\Services\Mypage\FeeServices;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    private $feeServices;

    public function __construct()
    {
        $this->feeServices = (new FeeServices());

        view()->share([
            'userConfig' => getConfig('user'),
            'feeConfig' => getConfig('fee'),
            'main_menu' => 'MYPAGE',
            'sub_menu' => 'S9',
        ]);
    }

    public function fee(Request $request)
    {
        return view('mypage.fee.list', $this->feeServices->listService($request));
    }

    public function upsert(Request $request)
    {
        return view('mypage.fee.upsert', $this->feeServices->upsertService($request));
    }


    public function receipt(Request $request)
    {
//        view()->share(['sub_menu' => 'S4']);
        return view('mypage.fee.popup.receipt', $this->feeServices->receiptService($request));
    }
    public function feeData(Request $request)
    {
        return $this->feeServices->dataAction($request);
    }
}
