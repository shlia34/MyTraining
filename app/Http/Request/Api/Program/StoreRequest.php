<?php

namespace App\Http\Request\Api\Program;

use App\Http\Request\Api\ApiRequest;
use App\Rules\DuplicatedMuscle;


class StoreRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'muscle_code' => ['required',new DuplicatedMuscle($this->validationData())],
            'memo' => 'max:100',
            'date' => 'required|date',
        ];
    }

    public function attributes()
    {
        return [
            'muscle_code' => '筋肉の部位',
            'memo' => 'メモ',
            'date' => '日付'
        ];
    }

    public function messages() {
        return [
            'memo.max:100' => ':attributeは100文字以内でお願いします。',
        ];
    }
}
