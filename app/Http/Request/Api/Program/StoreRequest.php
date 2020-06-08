<?php

namespace App\Http\Request\Api\Program;

use App\Http\Request\Api\ApiRequest;

class StoreRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'muscle_code' => 'required',
            //2文字以内で数字のバリデーションもつける
            'memo' => 'max:100',
            'date' => 'required|date',
        ];
    }

    public function attributes()
    {
        return [
            'muscle_code' => 'muscle_code',
            'memo' => 'メモ',
            'date' => 'date'
        ];
    }

    public function messages() {
        return [
            'memo.max:100' => ':attributeは100文字以内でお願いします。',
        ];
    }

}
