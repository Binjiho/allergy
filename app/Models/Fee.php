<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Fee extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'payment_date',
        'deposit_date',
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

//    protected static function booted()
//    {
//        parent::boot();
//    }

    private function feeConfig()
    {
        return config('site.fee');
    }

    private function getEndDate()
    {
        // 입회비, 종신회비의 경우 유지 만료일 필요없음
        if ($this->category == 'A' || $this->category == 'C') {
            return null;
        }

        return $this->makeEDATE();
    }

    private function getDeadline()
    {
        // 셋팅되는 회원자격 만료일이 납부 마감일이지만 없을경우 회원자격 유지일 시작일로 부터 1년 뒤가 납부 마감일
        return $this->eDate ?? $this->makeEDATE();
    }

    public function makeEDATE()
    {
        $settingDate = Carbon::createFromFormat('Y-m-d', $this->sDate);
        return $settingDate->addYear(1)->subDays(1)->format('Y-m-d');
    }

    public function makeSDATE()
    {
        // 현재 날짜를 기반으로, 당해 년도의 1월 1일 반환
        return Carbon::now()->startOfYear()->format('Y-m-d');
    }

    public function setByData($data)
    {
        if (empty($this->sid)) {
            $this->user_sid = $data['user_sid'];
        }

        $this->sDate = empty($data['sDate']) ? $this->makeSDATE() : $data['sDate'];
        $this->eDate = empty($data['eDate']) ? $this->getEndDate() : $data['eDate'];
        $this->deadline = empty($data['deadline']) ? $this->getDeadline() : $data['deadline'];

        $this->year = $data['year'];

        $this->level = $data['level'];
        $this->category = $data['category'];
        $this->price = $data['price'] ?? 0;
        $this->payment_method = $data['payment_method'] ?? null;
        $this->payment_status = $data['payment_status'] ?? 'N';
        $this->payment_date = $data['payment_date'] ?? null;
        $this->depositor = $data['depositor'] ?? null;
        $this->deposit_date = $data['deposit_date'] ?? null;
        $this->memo = $data['memo'] ?? null;
    }

    public function setByTransfer($data)
    {
        $this->category = $data['category'] ?? null;
        $this->user_sid = $data['user_sid'] ?? null;
        $this->memo = $data['memo'] ?? null;
        $this->payment_status = $data['payment_status'] ?? 'N';
        $this->payment_method = $data['payment_method'] ?? null;

        $this->year = $data['year'];
        $this->payment_date = $data['payment_date'] ?? null;
        $this->price = $data['price'] ?? null;
        $this->sDate = $data['sDate'] ?? null;
        $this->eDate = $data['eDate'] ?? null;

        $this->resultCode = $data['resultCode'] ?? null;
        $this->level = $data['level'] ?? null;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_sid')->withTrashed();
    }

    public function getKind()
    {
        return $this->feeConfig()['kind'][$this->kind];
    }

//    public function getPrice()
//    {
//        return $this->feeConfig()['price'][$this->kind];
//    }

    public function getPaymentMethod()
    {
        return $this->feeConfig()['payment_method'][$this->payment_method] ?? '';
    }

    public function getPaymentStatus()
    {
        return $this->feeConfig()['payment_status'][$this->payment_status] ?? '';
    }

    public function getFeeMaintenance() // 회비 자격 유지기간
    {
        $period = '';

        if (!empty($this->sDate)) {
            $period .= $this->sDate . ' ~ ';
        }

        if (!empty($this->eDate)) {
            $period .= $this->eDate;
        }

        return $period;
    }

    public function isDeadline()
    {
        $dateToCheck = $this->deadline;

        // 현재 날짜 가져오기
        $now = Carbon::now();

        // 주어진 날짜를 Carbon 객체로 변환
        $date = Carbon::parse($dateToCheck);

        // 날짜 비교 (같거나 작은지 확인) false => 납부가능, true => 납부 불가
        return !$date->lessThanOrEqualTo($now);
    }
}
