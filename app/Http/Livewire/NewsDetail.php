<?php

namespace App\Http\Livewire;

use App\Http\Presenters\News\GetNewsBySlugPresenter;
use App\Models\News;
use Livewire\Component;

class NewsDetail extends Component
{
    public $slug;
    public $detail;

    public function mount($slug, GetNewsBySlugPresenter $presenter): void
    {
        $news = News::query()->where('slug', $slug)->first();
        $this->detail = $presenter->present($news);
    }

    public function render()
    {
        return view('livewire.pages.news-detail');
    }
}
