<?php

namespace App\Http\Livewire;

use App\Http\Requests\User\ForgotPasswordValidateRequest;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ForgotPassword extends Component
{
    public $userName;

    protected function rules() {
        $request = new ForgotPasswordValidateRequest();

        return $request->rules();
    }

    public function sendForgotPasswordLink(UserRepository $userRepository) {
        $this->validate();

        $username = $this->userName;

        $loginOnEmail = filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' : 'login';

        if ($loginOnEmail === 'login') {
            $user = $userRepository->getUserByLogin($username);
        } else {
            $user = $userRepository->getUserByEmail($username);
        }

        $token = Password::createToken($user);

        $user->sendPasswordResetNotification($token);

        session()->flash('success', 'На ваш адрес электронной почты отправлено письмо с подтверждением изменения пароля');
    }

    public function render() {
        return view('livewire.pages.auth.forgot-password');
    }
}
