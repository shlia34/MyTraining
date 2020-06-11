<?php

namespace App\Http\Request\Api\Program;

class ShowLinksRequest extends IsoDateRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => 'required|date',
        ];
    }

    protected function passedValidation()
    {
        $original = $this->validationData();
        $this->replace(['date' => $this->formatIsoDate($original['date']) ]);
    }
}
