<?php

namespace App\Models\Traits;

use App\Defs\DefPart;

trait GetPartData
{
    public function getPartNameAttribute()
    {
        return DefPart::PART_NAME_LIST[$this->muscle_code];
    }

    public function getPartColorAttribute()
    {
        return DefPart::PART_COLOR[$this->muscle_code];
    }
}