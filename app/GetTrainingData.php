<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GetTrainingData extends Model
{
    public function getStageName()
    {
        return Stage::where("stage_id",$this->stage_id)->first()->name ?? "";
        //maxが登録されてない場合は空文字を返す
    }

    public function getWeightAndRep(){
        if($this->weight && $this->rep){
            return $this->weight."kg". " * " .$this->rep."rep";
        }else{
            return "";
        }
    }

}
