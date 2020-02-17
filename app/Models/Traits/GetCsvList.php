<?php

namespace App\Models\Traits;

trait GetCsvList
{
    public static function getCsvList(){
        return self::CSV_LIST;
    }
}