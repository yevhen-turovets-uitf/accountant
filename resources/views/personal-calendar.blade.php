@extends('index')
@section('title', __('titles.personal_calendar'))

@section('plugins')
    <link rel="stylesheet" href="{{ asset('/libs/select/custom-select.css') }}">
    <link rel="stylesheet" href="{{ asset('/libs/datapicker/datepicker.min.css') }}">
@endsection

@section('content')
    <div class="profile personal-calendar content-wrap">
        @livewire('personal-calendar')
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('/libs/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/libs/select/custom-select.js') }}"></script>
    <script src="{{ asset('/libs/validate/pristine.min.js') }}"></script>
    <script src="{{ asset('/libs/datapicker/datepicker-full.min.js') }}"></script>
    <script src="{{ asset('/libs/datapicker/locales/ru.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
@endsection
