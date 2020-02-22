<?php

namespace App\Models;

use App\Defs\DefPart;
use App\Defs\DefPof;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\GetPartData;
use Illuminate\Support\Facades\Auth;

class Stage extends Model
{
    use GetPartData;

    public $incrementing = false;
    protected $primaryKey = 'stage_id';
    protected $keyType = 'string';

    public function Users(){
        return $this->belongsToMany('App\Models\User', 'stage_user','stage_id','user_id');
    }

    public function getPofName()
    {
        return DefPof::POF_LIST[$this->pof_code];
    }

    public function getUserStage(){
        $collection = Auth::user()->stages;
        return $this->getFormattedArr($collection);
    }

    public function getLeftStage(){
        $collection = Stage::all()->diff(Auth::user()->stages);
        return $this->getFormattedArr($collection);
    }

    public function getFormattedArr($collection)
    {
        $collection = $collection->groupBy('part_code');
        $partCodes =  array_keys( DefPart::PART_NAME_LIST );

        $arr = [];
        foreach ($partCodes as $partCode){
            if(isset($collection[$partCode])){
                $arr[$partCode] = $collection[$partCode];
            }else{
                $arr[$partCode] = [];
            }
        }

        return $arr;
    }


}
