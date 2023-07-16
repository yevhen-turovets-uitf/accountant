<div>
    <h1 class="title">{{ __('titles.favorites') }}</h1>
    @if (session()->has('error'))
        <div class="contact-warn" style="display: block;">
            {{ session('error') }}
        </div>
    @endif
    <div class="izbranoe__wrap">
        @if(count($favorites))
            @foreach($favorites as $favorite)
                <div class="izbranoe__item">
                    <button type="button" class="remove-izb-item" wire:click.prevent="removeFavorite({{ $favorite['id'] }})"><i class="fas fa-minus"></i></button>
                    <a href="{{ $favorite->url }}">{{ $favorite->title }}</a>
                </div>
            @endforeach
        @else
            Список избранных страниц пуст.
        @endif
    </div>
</div>
