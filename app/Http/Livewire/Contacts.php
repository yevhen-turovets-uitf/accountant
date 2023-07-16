<?php

namespace App\Http\Livewire;

use App\Http\Presenters\Contacts\GetContactsAsArrayPresenter;
use App\Http\Requests\Contacts\CreateFeedbackValidateRequest;
use App\Models\Feedback;
use App\Models\FeedbackInfo;
use Livewire\Component;

class Contacts extends Component
{
    public $feedbackInfo;
    public $name;
    public $email;
    public $phone;
    public $description;
    public $success = false;

    protected function rules() {
        $request = new CreateFeedbackValidateRequest();

        return $request->rules();
    }

    public function mount(
        GetContactsAsArrayPresenter $contactsPresenter,
    ): void
    {
        $feedbackInfo = FeedbackInfo::query()->get();
        $this->feedbackInfo = $contactsPresenter->presentCollection($feedbackInfo);
    }

    public function sendForm() {
        $this->validate();

        $feedback = new Feedback();
        $feedback->name = $this->name;
        $feedback->email = $this->email;
        $feedback->phone = $this->phone;
        $feedback->description = $this->description;
        $feedback->save();

        $this->success = true;
    }

    public function render()
    {
        return view('livewire.pages.contacts');
    }
}
