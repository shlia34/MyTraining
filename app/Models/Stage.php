<?php

namespace App\Models;

use App\Defs\DefPart;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\ScopeOwn;
use Illuminate\Support\Facades\Auth;

/**
 * 種目のモデルクラス
 *
 * @property string stage_id  種目ID
 * @property string name      種目名
 * @property string part_code 部位コード
 * @property string pof_code  POFコード(POF=Position of Flexion,負荷がかかるタイミングのこと)
 * @property string memo      メモ
 */

class Stage extends Model
{
    use ScopeOwn;

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
