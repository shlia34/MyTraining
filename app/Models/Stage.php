<?php

namespace App\Models;

use App\Defs\DefPart;
use App\Defs\DefPof;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\GetPartData;
use App\Models\Traits\ScopeOwn;
use Illuminate\Support\Facades\Auth;

class Stage extends Model
{
    use GetPartData,ScopeOwn;

    public $incrementing = false;
    protected $primaryKey = 'stage_id';
    protected $keyType = 'string';

    protected $fillable = [ 'stage_id','name','part_code','pof_code','memo' ];

    public function Users(){
        return $this->belongsToMany('App\Models\User', 'stage_user','stage_id','user_id');
    }

    public function trainings()
    {
        return $this->hasMany('App\Models\Training','stage_id', 'stage_id');
    }

    public function getPofName()
    {
        return DefPof::POF_LIST[$this->pof_code];
    }

    public function scopeArrayForSelectBox($query,$partCode){
        $stageList = $query->where('part_code',$partCode)->orderBy('sort_no')->get();

        $array =  [];
        foreach ($stageList as $stage){
            $array[$stage->stage_id] = $stage->name;
        }
        return $array;
    }

    public function scopeByPart($query){
        $userStage = $query->orderBy("sort_no")->get()->groupBy('part_code');
        $leftStage = Stage::all()->diff(Auth::user()->stages)->groupBy('part_code');

        $partCodes =  array_keys( DefPart::PART_NAME_LIST );

        $array = [];
        foreach ($partCodes as $partCode){
            if(isset($userStage[$partCode])){
                $array[$partCode]["userStage"] = $userStage[$partCode];
            }else{
                $array[$partCode]["userStage"] = [];
            }

            if(!empty($leftStage[$partCode])){
                $array[$partCode]["leftStage"] = $leftStage[$partCode];
            }else{
                $array[$partCode]["leftStage"] = [];
            }
        }

        return $array;
    }

}
