<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Program extends JsonResource
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
        //todo いったんかわす
//        $data["stage_name"] = $this->stage_name;
//        $data["weight_and_rep"] = $this->weight_and_rep;
        return $data;
    }
}
