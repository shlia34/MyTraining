<?php

namespace App;

class Training extends GetTrainingData
{
    protected $primaryKey = 'training_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function scopeGetTrainingsFromEventId($query, string $eventId)
    {
        return $query->where('event_id', $eventId)->orderBY("created_at")->get()->groupBy('stage_code');
    }
}
