@extends('index')
@section('title', __('titles.registration'))

@section('plugins')
    <link rel="stylesheet" href="{{ asset('/libs/select/custom-select.css') }}">
    <link rel="stylesheet" href="{{ asset('/libs/datapicker/datepicker.min.css') }}">
@endsection

@section('content')
    <div class="calendar-wrap">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class=""><a href="{{ route('index') }}">Главная</a></li>
                <li class="">{{ __('titles.registration') }}</li>
            </ol>
        </nav>

        @livewire('registration')
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('/libs/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/libs/select/custom-select.js') }}"></script>
    <script src="{{ asset('/libs/validate/pristine.min.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>

    <script>
        (function() {
            let form = document.getElementById("user_reg");
            let pristine = new Pristine(form);

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                let valid = pristine.validate();
            });

            let checkbox2 = document.getElementById("checkbox2")
            let jsusertype = document.querySelector('.js-usertype')
            checkbox2.addEventListener('change', function(e) {
                if (checkbox2.checked) {
                    slideDown(jsusertype)
                } else {
                    slideUp(jsusertype)
                }
            });
        })();
    </script>
@endsection
