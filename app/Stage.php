<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    const CSV_LIST = [
        'stage_id',
        'name',
        'part_code',
        'memo',
    ];
    public $incrementing = false;
    protected $primaryKey = 'stage_id';
    protected $keyType = 'string';

    public static function getCsvList(){
        return self::CSV_LIST;
    }

}
