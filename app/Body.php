<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Body extends Model
{
    protected $primaryKey = 'body_id';
    public $incrementing = false;
    protected $keyType = 'string';

}
