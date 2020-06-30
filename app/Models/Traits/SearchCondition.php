<?php

namespace App\Models\Traits;


use Illuminate\Support\Arr;

trait SearchCondition
{

    public function searchByMuscle($query,$value)
    {
        if (isset($value['muscle_code'])) {
                $query->whereIn('muscle_code', $this->parseArr($value['muscle_code']));
        }
    }

    protected function parseArr($target)
    {
        return is_array($target) ? $target : [$target];
    }
    //todo 上二つなんとか共通化したい。

    public function searchByMuscleFromExercise($query,$value)
    {
        if (isset($value['muscle_code'])) {
            $query->whereIn('exercises.muscle_code', $this->parseArr($value['muscle_code']));
        }
    }

    public function searchByStart($query,$value){
        if(!empty( $value['start'] )){
            $query->where('date','>', $value['start']);
            //todo ここは>じゃなくて以上にしたい >=
        }
    }

    public function searchByEnd($query,$value){
        if(!empty( $value['end'] )){
            $query->where('date','<', $value['end']);
        }
    }

    public function searchByMemo($query,$value){
        if(!empty( $value['memo'] )){
            $memo =  $value['memo'];
            $query->where('memo','like', "%$memo%");
        }
    }

    public function searchByExerciseName($query, $value){
        if (!empty($value['name'])) {
            $name = $value['name'];
            $query->where('name', 'like', "%$name%");
        }
    }

    public function searchByIsMax($query, $value){
        if (!empty($isMax = Arr::get($value, 'is_max'))) {
            if ($isMax == true) {
                $query->where('is_max', 1);
            }
        }
    }
}

