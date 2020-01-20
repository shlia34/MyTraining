<?php

namespace App;

use App\Defs\DefPart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Event extends Model
{
    protected $primaryKey = 'event_id';
    public $incrementing = false;
    protected $keyType = 'string';


    public function getPartName()
    {
        return DefPart::PART_LIST[$this->part_code];
    }

    public function getPartColor()
    {
        return DefPart::PART_COLOR[$this->part_code];
    }

    public function getArrForAjax()
    {
        $newItem["id"] = $this->event_id;
        if( !empty($this->weight && $this->rep) ){
            $newItem["title"] = $this->getPartName()." ".$this->weight."*".$this->rep;
        }else{
            $newItem["title"] = $this->getPartName();
        }
        $newItem["part_code"] = $this->part_code;
        $newItem["backgroundColor"] = $this->getPartColor();
        $newItem["borderColor"] = $this->getPartColor();
        $newItem["start"] = $this->date;
        return $newItem;
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
