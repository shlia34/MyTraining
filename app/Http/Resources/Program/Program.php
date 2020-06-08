<?php

namespace App\Http\Resources\Program;

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
        $data["muscle_code"] = $this->muscle_code;
        $data["backgroundColor"] = $this->muscle_color;
        $data["borderColor"] = $this->muscle_color;
        $data["start"] = $this->date;
        $data["title"] = $this->muscle_name;
        return $data;
    }
}
