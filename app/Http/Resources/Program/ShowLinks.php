<?php

namespace App\Http\Resources\Program;

use App\Http\Resources\Workout as WorkoutResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowLinks extends JsonResource
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
        $data["title"] = $this->muscle_name;
        $data["maxWorkout"] = new WorkoutResource($this->maxWorkout->first());
        return $data;
    }
}
