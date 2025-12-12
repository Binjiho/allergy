<?php

namespace App\Http\Controllers\Workshop;

use App\Http\Controllers\Controller;
use App\Services\Workshop\LectureServices;
use Illuminate\Http\Request;

class LectureController extends Controller
{
    private $lectureServices;

    public function __construct()
    {
        $this->lectureServices = new LectureServices();

        view()->share([
            'userConfig' => getConfig('user'),
            'main_menu' => 'M5',
            'workshopConfig' => config('site.workshop.' . request()->wsid, []),
            'wsid' => request()->wsid,
        ]);
    }
    public function index(Request $request)
    {
        view()->share(['sub_menu' => 'S3']);

        return view('conference.workshop.detail.lecture.index', $this->lectureServices->indexService($request));
    }

    public function upload(Request $request)
    {
        view()->share(['sub_menu' => 'S3']);

        return view('conference.workshop.detail.lecture.upsert', $this->lectureServices->upsertService($request));
    }

    public function data(Request $request)
    {
        return $this->lectureServices->dataAction($request);
    }

}
