<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SectionList extends Component
{
    public $level_one_categories;

    public function mount(
        $model
    ): void
    {
        $this->level_one_categories = $model::query()->where('category_id', null)->get();
    }

    public function render()
    {
        return view('livewire.pages.section-list');
    }
}
