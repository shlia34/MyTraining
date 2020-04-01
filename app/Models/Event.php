<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\GetTrainingData;
use App\Models\Traits\GetPartData;
use App\Models\Traits\ScopeOwn;

/**
 * イベントのモデルクラス
 *
 * @property string event_id  イベントID
 * @property string user_id   ユーザーID
 * @property string part_code 部位コード
 * @property date   date      日付
 * @property string memo      メモ
 */

class Event extends Model
{
    use GetTrainingData,GetPartData,ScopeOwn;

    protected $primaryKey = 'event_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [ 'event_id', 'user_id', 'date', 'part_code', 'memo' ];

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
        $data["id"] = $this->event_id;
        $data["part_code"] = $this->part_code;
        $data["backgroundColor"] = $this->getPartColor();
        $data["borderColor"] = $this->getPartColor();
        $data["start"] = $this->date;
        $data["title"] = $this->getPartName();
        $data["stage_name"] = $this->getStageName();
        $data["weight_and_rep"] = $this->getWeightAndRep();

        return $data;
    }

    public function scopeArrayForJson($query)
    {
        $events = $query->get();
        $arr = [];
        foreach ($events as $event) {
            $arr[] = $event->getDataForJson();
        }
        return $arr;
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
                $join->on('events.event_id', '=', 'trainings.event_id')->where("is_max", 1);
        });
    }

}
