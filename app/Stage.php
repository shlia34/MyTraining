<?php

namespace App;

use App\Defs\DefPart;
use App\Defs\DefPof;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
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

    public static function getCsvList(){
        return self::CSV_LIST;
    }

    //todo ここeventとかぶってる
    public function getPartName()
    {
        return DefPart::PART_NAME_LIST[$this->part_code];
    }

    public function getPofName()
    {
        return DefPof::POF_LIST[$this->pof_code];
    }

}
