<?php

namespace App\Models;

use App\Services\CommonServices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchPrize extends Model
{
    use HasFactory;

    public $table = 'research_prizes';

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
        $this->year = $data['year'] ?? date('Y');
        $this->gubun = $data['gubun'] ?? null;
        $this->name_kr = $data['name_kr'] ?? null;
        $this->sosok = $data['sosok'] ?? null;
        $this->regnum = $data['regnum'] ?? null;
        $this->title = $data['title'] ?? null;

        $this->order = $data['order'] ?? (self::max('order') + 1);
        $this->del = $data->del ?? 'N';
    }

    public function setByDataModify($data)
    {
        $this->year = $data['year'] ?? date('Y');
        $this->gubun = $data['gubun'] ?? null;
        $this->name_kr = $data['name_kr'] ?? null;
        $this->sosok = $data['sosok'] ?? null;
        $this->regnum = $data['regnum'] ?? null;
        $this->title = $data['title'] ?? null;
    }


}
