<?php

namespace App\Models;

use App\Models\Traits\ScopeOwn;
use Illuminate\Database\Eloquent\Model;

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
