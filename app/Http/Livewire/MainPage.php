<?php

namespace App\Http\Livewire;

use App\Http\Presenters\MainSlide\GetMainSlideAsArrayPresenter;
use App\Http\Presenters\News\GetNewsAsArrayPresenter;
use App\Http\Presenters\Published\GetPublishedAsArrayPresenter;
use App\Http\Presenters\UsefulLink\GetUsefulLinkAsArrayPresenter;
use App\Models\CurrencyRate;
use App\Models\MainSlide;
use App\Models\News;
use App\Models\PublishedOnSite;
use App\Models\UsefulLink;
use Carbon\Carbon;
use Livewire\Component;

class MainPage extends Component
{
    public $slides;
    public $news;
    public $published;
    public $currencyRates;
    public $usefulLinks;
    public $calendarDates;

    public function mount(
        GetMainSlideAsArrayPresenter $mainSlidePresenter,
        GetNewsAsArrayPresenter $newsPresenter,
        GetPublishedAsArrayPresenter $publishedPresenter,
        GetUsefulLinkAsArrayPresenter $usefulLinkPresenter,
    ): void
    {
        $this->slides = MainSlide::query()->orderBy('position', 'asc')->get();

        $slides = MainSlide::query()->orderBy('position', 'asc')->get();
        $this->slides = $mainSlidePresenter->presentCollection($slides);

        $news = News::query()->take(News::ON_MAIN_PAGE)->get();
        $this->news = $newsPresenter->presentCollection($news);

        $published = PublishedOnSite::query()->orderBy('date', 'desc')->take(PublishedOnSite::ON_MAIN_PAGE)->get();
        $this->published = $publishedPresenter->presentCollection($published);

        $usefulLinks = UsefulLink::query()->orderBy('created_at', 'desc')->get();
        $this->usefulLinks = $usefulLinkPresenter->presentCollection($usefulLinks);

        $calendarDates = [];
        for ($i = 0; $i < 9; $i++) {
            $date = Carbon::now()->subDays($i);
            $calendarDates[] = [
                'date' => $date->toDateString(),
                'weekday' => __('calendar.days.' . $date->dayOfWeek),
                'day' => $date->day,
                'month' => $date->month,
                'year' => $date->year
            ];
        }
        $this->calendarDates = $calendarDates;
    }

    public function render()
    {
        return view('livewire.pages.main-page');
    }
}
