<div>
    <div class="title">{{ __('titles.news') }}</div>

    <div class="news__wrap">
        @foreach($elements as $eachNews)
            <div class="news__item">
                <div class="news__data">{{ $eachNews['createdDate'] }}</div>
                <a href="{{ route('news.show', ['slug' => $eachNews['slug']]) }}" class="news__t">{{ $eachNews['title'] }}</a>
                <p>{!! $eachNews['description'] !!}</p>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('news.show', ['slug' => $eachNews['slug']]) }}" class="btn btn-light">Подробнее</a>
                </div>
            </div>
        @endforeach
    </div>
    @include('livewire.components.pagination', ['elements' => $elements])
</div>
