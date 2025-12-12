<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use App\Services\Board\BoardServices;
use Illuminate\Http\Request;
use App\Models\Workshop;

class BoardController extends Controller
{
    private $boardServices;
    private $boardConfig;

    private $blockList = ['photo','research-team','branch','format', 'treatment', 'guideline'];
    public function __construct()
    {
        $code = request()->code ?? '';
        $this->boardConfig = getConfig("board")[$code] ?? [];
        $this->boardServices = new BoardServices();

        view()->share([
            'boardConfig' => $this->boardConfig,
            'main_menu' => $this->boardConfig['menu']['main'] ?? '',

            'code' => $code,
        ]);

        if($code == 'treatment'){
            view()->share([
                'sub_menu' => 'S'.(request()->gubun ?? '1'),
            ]);
        }else{
            view()->share([
                'sub_menu' => $this->boardConfig['menu']['sub'] ?? '',
            ]);

        }
    }

    public function index(Request $request)
    {
        if(in_array($request->code, $this->blockList) ){
            if (!thisPK() ) {
                $ret_url = $request->path();
                authRedirect( $ret_url );
            }
        }
        return view("board.{$this->boardConfig['skin']}.index", $this->boardServices->listService($request));
    }

    public function view(Request $request)
    {
        return view("board.{$this->boardConfig['skin']}.view", $this->boardServices->viewService($request));
    }

    public function upsert(Request $request)
    {
        return view("board.{$this->boardConfig['skin']}.upsert", $this->boardServices->upsertService($request));
    }

    public function data(Request $request)
    {
        return $this->boardServices->dataAction($request);
    }
}
