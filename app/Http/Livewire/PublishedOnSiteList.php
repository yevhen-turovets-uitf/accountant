<?php

namespace App\Http\Livewire;

use App\Models\PublishedOnSite;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;

class PublishedOnSiteList extends Component
{
    public $publishedOnSite;
    private $dates;

    public $perPage = 9;

    public function mount(): void
    {
        $this->publishedOnSite = PublishedOnSite::orderBy('date')->orderBy('title')->get();
        $this->dates = $this->publishedOnSite->reverse()->pluck('date')->unique()->toArray();

        $total = count($this->dates);
        $page = request()->get('page', 1);
        $offset = ($page - 1) * $this->perPage;
        $currentPageItems = array_slice($this->dates, $offset, $this->perPage);

        $this->dates = new LengthAwarePaginator($currentPageItems, $total, $this->perPage, $page);
        $this->dates->withPath(route('publishedOnSite'));
    }

    public function render()
    {
        return view('livewire.pages.published-on-site', [
            'dates' => $this->dates
        ]);
    }
}
