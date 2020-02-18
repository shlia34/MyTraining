<?php

namespace App\Models;

use App\Defs\DefPof;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\GetPartData;

class Stage extends Model
{
    use GetPartData;

    public $incrementing = false;
    protected $primaryKey = 'stage_id';
    protected $keyType = 'string';

    public function getPofName()
    {
        return DefPof::POF_LIST[$this->pof_code];
    }

}
