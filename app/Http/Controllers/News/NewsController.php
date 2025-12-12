<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Services\News\NewsServices;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    private $newsServices;
    public function __construct()
    {
        $this->newsServices = (new NewsServices());
        view()->share([
            'userConfig' => getConfig('user'),
            'main_menu' => 'M2',
        ]);
    }
    public function prize(Request $request)
    {
        view()->share(['sub_menu' => 'S2']);

        return view('news.prize.index',$this->newsServices->prizeService($request));
    }

    public function prizeRule(Request $request)
    {
        view()->share(['sub_menu' => 'S2']);

        return view('news.prize.rule');
    }

    public function research(Request $request)
    {
        view()->share(['sub_menu' => 'S2']);
        return view('news.research.index',$this->newsServices->researchService($request));
    }

    public function researchRule(Request $request)
    {
        view()->share(['sub_menu' => 'S2']);

        return view('news.research.rule');
    }

    public function cpa(Request $request)
    {
        view()->share(['sub_menu' => 'S3']);
        return view('news.cpa');
    }

    public function prizeUpsert(Request $request)
    {
        return view('news.prize.upsert', $this->newsServices->prizeUpsertService($request));
    }
    public function researchUpsert(Request $request)
    {
        return view('news.research.upsert', $this->newsServices->researchUpsertService($request));
    }

    public function prizeCollective(Request $request)
    {
        return view('news.prize.collective-upload');
    }

    public function researchCollective(Request $request)
    {
        return view('news.research.collective-upload');
    }

    public function data(Request $request)
    {
        return $this->newsServices->dataAction($request);
    }
}
