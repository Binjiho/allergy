<?php

namespace App\Models;

use App\Services\CommonServices;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class Heart extends Authenticatable
{
    use HasFactory;

    protected $table = 'hearts';

    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
//        'gubun'  => 'array',
    ];

    public function setByData($data)
    {
        if(empty($this->sid)) {
            $this->user_sid = $data['user_sid'] ?? null;
            $this->bsid = $data['bsid'] ?? null;
            $this->created_at = date('Y-m-d H:i:s');
        }
        $this->updated_at = date('Y-m-d H:i:s');
    }

    public function board()
    {
        return $this->belongsTo(Board::class, 'bsid');
    }
}
