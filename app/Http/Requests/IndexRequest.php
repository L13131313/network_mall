<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class IndexRequest extends Request
{
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstname' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'firstname.required' => '名字不能为空'
        ];
    }
}
