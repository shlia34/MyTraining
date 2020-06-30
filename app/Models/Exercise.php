<?php

namespace App\Models;

use App\Defs\DefMuscle;
use App\Models\Traits\SearchCondition;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\ScopeOwn;

/**
 * 種目のモデルクラス
 *
 * @property string id  種目ID
 * @property string name      種目名
 * @property string muscle_code 部位コード
 */

class Exercise extends Model
{
    use ScopeOwn,SearchCondition;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [ 'id','name','muscle_code', ];
    protected $appends = [ 'muscle_name',];

    public function menus(){
        return $this->hasMany('App\Models\Menu')->joinProgram();
    }

    public function workouts(){
        return $this->hasManyThrough('App\Models\Workout','App\Models\Menu');
    }

    public function getMuscleNameAttribute()
    {
        return DefMuscle::MUSCLE_NAME_LIST[$this->muscle_code];
    }

    public function scopeSearch($query, $value)
    {
        $this->searchByMuscle($query, $value);
        $this->searchByExerciseName($query, $value);
        return $query;
    }

}
