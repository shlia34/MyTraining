<?php

namespace App;

class Training extends GetTrainingData
{
    protected $primaryKey = 'training_id';
    public $incrementing = false;
    protected $keyType = 'string';

    const CSV_LIST = [
        'training_id',
        'event_id',
        'stage_id',
        'weight',
        'rep',
        'created_at',
        'updated_at',
    ];

    public static function getCsvList(){
        return self::CSV_LIST;
    }

    public function scopeGetTrainingsFromEventId($query, string $eventId)
    {
        return $query->where('event_id', $eventId)->orderBY("created_at")->get()->groupBy('stage_id');
    }
}
