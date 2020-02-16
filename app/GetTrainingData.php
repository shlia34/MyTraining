<?php

namespace App;

use App\Defs\DefStage;
use Illuminate\Database\Eloquent\Model;

class GetTrainingData extends Model
{
    public function getStageName()
    {
        return Stage::where("stage_id",$this->stage_id)->first()->name ?? "";
        //maxが登録されてない場合は空文字を返す
    }

    public function getWeightAndRep(){
        return $this->getWeight(). " * " .$this->getRep();
        //三項演算子
    }

    public function getWeight(){
        return $this->weight ? $this->weight."kg" : "";
    }

    public function getRep(){
        return $this->rep ? $this->rep."rep" : "";
    }

}
