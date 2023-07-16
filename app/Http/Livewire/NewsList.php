<?php

namespace App\Http\Livewire;

use App\Models\News;
use Livewire\Component;

class NewsList extends Component
{
    private $elements;
    public $page = 1;
    public $perPage = 9;

    public function mount(): void
    {
        $this->elements = News::query()->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.pages.news-list', [
            'elements' => $this->elements
        ]);
    }
}
