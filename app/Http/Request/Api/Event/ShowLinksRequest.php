<?php

namespace App\Http\Request\Api\Event;

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

    protected function formatData()
    {
        $original = $this->validationData();
        $data['date'] = $this->formatIsoDate($original['date']);
        return $data;
    }

}
