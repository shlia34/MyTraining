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


    public function getPartName()
    {
        return DefPart::PART_NAME_LIST[$this->part_code];
    }

    public function getPartColor()
    {
        return DefPart::PART_COLOR[$this->part_code];
    }

    public function getStageInitialName()
    {
        return DefStage::STAGE_INITIAL_NAME_LIST[$this->stage_code] ?? "";
    }

    public function getDataForJson()
    {
        $newItem["id"] = $this->event_id;
        if( !empty($this->weight && $this->rep) and !Agent::isMobile() ){
            $newItem["title"] = $this->getPartName()." ".$this->getStageInitialName()." ".$this->weight."kg".$this->rep."rep";
        }else{
            $newItem["title"] = $this->getPartName();
        }
        $newItem["part_code"] = $this->part_code;
        $newItem["url"] = "/event/".$this->event_id;
        $newItem["backgroundColor"] = $this->getPartColor();
        $newItem["borderColor"] = $this->getPartColor();
        $newItem["start"] = $this->date;
        return $newItem;
    }

//    public function getTitleForJson(){
//        if(Agent::isMobile()){
//
//        }
//
//        return $title;
//    }

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
