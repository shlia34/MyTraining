<?php

namespace App\Models;

use App\Models\Traits\ScopeOwn;
use Illuminate\Database\Eloquent\Model;

/**
 * 種目選択(exercisesとusersの中間テーブル)のモデルクラス
 *
 * @property string id      id
 * @property string exercise_id  種目ID
 * @property string user_id   ユーザーID
 * @property string sort_no   並び順
 */

class Routine extends Model
{
    use ScopeOwn;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [ 'id','user_id', 'exercise_id', 'sort_no' ];


    public function scopeWhereExercise($query,$exerciseId)
    {
        return $query->where('exercise_id',$exerciseId);
    }
}
