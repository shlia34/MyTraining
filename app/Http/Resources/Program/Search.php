<?php

namespace App\Http\Resources\Program;

use App\Http\Resources\Workout\Workout as WorkoutResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Search extends JsonResource
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
        $data["muscle_name"] = $this->muscle_name;
        $data["date"] = $this->date;
        $data["memo"] = $this->memo;
        $data["max_workout"] = new WorkoutResource($this->maxWorkout->first());
        return $data;
    }
}
