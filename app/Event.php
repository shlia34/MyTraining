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

    public function scopeWhereUserId($query){
        return $query->where('user_id',Auth::user()->user_id);
    }

    public function scopeSelectEventObjectColumn($query){
        return $query->select('event_id', 'part_code', 'date');
    }

}
