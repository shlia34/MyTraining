<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserStage extends Model
{
    protected $primaryKey = 'seq';
    protected $table = "stage_user";
}
