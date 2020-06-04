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
    use GetTrainingData,GetPartData,ScopeOwn;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [ 'id', 'user_id', 'date', 'muscle_code', 'memo' ];

    public function menus(){
        return $this->hasMany('App\Models\Menu','id', 'menu_id');
    }

    public function getMemoAttribute($value)
    {
        return $value ? "※".$value : "";
    }

    public function scopeJoinMaxTraining($query){
//        return $query->addSelect([
//            'programs.program_id',
//            'programs.part_code',
//            'programs.date',
//            'trainings.stage_id',
//            'trainings.weight',
//            'trainings.rep',
//        ])->leftJoin('trainings', function($join){
//                $join->on('programs.program_id', '=', 'trainings.program_id')->where("is_max", 1);
//        });

        //todo 一旦エラー回避
        return $query;
    }

}
