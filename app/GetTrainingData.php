<?php

namespace App;

use App\Defs\DefStage;
use Illuminate\Database\Eloquent\Model;

class GetTrainingData extends Model
{
    public function getStageName()
    {
        return array_column(DefStage::STAGE_NAME_LIST,$this->stage_code)[0];
    }

    public function getStageInitialName()
    {
        return DefStage::STAGE_INITIAL_NAME_LIST[$this->stage_code] ?? "";
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
