<?php

namespace App\Http\Livewire;

use App\Http\Requests\User\ResetPasswordValidateRequest;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ResetPassword extends Component
{
    public $email;
    public $token;
    public $password;
    public $password_confirmation;

    protected function rules() {
        $request = new ResetPasswordValidateRequest();

        return $request->rules();
    }

    protected function mount($email, $token) {
        $this->email = $email;
        $this->token = $token;
    }

    public function resetPassword() {
        $this->validate();

        $userRepository = new UserRepository();

        $credentials = [
            'email' => $this->email,
            'token' => $this->token,
            'password' => Hash::make($this->password),
        ];

        $resetPasswordStatus = Password::reset(
            $credentials,
            function ($user, $password) use ($userRepository) {
                $user->password = $password;
                $userRepository->saveUser($user);
            }
        );

        if ($resetPasswordStatus !== Password::PASSWORD_RESET) {
            session()->flash('error', 'Ошибка сброса пароля. Пользователь с таким логином, либо email не существует');
        } else {
            $this->email = '';
            $this->token = '';
            $this->password = '';
            $this->password_confirmation = '';
            session()->flash('success', 'Ваш пароль изменен');
        }
    }

    public function render() {
        return view('livewire.pages.auth.reset-password');
    }
}
