<?php

namespace App\Models;

use App\Services\CommonServices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Workshop extends Model
{
    use HasFactory;

    protected $table = 'workshops';

    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
    ];

    public $timestamps = false; // 자동 타임스탬프 사용 안 함

    protected $dates = [
//        'created_at',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'res_fee' => 'array',
    ];

    public function setByData($data)
    {
        if(empty($this->sid)) {
            $this->kind = $data->kind ?? null;
            $this->code = $data->code ?? null;
            $this->created_at = date('Y-m-d H:i:s');
        }

        $this->hide = $data->hide ?? 'N';
        $this->title = $data->title ?? null;
        $this->date_type = $data->date_type ?? null;
        $this->event_sdate = $data->event_sdate ?? null;
        $this->event_edate = ($data->date_type == 'L') ? $data->event_edate : null;
        $this->place = $data->place ?? null;
        $this->link_url = $data->link_url ?? null;
        $this->total_info = $data->total_info ?? null;
        $this->fee_info = $data->fee_info ?? null;
        $this->pay_info = $data->pay_info ?? null;
        $this->notice_info = $data->notice_info ?? null;
        $this->inquire_info = $data->inquire_info ?? null;

        //사전등록
        $this->regist_sdate = $data->regist_sdate ?? null;
        $this->regist_edate = $data->regist_edate ?? null;
        $this->grace_use = $data->grace_use ?? 'N';
        $this->regist_grace_sdate = $data->regist_grace_sdate ?? null;
        $this->regist_grace_edate = $data->regist_grace_edate ?? null;
        $this->res_fee = $data->res_fee ?? null;

        //강의원고 사용유무
        $this->lecture_use = $data->lecture_use ?? 'N';


        /* 첨부파일 업로드 or 삭제 */
        if ($data instanceof \Illuminate\Http\Request) { // $data 가 Request 객체일때만.
            for($i=1; $i<10; $i++) {
                $file = $data->file("filename_" . $i) ?? null; // 첨부파일
                $fileDel = $data->{"filename_" . $i . '_del'} ?? ''; // 파일삭제
                $pathField = 'realfile_' . $i; // 파일 경로 데이터 저장 컬럼
                $nameField = 'filename_' . $i; // 파일 이름 데이터 저장 컬럼

                // 파일 삭제이면서 기존 첨부파일 있을경우 경로에 있는 실제 파일 삭제
                if (($fileDel == 'Y') && !is_null($this->{$pathField})) {
                    (new CommonServices())->fileDeleteService($this->{$pathField});

                    // 첨부파일이 없다면 기존 파일경로 및 파일명 초기화
                    if (is_null($file)) {
                        $this->{$pathField} = null;
                        $this->{$nameField} = null;
                    }
                }

                // 첨부파일 있을경우 업로드후 경로 저장
                if ($file) {
                    $directory = '/workshops/';
                    $uploadFile = (new CommonServices())->fileUploadService($file, $directory);
                    $this->{$pathField} = $uploadFile['realfile'];
                    $this->{$nameField} = $uploadFile['filename'];
                }
            }
        }
    }

    public function setByTransfer($data) //DB이관
    {
        $this->code = $data['code'] ?? null;
        $this->title = $data['title'] ?? null;
        $this->date_type = $data['date_type'] ?? null;
        $this->event_sdate = $data['event_sdate'] ?? null;
        $this->created_at = $data['created_at'] ?? null;
        $this->regist_use = 'N';

        $this->event_edate = null;
        $this->hide = $data->hide ?? 'N';
        $this->place = $data->place ?? null;
        $this->total_info = $data->total_info ?? null;
        $this->fee_info = $data->fee_info ?? null;
        $this->pay_info = $data->pay_info ?? null;
        $this->notice_info = $data->notice_info ?? null;
        $this->inquire_info = $data->inquire_info ?? null;

        //사전등록
        $this->regist_sdate = $data->regist_sdate ?? null;
        $this->regist_edate = $data->regist_edate ?? null;
        $this->grace_use = $data->grace_use ?? 'N';
        $this->regist_grace_sdate = $data->regist_grace_sdate ?? null;
        $this->regist_grace_edate = $data->regist_grace_edate ?? null;
        $this->res_fee = $data->res_fee ?? null;

        //강의원고 사용유무
        $this->lecture_use = $data->lecture_use ?? 'N';
    }

    public function downloadUrl($field)
    {
        return route('download', [
            'type' => 'only',
            'tbl' => 'workshop',
            'sid' => enCryptString($this->sid),
            'field' => $field,
        ]);
    }
    public function registrations()
    {
        // foreignKey = registration 테이블 컬럼, localKey = workshop 테이블 컬럼
        return $this->hasMany(Registration::class, 'wsid', 'sid');
    }

    public function details()
    {
        // foreignKey = registration 테이블 컬럼, localKey = workshop 테이블 컬럼
        return $this->hasMany(WorkshopDetail::class, 'wsid', 'sid');
    }

    public function regCnt()
    {
        // foreignKey = registration 테이블 컬럼, localKey = workshop 테이블 컬럼
        return $this->hasMany(Registration::class, 'wsid', 'sid')->where(['del'=>'N','complete'=>'Y'])->count();
    }
}
