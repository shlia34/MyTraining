<?php

namespace App\Models\Traits;

use App\Defs\DefPart;

//今のところEvent.phpでしか使ってないけど今後多分Stage.phpでも使うかも
trait GetPartData
{
    public function getPartNameAttribute()
    {
        return DefPart::PART_NAME_LIST[$this->part_code];
    }

    public function getPartColorAttribute()
    {
        return DefPart::PART_COLOR[$this->part_code];
    }
}