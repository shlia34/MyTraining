<?php

namespace App\Models;

use App\Defs\DefMuscle;
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

    public function menus(){
        return $this->hasMany('App\Models\Menu')->joinProgram();
    }

    public function workouts(){
        return $this->hasManyThrough('App\Models\Workout','App\Models\Menu');
    }

}
