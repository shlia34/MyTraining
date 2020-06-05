<?php

namespace App\Models;

use App\Models\Traits\ScopeOwn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * 実施した種目(exercisesとprogramsの中間テーブル)のモデルクラス
 *
 * @property string id      id
 * @property string exercise_id  種目ID
 * @property string program_id   プログラムID
 */

class Menu extends Model
{
    use ScopeOwn;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [ 'id','exercise_id','program_id'];

    public function workouts(){
        return $this->hasMany('App\Models\Workout');
    }

    public function program(){
        return $this->belongsTo('App\Models\Program');
    }

    public function scopeJoinExercise($query){
        return $query->addSelect([
            'menus.*',
            'exercises.name',
            'exercises.muscle_code',
        ])->leftJoin('exercises','menus.exercise_id', '=', 'exercises.id');
    }

    public function scopeJoinProgram($query){
        return $query->addSelect([
            'menus.*',
            'programs.date',
            'programs.user_id',
        ])->leftJoin('programs','menus.program_id', '=', 'programs.id');
    }


}
