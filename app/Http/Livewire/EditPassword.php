<?php

namespace App\Http\Livewire;

use App\Exceptions\UpdatePersonalData\InvalidOldPasswordErrorException;
use App\Http\Requests\User\EditPasswordValidateRequest;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class EditPassword extends Component
{
    public $old_password;
    public $password;
    public $password_confirmation;

    protected function rules() {
        $request = new EditPasswordValidateRequest();

        return $request->rules();
    }

    public function editPassword(UserRepository $userRepository) {
        $this->validate();

        $updateUser = Auth::user();

        if (!Hash::check($this->old_password, $updateUser->password)) {
            session()->flash('error', __('auth.wrong_old_password'));
        } else {
            $updateUser->password = Hash::make($this->password);

            $userRepository->updateUser($updateUser);

            $this->old_password = '';
            $this->password = '';
            $this->password_confirmation = '';

            session()->flash('success', __('auth.password_changed_successfully'));
        }
    }

    public function render() {
        return view('livewire.pages.edit-password');
    }
}
