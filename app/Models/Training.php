<?php

namespace App\Models;

use App\Models\Traits\GetTrainingData;
use App\Models\Traits\ScopeOwn;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use GetTrainingData,ScopeOwn;

    protected $primaryKey = 'training_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function scopeGetTrainingsFromEventId($query, string $eventId)
    {
        return $query->where('event_id', $eventId)->orderBY("created_at")->get()->groupBy('stage_id');
    }

    public function scopeJoinEvent($query){
        return $query->addSelect([
            'trainings.training_id',
            'trainings.event_id',
            'trainings.stage_id',
            'trainings.weight',
            'trainings.rep',
            'trainings.stage_id',
            'trainings.is_max',
            'trainings.created_at',
            'trainings.updated_at',
            'events.date',
            'events.user_id',
            'events.memo',
        ])->leftJoin('events','trainings.event_id', '=', 'events.event_id');
    }

}
