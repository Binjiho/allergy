<?php

namespace App\Models;

use App\Services\CommonServices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Publication extends Model
{
    use HasFactory;
    protected $table = 'publications';
//    public $timestamps = false; // 자동 타임스탬프 사용 안 함

    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
    ];

    protected $dates = [
        'publicated_at',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    public function setByData($data)
    {
        if(empty($this->sid)) {

        }
        $this->title = $data['title'] ?? null;
        $this->name_kr = $data['name_kr'] ?? null;
        $this->publicated_at = $data['publicated_at'] ?? null;

        $this->location = $data['location'] ?? null;
        $this->url = $data['url'] ?? null;
        $this->hide = $data['hide'] ?? 'N';

        /* 파일 업로드 or 삭제 */
        $file = $data->file("thumbfile") ?? null; // 썸네일 첨부파일
        //파일 있을경우 업로드후 경로 저장
        if ($file) {
            $directory = 'publications';
            $uploadFile = (new CommonServices())->fileUploadService($file, $directory);
            $this->realfile = $uploadFile['realfile'];
            $this->filename = $uploadFile['filename'];
        }
    }

    public function downloadUrl() //첨부 파일 다운로드
    {
        return route('download', [
            'type' => 'only',
            'tbl' => 'publication',
            'sid' => enCryptString($this->sid),
        ]);
    }

}
