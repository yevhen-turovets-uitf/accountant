<?php

namespace App\Http\Requests\Contacts;

use Illuminate\Foundation\Http\FormRequest;

class CreateFeedbackValidateRequest extends FormRequest
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
            'email' => 'required|email:rfc,dns|regex:/^[^\s()-]*$/',
            'phone' => 'string|numeric|min:4|nullable',
            'description' => 'string|min:3|max:300|nullable',
        ];
    }
}
