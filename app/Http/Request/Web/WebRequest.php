<?php

namespace App\Http\Request\Web;

use Illuminate\Foundation\Http\FormRequest;

abstract class WebRequest extends FormRequest
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
}
