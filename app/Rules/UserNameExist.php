<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class UserNameExist implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $loginOnEmail = filter_var($value, FILTER_VALIDATE_EMAIL) ? 'email' : 'login';

        if ($loginOnEmail === 'login') {
            $user = User::firstwhere('login', $value);
        } else {
            $user = User::firstwhere('email', $value);
        }

        return $user;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Данного пользователя не существует.';
    }
}
