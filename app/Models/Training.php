<?php

namespace App\Models;

use App\Models\Traits\GetTrainingData;
use App\Models\Traits\ScopeOwn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

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

class Training extends Model
{
    use GetTrainingData,ScopeOwn;

    protected $primaryKey = 'training_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [ 'training_id','event_id','stage_id','weight','rep','is_max' ];

    protected $perPage = 8;

    public function scopeGroupByStage($query){
        return $query->oldest()->get()->groupBy('stage_id');
    }

    public function scopeJoinEvent($query){
        return $query->addSelect([
            'trainings.training_id',
            'trainings.event_id',
            'trainings.stage_id',
            'trainings.weight',
            'trainings.rep',
            'trainings.stage_id',
            'trainings.is_max',
            'trainings.created_at',
            'trainings.updated_at',
            'events.date',
            'events.user_id',
            'events.memo',
        ])->leftJoin('events','trainings.event_id', '=', 'events.event_id');
    }

    public function scopePaginator($query,$request,$stageId){
        $trainings = $query->joinEvent()->oldest()->own()->get()->groupBy('date')->sortKeysDesc();

        $paginatorTrainings = new LengthAwarePaginator(
            $trainings->forPage($request->page, $this->perPage),
            count($trainings),
            $this->perPage);
        $paginatorTrainings->withPath("/stages/{$stageId}");

        return $paginatorTrainings;
    }

}
