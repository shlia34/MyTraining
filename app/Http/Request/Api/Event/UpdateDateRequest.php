<?php

namespace App\Http\Request\Api\Event;

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
            'newDate' => 'required|date',
        ];
    }

    protected function formatData()
    {
        $original = $this->validationData();
        $data['id'] = $original['id'];
        $data['newDate'] = $this->formatIsoDate( $original['newDate'] );
        return $data;
    }

}
