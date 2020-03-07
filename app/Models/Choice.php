<?php

namespace App\Models;

use App\Models\Traits\ScopeOwn;
use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    use ScopeOwn;

    protected $primaryKey = 'seq';
    protected $table = "stage_user";

    public function scopeWhereStage($query,$stageId)
    {
        return $query->where('stage_id',$stageId);
    }
}
