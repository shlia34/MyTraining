<?php

namespace App\Http\Resources\Program;

use Illuminate\Http\Resources\Json\JsonResource;

class Set extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data["id"] = $this->id;
        $data["part_code"] = $this->muscle_code;
        $data["backgroundColor"] = $this->part_color;
        $data["borderColor"] = $this->part_color;
        $data["start"] = $this->date;
        $data["title"] = $this->part_name;
        return $data;
    }
}
