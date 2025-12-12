<?php

namespace App\Http\Controllers\Archive;

use App\Http\Controllers\Controller;
//use App\Services\Archive\ArchiveServices;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
//    private $archiveServices;
    public function __construct()
    {
//        $this->archiveServices = (new ArchiveServices());
        view()->share([
            'userConfig' => getConfig('user'),
            'main_menu' => 'M3',
        ]);
    }
    public function eLearning(Request $request)
    {
        view()->share(['sub_menu' => 'S1']);
        return view('archive.eLearning');
    }
}
