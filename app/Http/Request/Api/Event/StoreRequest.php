<?php

namespace App\Http\Request\Api\Event;

use App\Http\Request\Api\ApiRequest;

class StoreRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'part_code' => 'required',
            //2文字以内で数字のバリデーションもつける
            'memo' => 'max:100',
            'date' => 'required|date',
        ];
    }

    public function attributes()
    {
        return [
            'part_code' => 'part_code',
            'memo' => 'メモ',
            'date' => 'date'
        ];
    }

    public function messages() {
        return [
            'memo.required' => ':attributeは100文字以内でお願いします。',
        ];
    }

}
