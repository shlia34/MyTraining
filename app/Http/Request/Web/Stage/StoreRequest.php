<?php

namespace App\Http\Request\Web\Stage;

use App\Http\Request\Web\WebRequest;


class StoreRequest extends WebRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:20',
            'part_code' => 'required|size:2',
            'pof_code' => 'required|size:2',
            'memo' => 'max:200'
        ];
    }

    public function attributes()
    {
        return [
            'name' => '種目名',
            'part_code' => '部位',
            'pof_code' => 'POF',
            'memo' => 'メモ'
        ];
    }

    public function messages() {
        return [
            'name.required' => ':attributeは必須です。',
            'name.max:20' => ':attributeは20文字以内です。',
            'part_code.required' => ':attributeを選択してください。',
            'pof_code.required' => ':attributeは選択してください。',
            'memo.max:200' => ':attributeは200文字以内です。',
        ];
    }

}
