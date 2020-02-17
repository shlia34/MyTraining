<?php

namespace App\Models\Traits;

use App\Defs\DefPart;

trait GetPartData
{
    public function getPartName()
    {
        return DefPart::PART_NAME_LIST[$this->part_code];
    }

    public function getPartColor()
    {
        return DefPart::PART_COLOR[$this->part_code];
    }
}