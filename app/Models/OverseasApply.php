<?php

namespace App\Models;

use App\Services\CommonServices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class OverseasApply extends Model
{
//	use SoftDeletes;
    use HasFactory;

    protected $table = 'overseas_apply';

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

    public function setByStep1($data)
    {
        if(empty($this->sid)) {
            $this->o_sid = $data->o_sid;
            $this->user_sid = $data->user_sid ?? thisPK();
            $this->created_at = date('Y-m-d H:i:s');
        }

        $this->step = 1;
        $this->agree = $data->agree ?? null;
    }

    public function setByStep2($data)
    {
        $this->step = 2;
        $this->sosok_kr = $data->sosok_kr ?? null;
        $this->phone = $data->phone ?? null;
        $this->email = $data->email ?? null;
        $this->bank_name = $data->bank_name ?? null;
        $this->account_num = $data->account_num ?? null;
        $this->account_name = $data->account_name ?? null;
    }

    public function setByStep3($data)
    {
        $this->step = 3;
        $this->presenter = $data->presenter ?? null;
        $this->lecture = $data->lecture ?? null;
        $this->attend = $data->attend ?? null;
        $this->title_kr = $data->title_kr ?? null;
        $this->title_en = $data->title_en ?? null;
        $this->submit_type = $data->submit_type ?? null;
        $this->agree2 = $data->agree2 ?? null;


        /* 첨부파일 업로드 or 삭제 */
        if ($data instanceof \Illuminate\Http\Request) { // $data 가 Request 객체일때만.
            for($i=1; $i<=2; $i++) {
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
//                    $this->{$nameField} = $uploadFile['filename'];

                    // 파일 객체에서 확장자 추출 (예: docx, pdf 등)
                    $extension = $file->getClientOriginalExtension();
                    if( $i == 1){
                        $this->{$nameField} = $data->title.' '.date('Y').'_'.$data->name_kr.'_발표초록.'. $extension;
                    }else{
                        $this->{$nameField} = $data->title.' '.date('Y').'_'.$data->name_kr.'_채택메일.'. $extension;
                    }
                }
            }
        }
    }

    public function setByReport($data)
    {
        $this->pay1 = (int)($data->pay1 ?? 0);
        $this->pay2 = (int)($data->pay2 ?? 0);
        $this->pay3 = (int)($data->pay3 ?? 0);
        $this->pay4 = (int)($data->pay4 ?? 0);
        $this->pay5 = (int)($data->pay5 ?? 0);
        $this->tot_pay = $this->pay1 + $this->pay2 + $this->pay3 + $this->pay4 + $this->pay5;

        /* 첨부파일 업로드 or 삭제 */
        if ($data instanceof \Illuminate\Http\Request) { // $data 가 Request 객체일때만.
            for($i=3; $i<=13; $i++) {
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
//                    $this->{$nameField} = $uploadFile['filename'];

                    // 파일 객체에서 확장자 추출 (예: docx, pdf 등)
                    $extension = $file->getClientOriginalExtension();

                    switch ($i){
                        case '3':
                            $this->{$nameField} = $data->title.' '.date('Y').'_'.$data->name_kr.'_결과보고서_초록사본.'. $extension;
                            break;
                        case '4':
                            $this->{$nameField} = $data->title.' '.date('Y').'_'.$data->name_kr.'_결과보고서_초록채택메일.'. $extension;
                            break;
                        case '5':
                            $this->{$nameField} = $data->title.' '.date('Y').'_'.$data->name_kr.'_결과보고서_항공료.'. $extension;
                            break;
                        case '6':
                            $this->{$nameField} = $data->title.' '.date('Y').'_'.$data->name_kr.'_결과보고서_숙박비.'. $extension;
                            break;
                        case '7':
                            $this->{$nameField} = $data->title.' '.date('Y').'_'.$data->name_kr.'_결과보고서_등록비.'. $extension;
                            break;
                        case '8':
                            $this->{$nameField} = $data->title.' '.date('Y').'_'.$data->name_kr.'_결과보고서_식대.'. $extension;
                            break;
                        case '9':
                            $this->{$nameField} = $data->title.' '.date('Y').'_'.$data->name_kr.'_결과보고서_교통비.'. $extension;
                            break;
                        case '10':
                            $this->{$nameField} = $data->title.' '.date('Y').'_'.$data->name_kr.'_결과보고서_기타영수증.'. $extension;
                            break;
                        case '11':
                            $this->{$nameField} = $data->title.' '.date('Y').'_'.$data->name_kr.'_결과보고서_결과보고서.'. $extension;
                            break;
                        case '12':
                            $this->{$nameField} = $data->title.' '.date('Y').'_'.$data->name_kr.'_결과보고서_지출내역서.'. $extension;
                            break;
                        case '13':
                            $this->{$nameField} = $data->title.' '.date('Y').'_'.$data->name_kr.'_결과보고서_기타.'. $extension;
                            break;
                        default:
                            break;
                    }

                }
            }
        }
    }

    public function downloadUrl($field)
    {
        return route('download', [
            'type' => 'only',
            'tbl' => 'overseas_apply',
            'sid' => enCryptString($this->sid),
            'field' => $field,
        ]);
    }

    public function overseasSetting()
    {
        return $this->belongsTo(OverseasSetting::class, 'o_sid', 'sid');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_sid', 'sid');
    }

    public function regCnt()
    {
        // foreignKey = registration 테이블 컬럼, localKey = workshop 테이블 컬럼
        return $this->hasMany(Registration::class, 'wsid', 'sid')->where(['del'=>'N','complete'=>'Y'])->count();
    }

    public function excelHyperLink($type)
    {
        return url('common/fileDownload/only/excelHyperLink/' . enCryptString($this->sid));
    }
}
