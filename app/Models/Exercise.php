<?php

namespace App\Models;

use App\Defs\DefPart;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\ScopeOwn;
use Illuminate\Support\Facades\Auth;

/**
 * 種目のモデルクラス
 *
 * @property string id  種目ID
 * @property string name      種目名
 * @property string muscle_code 部位コード
 */

class Exercise extends Model
{
    use ScopeOwn;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [ 'id','name','muscle_code', ];

    public function Users(){
        return $this->belongsToMany('App\Models\User', 'routines');
    }

    public function trainings()
    {
        return $this->hasMany('App\Models\Workout','stage_id', 'stage_id');
    }

    public function scopeArrayForSelectBox($query,$partCode){
        $routineList = $query->where('muscle_code',$partCode)->orderBy('sort_no')->get();

        $array =  [];
        foreach ($routineList as $exercise){
            $array[$exercise->exercise_id] = $exercise->name;
        }
        return $array;
    }

    //todo ここが変わる。絶対直した方がいい
    public function scopeByPart($query){
        $userStage = $query->orderBy("sort_no")->get()->groupBy('muscle_code');

        $leftStage = Exercise::all()->diff(Auth::user()->exercises)->groupBy('muscle_code');
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
