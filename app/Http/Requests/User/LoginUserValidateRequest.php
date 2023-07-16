<?php

namespace App\Http\Requests\User;

use App\Rules\UserNameExist;
use Illuminate\Foundation\Http\FormRequest;

class LoginUserValidateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => ['required', 'string', new UserNameExist()],
            'password' => ['required', 'string', 'min:8', 'max:16'],
            'remember' => ['nullable', 'boolean'],
        ];
    }
}
