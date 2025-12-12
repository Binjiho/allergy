<?php

namespace App\Models;

use App\Services\CommonServices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Journal extends Model
{
    use HasFactory;

    protected $table = 'journals';

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
        if (request()->route()->getName() != 'dbTransfer' /* 데이터 이전 작업아닐때 */) {

            if(empty($this->sid)) {
                $this->created_at = date('Y-m-d H:i:s');
            }
        }else{
            $this->created_at = $data['created_at'] ?? null;
        }

        $this->code = $data['code'] ?? null;
        $this->book = $data['book'] ?? null;
        $this->category = $data['category'] ?? null;
        $this->no = $data['no'] ?? null;
        $this->issue_number = $data['issue_number'] ?? null;

        $this->vol = $data['vol'] ?? null;
        $this->num = $data['num'] ?? null;
        $this->regnum = $data['regnum'] ?? null;
        $this->start_page = $data['start_page'] ?? null;
        $this->last_page = $data['last_page'] ?? null;

        $this->tot_page = $data['tot_page'] ?? null;
        $this->subject_kr = $data['subject_kr'] ?? null;
        $this->subject_en = $data['subject_en'] ?? null;
        $this->author_kr = $data['author_kr'] ?? null;
        $this->author_en = $data['author_en'] ?? null;

        $this->main_author_kr = $data['main_author_kr'] ?? null;
        $this->main_author_en = $data['main_author_en'] ?? null;
        $this->place_kr = $data['place_kr'] ?? null;
        $this->place_en = $data['place_en'] ?? null;
        $this->publisher_kr = $data['publisher_kr'] ?? null;

        $this->publisher_en = $data['publisher_en'] ?? null;
        $this->published_at = $data['published_at'] ?? null;
        $this->abstract_kr = $data['abstract_kr'] ?? null;
        $this->abstract_en = $data['abstract_en'] ?? null;
        $this->keywords = $data['keywords'] ?? null;

        $this->filename = $data['filename'] ?? null;

    }

}
