<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class EditPasswordValidateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => 'required|string|min:8|max:16',
            'password' => 'required|string|confirmed|min:8|max:16|regex:/^[a-zA-Z]*$/',
        ];
    }
}
