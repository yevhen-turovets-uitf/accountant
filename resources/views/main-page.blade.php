@extends('index')
@section('title', __('titles.main_page'))

@section('plugins')
    <link rel="stylesheet" href="{{ asset('/libs/select/custom-select.css') }}">
    <link rel="stylesheet" href="{{ asset('/libs/datapicker/datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/libs/glide/glide.core.min.css') }}">
@endsection

@section('content')
    @livewire('main-page')
@endsection

@section('scripts')
    <script src="{{ asset('/libs/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/libs/select/custom-select.js') }}"></script>
    <script src="{{ asset('/libs/validate/pristine.min.js') }}"></script>
    <script src="{{ asset('/libs/glide/glide.min.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
@endsection
