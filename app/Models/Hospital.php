<?php

namespace App\Models;

use App\Services\CommonServices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Hospital extends Model
{
    use HasFactory;

    protected $table = 'hospitals';

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

    public function setByData($data)
    {
        if(empty($this->sid)) {
            $this->created_at = date('Y-m-d H:i:s');
        }

        $this->major = $data->major ?? 'N';
    }

    public function setByTransfer($data) //DB이관
    {
        $this->major = $data['major'] ?? null;
        $this->name_kr = $data['name_kr'] ?? null;
        $this->chief_name = $data['chief_name'] ?? null;
        $this->chief_email = $data['chief_email'] ?? null;
        $this->address = $data['address'] ?? null;
        $this->tel = $data['tel'] ?? null;

        $this->jext_yn = $data['jext_yn'] ?? 'N';
        $this->si = $data['si'] ?? null;
        $this->gu = $data['gu'] ?? null;
    }

}
