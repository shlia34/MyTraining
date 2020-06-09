<?php

namespace App\Http\Request\Api\Program;

use App\Http\Request\Api\ApiRequest;
use App\Models\Program;

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

    protected function prepareForValidation()
    {
        $messages = $this->checkDuplicatedMuscle( $this->getValidatorInstance());

        if($messages !== null) {
            $this->throwError($messages);
        }
    }

    /**
     * 同じ日に同じ筋肉の部位が重複してないかチェック
     * muscle_codeとdateの2つのデータに関わるためのrulesでは無理だと思った。
     * @return array
     */
    public function checkDuplicatedMuscle()
    {
        $original = $this->validationData();
        $program = Program::where('muscle_code',$original['muscle_code'])->where('date',$original['date'])->first();

        if(!empty($program)){
            return ['checkDuplicatedMuscle'=>'同じ日に同じ筋肉の部位が重複してます'];
        }
    }
}
