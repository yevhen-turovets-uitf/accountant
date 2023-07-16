<?php

namespace App\Http\Livewire;

use App\Http\Requests\User\LoginUserValidateRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $username;
    public $password;
    public $remember;
    public $loggedIn = false;
    public $error = '';

    protected function rules() {
        $request = new LoginUserValidateRequest();

        return $request->rules();
    }

    public function authUser() {
        $this->validate();

        $loginOnEmail = filter_var($this->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'login';

        Auth::guard()->attempt([$loginOnEmail => $this->username, 'password' => $this->password], $this->remember);

        $this->loggedIn = true;

        if (!Auth::user()) {
            $this->error = __('auth.incorrect_login');
            $this->loggedIn = false;
        } else {
            return redirect()
                ->route('index');
        }
    }

    public function render()
    {
        return view('livewire.pages.auth.login');
    }
}
