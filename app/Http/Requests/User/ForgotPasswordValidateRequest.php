<?php

namespace App\Http\Requests\User;

use App\Rules\UserNameExist;
use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordValidateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'userName' => ['required', 'string', new UserNameExist()],
        ];
    }
}
