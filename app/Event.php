<?php

namespace App;

use App\Defs\DefPart;
use Illuminate\Support\Facades\Auth;

class Event extends GetTrainingData
{
    protected $primaryKey = 'event_id';
    public $incrementing = false;
    protected $keyType = 'string';

    const CSV_LIST = [
        'event_id',
        'user_id',
        'date',
        'part_code',
        'memo',
        'max_training_id',
        'created_at',
        'updated_at',
    ];

    public static function getCsvList(){
        return self::CSV_LIST;
    }

    //todo Modelsってディレクトリ作ってその中に入れたい
    public function getPartName()
    {
        return DefPart::PART_NAME_LIST[$this->part_code];
    }

    public function getPartColor()
    {
        return DefPart::PART_COLOR[$this->part_code];
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
            'trainings.stage_id',
            'trainings.weight',
            'trainings.rep',
        ])->leftJoin('trainings', 'events.max_training_id', '=', 'training_id');
    }

}
