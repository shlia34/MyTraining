<?php

namespace App\Http\Request\Api\Program;

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
            'id' => 'required',
            'new_date' => 'required|date',
        ];
    }

    protected function formatData()
    {
        $original = $this->validationData();
        $data['id'] = $original['id'];
        $data['new_date'] = $this->formatIsoDate( $original['new_date'] );
        return $data;
    }

}
