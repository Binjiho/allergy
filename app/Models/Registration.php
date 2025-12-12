<?php

namespace App\Models;

use App\Services\CommonServices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Registration extends Model
{
    use HasFactory;

    protected $table = 'registrations';

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
//        if(!empty($data['tel1'])){
//            $tel = $data['tel1'].'-'.$data['tel2'].'-'.$data['tel3'];
//        }

        if(empty($this->sid)) {
            $this->usid = $data->usid ?? thisPK();
            $this->member_gubun = $data->member_gubun ?? 'N';
            $this->wsid = $data->wsid ?? null;
            $this->reg_num = $data->reg_num ?? null;
            $this->created_at = date('Y-m-d H:i:s');

            $this->license_number = ($data->gubun != '5') ? $data->license_number : null;
            $this->name_kr = $data->name_kr ?? null;
        }

        $this->updated_at = date('Y-m-d H:i:s');
        $this->gubun = $data->gubun ?? null;


        $this->email = $data->email ?? null;
        $this->region = $data->region ?? null;
        $this->sigu = $data->sigu ?? null;
        $this->office_use = $data->office_use ?? 'N';
        $this->office_sid = ($data->office_use != 'Y') ? $data->office_sid : null;
        $this->office_name = $data->office_name ?? null;

        $this->zipcode =  $data->zipcode ?? null;
        $this->addr = $data->addr ?? null;
        $this->addr_etc = $data->addr_etc ?? null;
        $this->phone = $data->phone ?? null;
        $this->department = $data->department ?? null;
        $this->office_tel_first = $data->office_tel_first ?? null;
        $this->office_tel = $data->office_tel ?? null;

        $this->amount = $data->amount ?? null;
        $this->agree = $data->agree ?? 'Y';
    }

    public function setByCompleteData($data)
    {
        $this->send_name = $data->send_name ?? null;
        $this->send_date = $data->send_date ?? null;
        
        $this->pay_method = $data->pay_method ?? null;
        $this->pay_status = $data->pay_status ?? 'N';
        $this->pay_confirm_date = $data->pay_confirm_date ?? null;

        $this->complete = $data->complete ?? 'Y';
        $this->completed_at = $data->completed_at ?? date('Y-m-d H:i:s');
    }

    public function workshop()
    {
        return $this->belongsTo(Workshop::class, 'wsid', 'sid');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'usid', 'sid');
    }
}
