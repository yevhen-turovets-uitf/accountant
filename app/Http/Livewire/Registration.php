<?php

namespace App\Http\Livewire;

use App\Http\Requests\User\CreateUserValidateRequest;
use App\Models\User;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Registration extends Component
{
    public $name;
    public $surname;
    public $email;
    public $password;
    public $is_entity;
    public $company_name;
    public $company_phone;
    public $company_address;
    public $company_inn;
    public $license;
    public $error = '';

    protected function rules() {
        $request = new CreateUserValidateRequest();

        return $request->rules();
    }

    public function registrationUser(UserRepository $userRepository) {
        $this->validate();

        $user = new User();

        $user->name = $this->name;
        $user->surname = $this->surname;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);

        if ($this->is_entity) {
            $user->is_entity = $this->is_entity;
            $user->company_name = $this->company_name;
            $user->company_phone = $this->company_phone;
            $user->company_address = $this->company_address;
            $user->company_inn = $this->company_inn;
        }

        $userRepository->saveUser($user);

        if(Auth::attempt([
            'email' => $this->email,
            'password' => $this->password
        ])) {
            return redirect()
                ->to('/user/personal')
                ->with(['success' => __('auth.successful_registration')]);
        }
    }

    public function render()
    {
        return view('livewire.pages.auth.registration');
    }
}
