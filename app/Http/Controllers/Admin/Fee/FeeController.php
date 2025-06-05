<?php

namespace App\Http\Controllers\Admin\Fee;

use App\Http\Controllers\Controller;
use App\Services\Admin\Fee\FeeServices;
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
            'main_key' => 'M2',
            'sub_key' => 'S1',
        ]);
    }

    public function index(Request $request)
    {
        return view('admin.fee.index', $this->feeServices->indexService($request));
    }

//    public function popupMail(Request $request)
//    {
//        return view('admin.fee.popup.mail', $this->feeServices->popupMailService($request));
//    }

    public function allList(Request $request)
    {
        return view('admin.fee.popup.all-list', $this->feeServices->allListService($request));
    }

    public function upsert(Request $request)
    {
        return view('admin.fee.upsert', $this->feeServices->upsertService($request));
    }

    public function receipt(Request $request)
    {
        return view('mypage.fee.popup.receipt', $this->feeServices->receiptService($request));
    }

    public function remail(Request $request)
    {
        return view('admin.fee.popup.remail', $this->feeServices->remailService($request));
    }

    public function excel(Request $request)
    {
        $request->merge(['excel' => true]);
        return $this->feeServices->indexService($request);
    }

    public function data(Request $request)
    {
        return $this->feeServices->dataAction($request);
    }
}
