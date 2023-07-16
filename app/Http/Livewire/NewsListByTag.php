<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use Livewire\Component;

class NewsListByTag extends Component
{
    public $tag;
    private $elements;
    public $page = 1;
    public $perPage = 9;

    public function mount($tag): void
    {
        $this->tag = Tag::where('slug', $tag)->first();
        $this->elements = $this->tag->news()->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.pages.news-list-by-tag', [
            'elements' => $this->elements
        ]);
    }
}
