@extends('index')
@section('title', __('titles.forgot_password'))

@section('plugins')
    <link rel="stylesheet" href="{{ asset('/libs/select/custom-select.css') }}">
    <link rel="stylesheet" href="{{ asset('/libs/datapicker/datepicker.min.css') }}">
@endsection

@section('content')
    <div class="content-wraper">
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class=""><a href="{{ route('index') }}">Главная</a></li>
                <li class="">{{ __('titles.forgot_password') }}</li>
            </ul>
        </nav>

        @livewire('forgot-password')
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('/libs/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/libs/select/custom-select.js') }}"></script>
    <script src="{{ asset('/libs/validate/pristine.min.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>

    <script>
        (function() {
            let form = document.getElementById("log-form");

            let pristine = new Pristine(form);

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                let valid = pristine.validate();
            });
        })();
    </script>
@endsection
