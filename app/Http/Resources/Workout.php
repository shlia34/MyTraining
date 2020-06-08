<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Workout extends JsonResource
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
        $data["menu_id"] = $this->menu_id;
        $data["weight_and_rep"] = $this->weight_and_rep;
        $data["exercise_id"] = $this->exercise_id;
        $data["exercise_name"] = $this->exercise_name;
        return $data;
    }
}
