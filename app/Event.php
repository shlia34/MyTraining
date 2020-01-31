<?php

namespace App;

use App\Defs\DefPart;
use App\Defs\DefStage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Facades\Agent;

class Event extends Model
{
    protected $primaryKey = 'event_id';
    public $incrementing = false;
    protected $keyType = 'string';

    //todo Modelsってディレクトリ作ってその中に入れたい

    public function getPartName()
    {
        return DefPart::PART_NAME_LIST[$this->part_code];
    }

    public function getPartColor()
    {
        return DefPart::PART_COLOR[$this->part_code];
    }

    //todo ここ被ってるから、eventとtraining.phpの下に一個class挟む。
    public function getStageName()
    {
        return DefStage::STAGE_NAME_LIST[$this->stage_code] ?? "";
    }

    public function getWeight(){
        return $this->weight ? $this->weight."kg" : "";
    }

    public function getRep(){
        return $this->rep ? $this->rep."rep" : "";


    }

    public function getStageInitialName()
    {
        return DefStage::STAGE_INITIAL_NAME_LIST[$this->stage_code] ?? "";
    }


    public function getDataForJson()
    {
        $newItem["id"] = $this->event_id;
        $newItem["part_code"] = $this->part_code;
        $newItem["backgroundColor"] = $this->getPartColor();
        $newItem["borderColor"] = $this->getPartColor();
        $newItem["start"] = $this->date;

        if(Agent::isMobile()){
            $newItem["title"] = $this->getPartName();
        }else{
            $newItem["url"] = "/event/".$this->event_id;
            $newItem["title"] = $this->getPartName()." ".$this->getStageInitialName()." ".$this->getWeight().$this->getRep();
        }
        $newItem["stage_name"] = $this->getStageName();
        $newItem["weight"] = $this->getWeight();
        $newItem["rep"] = $this->getRep();

        return $newItem;
    }

    public function scopeConvertToArrForJson($query)
    {
        $events = $query->get();
        $arr = [];
        foreach ($events as $event) {
            $arr[] = $event->getDataForJson();
        }
        return $arr;
    }

    public function scopeWhereUserId($query){
        return $query->where('user_id',Auth::user()->user_id);
    }

    public function scopeOrderByPartCode($query){
        return $query->orderBy('part_code');
    }

    public function scopeJoinMaxTraining($query){
        return $query->addSelect([
            'events.event_id',
            'events.part_code',
            'events.date',
            'trainings.stage_code',
            'trainings.weight',
            'trainings.rep',
        ])->leftJoin('trainings', 'events.max_training_id', '=', 'training_id');
    }

}
