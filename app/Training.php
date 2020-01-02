<?php

namespace App;

use App\Defs\DefStage;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $primaryKey = 'training_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function getStageName(){
        return array_column(DefStage::STAGE_LIST, $this->stage_code);
    }

}
