<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Choice extends Model
{
    protected $primaryKey = 'seq';
    protected $table = "stage_user";

    public function generateSortNo($partCode)
    {
        $lastStage = Auth::user()->stages()->where("part_code",$partCode)->orderBy('sort_no','desc')->first();

        if ($lastStage) {
            $lastSortId = $lastStage->pivot->sort_no;
            return $lastSortId + 1;
        } else {
            return 1;
        }
    }
}
