<?php

namespace App\Models;

use App\Models\Traits\ScopeOwn;
use Illuminate\Database\Eloquent\Model;

/**
 * 種目選択(stageとuserの中間テーブル)のモデルクラス
 *
 * @property string seq       シークエンス
 * @property string stage_id  種目ID
 * @property string user_id   ユーザーID
 * @property string sort_no   日付
 */

class Choice extends Model
{
    use ScopeOwn;

    protected $primaryKey = 'seq';
    //指定しないと$choice->delete()が動かない
    protected $table = "stage_user";

    protected $fillable = [ 'user_id', 'stage_id', 'sort_no' ];


    public function scopeWhereStage($query,$stageId)
    {
        return $query->where('stage_id',$stageId);
    }
}
