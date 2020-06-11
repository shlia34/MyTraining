<?php

namespace App\Http\Request\Api\Program;

use App\Rules\DuplicatedMuscle;

class UpdateDateRequest extends IsoDateRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => ['required', new DuplicatedMuscle($this->validationData())],
            'new_date' => 'required|date',
        ];
    }

    public function passedValidation()
    {
        $original = $this->validationData();
        $this->replace(['id' => $original['id'],
                        'new_date' => $this->formatIsoDate($original['new_date']) ]);
    }

}
