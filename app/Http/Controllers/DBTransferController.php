<?php

namespace App\Http\Controllers;

use App\Services\DBTransferServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class DBTransferController extends Controller
{
    private $dbTransferServices;

    public function __construct(Request $request)
    {
        $this->dbTransferServices = (new DBTransferServices());
    }

    public function dbTransfer(Request $request)
    {
        $this->data = $this->dbTransferServices->transferService();
    }

    public function fileTransfer(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('transferFileUpload');
        }else {
            $uploadDirectory = "bbs/event-schedule";
//            $uploadDirectory = "bbs/gallery";
//            $uploadDirectory = "bbs/notice";
//            $uploadDirectory = "bbs/free";

            $file = $request->file('files');
            $fileCnt = count($file ?? []);

            var_dump("UPLOAD START FILE {$fileCnt} 개 <br><br><br>");
            \File::deleteDirectory(public_path('/upload/' . $uploadDirectory));

            foreach ($file ?? [] as $key => $item) {
                $save_name = $item->getClientOriginalName();
                $file_path = $item->storeAs($uploadDirectory, $save_name, ['disk' => 'public_uploads']);

                $cnt = ($key + 1);
                var_dump("UPLOAD FILE {$cnt} 번째 / PATH: {$file_path}<br>");
            }

            var_dump("<br><br><br>UPLOAD FINISH");
        }
    }
}