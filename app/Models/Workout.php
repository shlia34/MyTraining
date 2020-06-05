<?php

namespace App\Models;

use App\Models\Traits\GetTrainingData;
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
    use GetTrainingData,ScopeOwn;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [ 'id','menu_id','weight','rep','is_max' ];

    protected $perPage = 8;

}
