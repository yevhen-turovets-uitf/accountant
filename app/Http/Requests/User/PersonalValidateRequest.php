<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class PersonalValidateRequest extends FormRequest
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
            'phone' => 'string|numeric|min:4|nullable',
            'is_entity' => 'nullable|boolean',
            'inn' => 'integer|numeric|nullable',
            'company_name' => 'string|min:3|nullable',
            'company_address' => 'string|min:3|max:300|nullable',
            'company_inn' => 'integer|numeric|nullable',
            'company_phone' => 'string|numeric|min:4|nullable',
        ];
    }
}
