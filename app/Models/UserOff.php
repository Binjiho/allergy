<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;

class UserOff extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    public $table = 'user_binfo_offline';

    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
    ];

    protected $dates = [
        'password_at',
        'created_at',
        'updated_at',
        'deleted_at',
        'del_request_at',
        'login_at',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [

    ];

    private function userConfig()
    {
        return getConfig('user');
    }

    protected static function booted()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->timestamps = false; // updated_at 자동 생성 비활성화
        });

        static::deleting(function ($user) {
            $user->timestamps = false; // 업데이트 시간 저장 안하려고 timestamps 값 false 로 변경
            $user->del = 'Y';
            $user->deleted_at = date('Y-m-d H:i:s');
            $user->update();

            $user->fees()->update(['del' => 'Y', 'deleted_at'=>date('Y-m-d H:i:s')]); // 회비 삭제 대신 상태 업데이트

            $user->timestamps = true; // timestamps 다시 활성
        });
    }

    public function setByData($data)
    {
        $this->confirm = $data['confirm'];
        $this->companyFax = $data['companyFax'];
        $this->gender = $data['gender'];
        $this->del = $data['del'];
        $this->create_status = 'Y';
        $companyTel = $data['companyTel'];

        if(!empty($data['level'])) $this->level = $data['level'] ?? null;
        if(!empty($data['name_kr'])) $this->name_kr = $data['name_kr'] ?? null;
        if(!empty($data['first_name'])) $this->first_name = $data['first_name'] ?? null;
        if(!empty($data['last_name'])) $this->last_name = $data['last_name'] ?? null;
        if(!empty($data['name_han'])) $this->name_han = $data['name_han'] ?? null;

        if(!empty($data['is_national'])) $this->is_national = $data['is_national'] ?? null;
        if(!empty($data['birth_date'])) $this->birth_date = $data['birth_date'] ?? null;
        if(!empty($data['phone'])) $this->phone = $data['phone'] ?? null;
        if(!empty($data['smsReception'])) $this->smsReception = $data['smsReception'] ?? null;
        if(!empty($data['email'])) $this->email = $data['email'] ?? null;
        if(!empty($data['emailReception'])) $this->emailReception = $data['emailReception'] ?? null;

        if(!empty($data['home_zipcode'])) $this->home_zipcode = $data['home_zipcode'] ?? null;
        if(!empty($data['home_address'])) $this->home_address = $data['home_address'] ?? null;
        if(!empty($data['home_address2'])) $this->home_address2 = $data['home_address2'] ?? null;
        if(!empty($data['license_number'])) $this->license_number = $data['license_number'] ?? null;
        if(!empty($data['major'])) $this->major = $data['major'] ?? null;
        if(!empty($data['major_etc'])) $this->major_etc = $data['major_etc'] ?? null;

        if(!empty($data['special_number'])) $this->special_number = $data['special_number'] ?? null;
        if(!empty($data['bun_number'])) $this->bun_number = $data['bun_number'] ?? null;
        if(!empty($data['join_date'])) $this->join_date = $data['join_date'] ?? null;
        if(!empty($data['graduate_date'])) $this->graduate_date = $data['graduate_date'] ?? null;
        if(!empty($data['school'])) $this->school = $data['school'] ?? null;
        if(!empty($data['position'])) $this->position = $data['position'] ?? null;

        if(!empty($data['company_kr'])) $this->company_kr = $data['company_kr'] ?? null;
        if(!empty($data['company_en'])) $this->company_en = $data['company_en'] ?? null;
        if(!empty($data['company_zipcode'])) $this->company_zipcode = $data['company_zipcode'] ?? null;
        if(!empty($data['company_address'])) $this->company_address = $data['company_address'] ?? null;
        if(!empty($data['company_address2'])) $this->company_address2 = $data['company_address2'] ?? null;
        if(!empty($data['companyTel'])) $this->companyTel = $companyTel ?? null;
        if(!empty($data['si'])) $this->si = $data['si'] ?? null;
        if(!empty($data['gu'])) $this->gu = $data['gu'] ?? null;
        if(!empty($data['jext'])) $this->jext = $data['jext'] ?? 'N';

        if(!empty($data['memo'])) $this->memo = $data['memo'] ?? null;
    }


    public function fees()
    {
        return $this->hasMany(Fee::class, 'user_sid')->orderByDesc('year')->orderByDesc('sid');
    }
    public function lastFee()
    {
        return $this->hasOne(Fee::class, 'user_sid')->orderByDesc('year')->orderByDesc('sid')->limit('1');
    }
    public function isLifeMember() // 종신회원
    {
        return Fee::where(['user_sid'=>$this->sid, 'category'=>'C', 'del'=>'N', 'payment_status'=>'Y'])->exists();
    }

    public static function isAge50OrOlder($birthDate = null) {

        if(empty($birthDate)){
            return false;
        }

        // 생년월일을 DateTime 객체로 변환
        $birthDateObj = Carbon::createFromFormat('Y-m-d', $birthDate);

        if (!$birthDateObj) {
            return false; // 잘못된 날짜 형식이면 false 반환
        }

        // 현재 날짜 가져오기
        $today = Carbon::today();

        // 나이 계산 (만 나이)
        $age = $today->diffInYears($birthDateObj);

        // 생일이 지나지 않았다면 나이 1살 빼기
        if ($today->isBefore($birthDateObj->copy()->year($today->year))) {
            $age--; // 생일이 지나지 않았다면 1살 빼기
        }

        // 50세 이상인지 확인
        return $age >= 50;
    }

    public function addCustomData()
    {
        $user = $this;
        $user->getLevel = $this->getLevel();
        $user->isAge50OrOlder = false;
        if($this->gubun == 'N'){
            $user->isAge50OrOlder = self::isAge50OrOlder($this->birth_date);
        }

        return $user;
    }

    public function getLevel()
    {
        return $this->userConfig()['level'][$this->level] ?? '';
    }
}
