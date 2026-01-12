<?php

namespace App\Models;

use App\Services\CommonServices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class OverseasSetting extends Model
{
    use HasFactory;

    protected $table = 'overseas_setting';

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
//        'res_fee' => 'array',
    ];

    public function setByData($data)
    {
        if(empty($this->sid)) {
            $this->created_at = date('Y-m-d H:i:s');
        }

        $this->title = $data->title ?? null;
        $this->content = $data->content ?? null;
        $this->sdate = $data->sdate ?? null;
        $this->edate = $data->edate ?? null;
        $this->place = $data->place ?? null;

        $this->limit_person = $data->limit_person ?? null;
        $this->regist_sdate = $data->regist_sdate ?? null;
        $this->regist_edate = $data->regist_edate ?? null;
        $this->report_sdate = $data->report_sdate ?? null;
        $this->report_edate = $data->report_edate ?? null;
        $this->result_date = $data->result_date ?? null;

        $this->updated_at = date('Y-m-d H:i:s');
        $this->hide = $data->hide ?? 'N';

        /* 첨부파일 업로드 or 삭제 */
        if ($data instanceof \Illuminate\Http\Request) { // $data 가 Request 객체일때만.
            for($i=1; $i<10; $i++) {
                $file = $data->file("file" . $i) ?? null; // 첨부파일
                $fileDel = $data->{"file" . $i . '_del'} ?? ''; // 파일삭제
                $pathField = 'realfile' . $i; // 파일 경로 데이터 저장 컬럼
                $nameField = 'filename' . $i; // 파일 이름 데이터 저장 컬럼

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
                    $directory = '/overseas/';
                    $uploadFile = (new CommonServices())->fileUploadService($file, $directory);
                    $this->{$pathField} = $uploadFile['realfile'];
                    $this->{$nameField} = $uploadFile['filename'];
                }
            }
        }
    }

    public function downloadUrl($field)
    {
        return route('download', [
            'type' => 'only',
            'tbl' => 'overseas_setting',
            'sid' => enCryptString($this->sid),
            'field' => $field,
        ]);
    }

    public function regTotCnt()
    {
        return $this->hasMany(OverseasApply::class, 'o_sid', 'sid')->where(['del'=>'N'])->count();
    }

    public function regIngCnt()
    {
        return $this->hasMany(OverseasApply::class, 'o_sid', 'sid')->where(['del'=>'N','complete'=>'N'])->count();
    }

    public function regJudgeYCnt()
    {
        return $this->hasMany(OverseasApply::class, 'o_sid', 'sid')->where(['del'=>'N','complete'=>'Y','judge'=>'Y'])->count();
    }

    public function regJudgeNCnt()
    {
        return $this->hasMany(OverseasApply::class, 'o_sid', 'sid')->where(['del'=>'N','complete'=>'Y','judge'=>'N'])->count();
    }
}
