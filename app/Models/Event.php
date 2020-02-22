<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\GetTrainingData;
use App\Models\Traits\GetPartData;

class Event extends Model
{
    use GetTrainingData,GetPartData;

    protected $primaryKey = 'event_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function trainings()
    {
        return $this->hasMany('App\Models\Training','event_id', 'event_id');
    }

    public function getMemo()
    {
        return $this->memo ? "※".$this->memo : "";
    }

    public function getDataForJson()
    {
        $newItem["id"] = $this->event_id;
        $newItem["part_code"] = $this->part_code;
        $newItem["backgroundColor"] = $this->getPartColor();
        $newItem["borderColor"] = $this->getPartColor();
        $newItem["start"] = $this->date;
        $newItem["title"] = $this->getPartName();
        $newItem["stage_name"] = $this->getStageName();
        $newItem["weight_and_rep"] = $this->getWeightAndRep();

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

    public function scopeOwn($query){
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
            'trainings.stage_id',
            'trainings.weight',
            'trainings.rep',
        ])->leftJoin('trainings', function($join){
                $join->on('events.event_id', '=', 'trainings.event_id')->where("is_max",true);
        });
    }

}
