<?php

namespace App\Models;

use App\Models\Traits\ScopeOwn;
use Illuminate\Database\Eloquent\Model;

/**
 * トレーニングのモデルクラス
 *
 * @property string training_id トレーニングID
 * @property string event_id    イベントID
 * @property string stage_id    種目ID
 * @property string weight      重量
 * @property float  rep         レップ数
 * @property boolean is_max     最大強度かどうか
 */

class Workout extends Model
{
    use ScopeOwn;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [ 'id','menu_id','weight','rep','is_max' ];

    protected $appends = [ 'weight_and_rep',];

    public function menu(){
        return $this->belongsTo('App\Models\Menu');
    }

    public function getExerciseNameAttribute()
    {
        return $this->menu->exercise->name;
    }

    public function getExerciseIdAttribute()
    {
        return $this->menu->exercise->id;
    }

    public function getWeightAndRepAttribute(){
        if( ($this->weight !== null) && ($this->rep !== null) ){
            return $this->weight."kg". " * " .$this->rep."rep";
        }else{
            return "";
        }
    }




}
