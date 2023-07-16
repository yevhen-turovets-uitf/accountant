<div>
    <div class="news-d-t">
        <h1>{{ $detail['title'] }}</h1>
        <div class="news__data">{{ $detail['createdDate'] }}</div>
    </div>

    <div class="news-d-wrap">
        {!! $detail['text'] !!}
    </div>

    @if($detail['tags'])
        <div class="news-d-tags">
            Теги:
            <div class="news-d-tags__wrap">
                @foreach($detail['tags'] as $tag)
                    <a href="{{ route('news.tag', ['tag' => $tag['slug']]) }}">{{ $tag['name'] }}</a>
                @endforeach
            </div>
        </div>
    @endif
</div>
