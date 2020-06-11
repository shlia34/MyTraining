<?php

namespace App\Http\Request\Api\Program;

use App\Http\Request\Api\ApiRequest;

abstract class IsoDateRequest extends ApiRequest
{
    /**
     * ISO形式の日付を「2020-01-01」のように整形
     * @param $date
     * @return mixed
     */
    protected function formatIsoDate($date)
    {
        if(strpos($date,'T') ) {
            return strstr($date, 'T', true);
        }else{
            return $date;
        }
    }
}
