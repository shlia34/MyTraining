<?php

namespace App\Models\Traits;

use App\Models\Stage;

trait GetTrainingData
{
    public function getStageNameAttribute()
    {
        return Stage::where("stage_id",$this->stage_id)->first()->name ?? "";
        //maxが登録されてない場合は空文字を返す
    }

    public function getWeightAndRepAttribute(){
        if( ($this->weight !== null) && ($this->rep !== null) ){
            return $this->weight."kg". " * " .$this->rep."rep";
        }else{
            return "";
        }
    }
}