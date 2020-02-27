<?php

namespace App\Http\Request\Api;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class ApiRequest extends FormRequest
{
    abstract public function rules();
//    abstract public function attributes();
//    abstract public function messages();
//    めんどいからコメントアウト

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * 親クラスではhtmlを返すのでAPI用に上書きする
     * バリデーションエラーが起きた場合、422エラーを投げる。
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator) {
        $res = response()->json([
            "status" => 422,
            "errors" => $validator->errors(),
        ], 422);
        throw new HttpResponseException($res);
    }
}
