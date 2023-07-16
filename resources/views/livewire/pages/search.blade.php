<div>
    @error('search')
        <div class="contact-warn" style="display: block;">
            {{ $message }}
        </div>
    @enderror
    <h1 class="title border-bottom-0">{{ __('titles.search') }}</h1>

    <div class="news__wrap">
        <div class="">
            <div class="text-secondary px-3">
                Результаты поиска по запросу: "<span>{{ $search }}</span>"
            </div>
        </div>
        <form class="news__item border-top-0 border-bottom d-flex" wire:submit.prevent="sendForm">
            <input type="search" class="w-75" placeholder="Поиск" required="" minlength="3" value="{{ $search }}" wire:model="search" id="search-input">
            <button class="btn btn-primary mx-2" type="submit">Искать</button>
        </form>
        @foreach($results as $result)
            <div class="news__item">
                <div class="news__data">{{ $result['createdAt'] }}</div>
                <a href="{{ route($result['routeName'], ['slug' => $result['slug']]) }}" class="news__t">{{ $result['title'] }}</a>
            </div>
        @endforeach
    </div>
    <script>
        document.addEventListener('livewire:update', function () {
            var newParamValue = document.getElementById('search-input').value;
            history.pushState(null, null, '?search=' + encodeURIComponent(newParamValue));
        });
    </script>
</div>

