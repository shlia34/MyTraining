<?php

namespace App\Http\Request\Web\Exercise;

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
            'muscle_code' => 'required|size:2',
        ];
    }

    public function attributes()
    {
        return [
            'name' => '種目名',
            'muscle_code' => '筋肉の部位',
        ];
    }

    public function messages() {
        return [
            'name.required' => ':attributeは必須です。',
            'name.max:20' => ':attributeは20文字以内です。',
            'muscle_code.required' => ':attributeを選択してください。',
        ];
    }

}
