<?php

namespace App\Http\Request\Api\Workout;

use App\Http\Request\Api\ApiRequest;

class StoreRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'program_id' => 'required',
            'exercise_id' => 'required',
            'weight' => ['required', 'gt:0','max:999.9','numeric','not_regex:/[\.][0-9]{2,}/','not_regex:/^[0][0-9]/'],
            'rep' => ['required','integer','gt:0','digits_between:1,2'],
        ];
    }

    public function attributes()
    {
        return [
            'program_id' => 'program_id',
            'exercise_id' => 'exercise_id',
            'weight' => 'weight',
            'rep' => 'rep',
        ];
    }

    public function messages() {
        return [
            'weight.required' => ':attributeは無効な値です',
            'weight.gt' => ':attributeは0より大きい数字でお願いします',
            'weight.max' => ':attributeは999.9より小さい数字でお願いします',
            'weight.not_regex' => ':attributeは無効な値です',
            'rep.required' => ':attributeは無効な値です',
            'rep.integer' => ':attributeは整数でお願いします',
            'rep.gt' => ':attributeは0より大きい数字でお願いします',
            'rep.digits_between' => ':attributeは2桁以内の整数でお願いします',
        ];
    }
}
