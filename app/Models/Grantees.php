<?php

namespace App\Models;

use App\Services\CommonServices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grantees extends Model
{
    use HasFactory;

    public $table = 'grantees';

    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
    ];
    protected $casts = [

    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function setByData($data)
    {
        $this->year = trim($data->year) ?? date('Y');
        $this->title = trim($data->title) ?? null;
        $this->event_date = trim($data->event_date) ?? null;
        $this->place = trim($data->place) ?? null;
        $this->name_kr = trim($data->name_kr) ?? null;

        $this->license_number = trim($data->license_number) ?? null;
        $this->memo = $data->memo ?? null;
        $this->del = $data->del ?? 'N';
    }

}
