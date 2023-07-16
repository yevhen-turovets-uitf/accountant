<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserValidateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:2|max:16|alpha',
            'surname' => 'required|string|min:2|max:16|alpha',
            'email' => 'required|email:rfc,dns|unique:users|regex:/^[^\s()-]*$/',
            'password' => 'required|string|min:8|max:16|regex:/^[a-zA-Z]*$/',
            'is_entity' => 'nullable|boolean',
            'company_name' => 'string|min:3|nullable',
            'company_phone' => 'string|numeric|min:4|nullable',
            'company_address' => 'string|min:3|max:300|nullable',
            'company_inn' => 'integer|numeric|nullable',
            'license' => 'boolean|required'
        ];
    }
}
