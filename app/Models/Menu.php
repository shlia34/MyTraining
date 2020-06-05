<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 実施した種目(exercisesとprogramsの中間テーブル)のモデルクラス
 *
 * @property string id      id
 * @property string exercise_id  種目ID
 * @property string program_id   プログラムID
 */

class Menu extends Model
{

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [ 'id','exercise_id','program_id'];

    public function workouts(){
        return $this->hasMany('App\Models\Workout');
    }

    public function scopeJoinExercise($query){
        return $query->addSelect([
            'menus.*',
            'exercises.name',
            'exercises.muscle_code',
        ])->leftJoin('exercises','menus.exercise_id', '=', 'exercises.id');
    }


}
