<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $primaryKey = 'training_id';
    public $incrementing = false;
    protected $keyType = 'string';

}
