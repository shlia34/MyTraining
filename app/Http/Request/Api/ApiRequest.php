<?php

namespace App\Http\Request\Api;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class ApiRequest extends FormRequest
{
    abstract public function rules();

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
     * バリデーションエラーが起きた場合、throwError()を実行
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $this->throwError($validator->errors());
    }

    /**
     * 実際にエラーを投げる
     * @param $errorMessages
     */
    protected function throwError($errorMessages)
    {
        $res = response()->json([
            "status" => 422,
            "errors" => $errorMessages,
        ], 422);
        throw new HttpResponseException($res);
    }
}
