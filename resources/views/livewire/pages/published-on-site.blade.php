<div>
    <div class="title">{{ __('titles.published_on_site') }}</div>

    <div class="news__wrap">
        @foreach ($dates as $date)
            <div class="news__item">
                <div class="news__data">{{ \Carbon\Carbon::parse($date)->isoFormat('DD MMM YYYY', 'ru') }}</div>
                @foreach ($publishedOnSite->where('date', $date) as $item)
                    <a href="{{ $item->url }}" target="_blank" class="news__t">{{ $item->title }}</a>
                @endforeach
            </div>
        @endforeach
    </div>
    @include('livewire.components.pagination', ['elements' => $dates])
</div>
