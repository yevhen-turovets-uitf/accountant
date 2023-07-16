<?php

namespace App\Http\Livewire;

use App\Http\Presenters\Help\GetHelpCategoriesAsArrayPresenter;
use App\Models\HelpCategory;
use App\Models\HelpElement;
use Livewire\Component;

class Help extends Component
{
    public $categories;
    public $title;
    public $slug;
    public $text;
    public $activeId;

    public function mount(
        $slug,
        GetHelpCategoriesAsArrayPresenter $presenter
    ): void
    {
        $categories = HelpCategory::query()->get();

        if($slug) {
            $firstElement = HelpElement::query()->where('slug', $slug)->first();
        } else {
            $firstElement = HelpCategory::query()->first()->helpElements()->first();
        }

        $this->categories = $presenter->presentCollection($categories);
        $this->activeId = $firstElement->getId();
        $this->title = $firstElement->getName();
        $this->slug = $firstElement->getSlug();
        $this->text = $firstElement->getDescription();
    }

    public function help(int $id) {
        $element = HelpElement::query()->findOrFail($id);

        $this->activeId = $element->getId();
        $this->title = $element->getName();
        $this->slug = $element->getSlug();
        $this->text = $element->getDescription();
    }

    public function render()
    {
        return view('livewire.pages.help');
    }
}
