<div class="contact-page">
    <input type="hidden" value="{{ $slug }}" id="active">
    <h1 class="help-title">{{ __('titles.help') }}</h1>
    <div class="help-wrap">
        <div class="row">
            <div class="help__left col-xl-9 col-md-8 col-12">
                <div class="help__content active">
                    <h2>{{ $title }}</h2>
                    {!! $text !!}
                </div>
            </div>
            <div class="help__right col-xl-3 col-md-4 col-12">
                @foreach($categories as $keySection => $category)
                    <div class="help__right__group">
                        <div class="help__right__t">{{ $category['name'] }}</div>
                        @foreach($category['helpElements'] as $keyElement => $element)
                            <div class="help__right__item @if($activeId == $element['id']) active @endif" wire:click.prevent="help({{ $element['id'] }})">{{ $element['name'] }}</div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>
        var newParamValue = document.getElementById('active').value;
        history.pushState(null, null, '/help/' + encodeURIComponent(newParamValue));

        document.addEventListener('livewire:update', function () {
            var newParamValue = document.getElementById('active').value;
            history.pushState(null, null, '/help/' + encodeURIComponent(newParamValue));
        });
    </script>
</div>
