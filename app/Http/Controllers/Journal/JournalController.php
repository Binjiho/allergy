<?php

namespace App\Http\Controllers\Journal;

use App\Http\Controllers\Controller;
use App\Services\Journal\JournalServices;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    private $journalServices;
    public function __construct()
    {
        $this->journalServices = (new JournalServices());

        view()->share([
            'userConfig' => getConfig('user'),
            'main_menu' => 'M4',
        ]);
    }

    public function publication(Request $request)
    {
        view()->share(['sub_menu' => 'S3']);
        return view('journal.publication.index',$this->journalServices->indexService($request));
    }
    public function upsert(Request $request)
    {
        view()->share(['sub_menu' => 'S3']);
        return view('journal.publication.upsert',$this->journalServices->upsertService($request));
    }

    public function aard(Request $request)
    {
        view()->share(['sub_menu' => 'S4']);
        return view('journal.aard');
    }
    public function aair(Request $request)
    {
        view()->share(['sub_menu' => 'S5']);
        return view('journal.aair');
    }
    public function asSearch(Request $request)
    {
        view()->share(['sub_menu' => 'S6']);
        return view('journal.search.index');
    }
    public function asSearchList(Request $request)
    {
        view()->share(['sub_menu' => 'S6']);
        return view('journal.search.list', $this->journalServices->searchService($request));
    }

    public function asKwon(Request $request)
    {
        view()->share(['sub_menu' => 'S6']);
        return view('journal.kwon.index');
    }

    public function asKwonList(Request $request)
    {
        view()->share(['sub_menu' => 'S6']);
        return view('journal.kwon.list', $this->journalServices->kwonListService($request));
    }

    public function data(Request $request)
    {
        return $this->journalServices->dataAction($request);
    }
}
