<?php

namespace App\Models;

use App\Defs\DefPof;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\GetCsvList;
use App\Models\Traits\GetPartData;

class Stage extends Model
{
    use GetCsvList,GetPartData;

    public $incrementing = false;
    protected $primaryKey = 'stage_id';
    protected $keyType = 'string';

    const CSV_LIST = [
        'stage_id',
        'name',
        'part_code',
        'pof_code',
        'sort_num',
        'memo',
        'created_at',
        'updated_at',
    ];

    public function getPofName()
    {
        return DefPof::POF_LIST[$this->pof_code];
    }

}
