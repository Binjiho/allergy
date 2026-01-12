<?php

namespace App\Models;

use App\Services\CommonServices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Lecture extends Model
{
    use HasFactory;

    protected $table = 'lectures';

    protected $primaryKey = 'sid';

    public $timestamps = false; // 자동 타임스탬프 사용 안 함

    protected $guarded = [
        'sid',
    ];

    protected $dates = [
//        'created_at',
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];


    public function setByData($data)
    {
        if(empty($this->sid)) {
            $this->usid = $data->usid ?? thisPK();
            $this->wsid = $data->wsid ?? null;
            $this->created_at = date('Y-m-d H:i:s');
        }

        $this->updated_at = date('Y-m-d H:i:s');
        $this->title = $data->title ?? null;
        $this->name_kr = $data->name_kr ?? null;
        $this->sosok = $data->sosok ?? null;

        /* 파일 업로드 or 삭제 */
        $thumbnail = $data->file("thumbfile") ?? null; // 썸네일 첨부파일
        $thumbnailDel = $data->thumbfile_del ?? null; // 썸네일 파일삭제
        
        // 파일 삭제이면서 기존 썸네일 있을경우 경로에 있는 실제 파일 삭제
        if ($thumbnailDel && !is_null($this->realfile)) {
            (new CommonServices())->fileDeleteService($this->realfile);

            // 썸네일 없다면 기존 파일경로 및 파일명 초기화
            if (is_null($thumbnail)) {
                $this->realfile = null;
                $this->filename = null;
            }
        }

        //파일 있을경우 업로드후 경로 저장
        if ($thumbnail) {
            $directory = 'lectures';
            $uploadFile = (new CommonServices())->fileUploadService($thumbnail, $directory);
            $this->realfile = $uploadFile['realfile'];
            $this->filename = $uploadFile['filename'];
        }
    }

    public function setByTransfer($data)
    {
        $this->wsid = $data['wsid'] ?? null;
        $this->title = $data['title'] ?? null;
        $this->name_kr = $data['name'] ?? null;
        $this->sosok = $data['office'] ?? null;

    } //DB이관

    public function workshop()
    {
        return $this->belongsTo(Workshop::class, 'wsid', 'sid');
    }

    public function downloadUrl() //첨부 파일 다운로드
    {
        return route('download', [
            'type' => 'only',
            'tbl' => 'lecture',
            'sid' => enCryptString($this->sid),
        ]);
    }

}
