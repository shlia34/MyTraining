<?php

namespace App\Http\Resources\Exercise;

use Illuminate\Http\Resources\Json\JsonResource;

class SelectBox extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data["value"] = $this->id;
        $data["text"] = $this->name;
        return $data;
    }
}
