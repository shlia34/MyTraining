<?php

namespace App;

use App\Defs\DefStage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Training extends Model
{
    protected $primaryKey = 'training_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function getStageName():string
    {
        return array_column(DefStage::STAGE_NAME_LIST, $this->stage_code)[0];
    }

    public function scopeGetTrainingsArrFromEventId($query, string $eventId):Collection
    {
        return $query->where('event_id', $eventId)->orderBY("created_at")->get()->groupBy('stage_code');
    }

}
