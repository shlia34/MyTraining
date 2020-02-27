<?php

namespace App\Http\Request\Api\Event;

use App\Http\Request\Api\ApiRequest;

abstract class IsoDateRequest extends ApiRequest
{
    /**
     * 整形したデータを取得
     * @return mixed
     */
    public function getFormattedData(){
        return $this->formatData();
    }

    abstract protected function formatData();

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
