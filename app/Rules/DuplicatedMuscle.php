<?php

namespace App\Rules;

use App\Models\Program;
use Illuminate\Contracts\Validation\Rule;

class DuplicatedMuscle implements Rule
{
    
    private $validationData;
    private $muscleCode;
    private $date;

    /**
     * DuplicatedMuscle constructor.
     * @param $validationData
     */
    public function __construct($validationData)
    {
        $this->validationData =  $validationData;
    }

    /**
     * 同じ日に同じ筋肉の部位が重複してないかチェック
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $date = $this->validationData;

        if(isset($date['muscle_code']))
        {
            $this->muscleCode = $date['muscle_code'];
            $this->date =  $date['date'];

        }elseif (isset($date['id']))
        {
            $oldProgram = Program::find($date['id']);
            $this->muscleCode = $oldProgram->muscle_code;
            $this->date =  $date['new_date'];
        }

        $program = Program::where('muscle_code',$this->muscleCode)->where('date',$this->date)->first();

        if(!empty($program)){
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return  '筋肉の部位が同じ日に重複しています';
    }
}
