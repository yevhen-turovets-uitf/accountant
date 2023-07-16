<?php

namespace App\Http\Livewire;

use App\Http\Requests\User\PersonalValidateRequest;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Personal extends Component
{
    public $userInfo;
    public $name;
    public $surname;
    public $phone;
    public $inn;
    public $is_entity;
    public $company_name;
    public $company_phone;
    public $company_address;
    public $company_inn;

    protected function rules() {
        $request = new PersonalValidateRequest();

        return $request->rules();
    }

    public function mount(UserRepository $userRepository): void
    {
        $this->userInfo = $userRepository->getUserById(Auth::user()->id);
        $this->name = $this->userInfo->name;
        $this->surname = $this->userInfo->surname;
        $this->is_entity = $this->userInfo->is_entity;
        $this->company_name = $this->userInfo->company_name;
        $this->phone = $this->userInfo->phone;
        $this->company_address = $this->userInfo->company_address;
        $this->company_inn = $this->userInfo->company_inn;
    }

    public function editUser(UserRepository $userRepository) {
        $this->validate();

        $updateUser = Auth::user();

        $updateUser->name = $this->name;
        $updateUser->surname = $this->surname;
        $updateUser->phone = $this->phone;
        $updateUser->is_entity = $this->is_entity;
        $updateUser->inn = $this->inn;
        $updateUser->company_name = $this->company_name;
        $updateUser->company_phone = $this->company_phone;
        $updateUser->company_inn = $this->company_inn;
        $updateUser->company_address = $this->company_address;

        if($userRepository->updateUser($updateUser)) {
            session()->flash('success', __('auth.profile_edit_successful'));
        } else {
            session()->flash('error', __('auth.profile_edit_error'));
        }
    }

    public function setIsEntity($value) {
        $this->is_entity = $value;
    }

    public function render()
    {
        return view('livewire.pages.personal');
    }
}
