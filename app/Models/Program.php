<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\GetTrainingData;
use App\Models\Traits\GetPartData;
use App\Models\Traits\ScopeOwn;
/**
 * プログラムのモデルクラス（何日にどこの筋肉を鍛えたか）
 *
 * @property string id  プログラムID
 * @property string user_id   ユーザーID
 * @property string muscle_code 部位コード
 * @property date   date      日付
 * @property string memo      メモ
 */

class Program extends Model
{
    use GetPartData,ScopeOwn;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [ 'id', 'user_id', 'date', 'muscle_code', 'memo' ];

    public function menus(){
        return $this->hasMany('App\Models\Menu')->joinExercise()->oldest();
    }

    public function exercises(){
        return $this->belongsToMany('App\Models\Exercise','menus');
    }

    public function workouts(){
        return $this->hasManyThrough('App\Models\Workout','App\Models\Menu');
    }

    public function maxWorkout(){
        return $this->workouts()->where("is_max", 1);
    }

    public function getMemoAttribute($value)
    {
        return $value ? "※".$value : "";
    }

    public function scopePrevious($query,$thisProgram){
        return $query->where('muscle_code',$thisProgram->muscle_code)->Own()->whereDate("date", "<", $thisProgram->date)->latest("date");
    }

}
