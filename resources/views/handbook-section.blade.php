@extends('index')
@section('title', __('titles.handbook'))

@section('plugins')
    <link rel="stylesheet" href="{{ asset('/libs/select/custom-select.css') }}">
    <link rel="stylesheet" href="{{ asset('/libs/datapicker/datepicker.min.css') }}">
@endsection

@section('content')
    <div class="profile content-wrap">
        @livewire('section-detail', [
            'slug' => $slug,
            'model' => \App\Models\HandbookCategory::class,
            'handbookDetail',
            'handbookSection',
            __('titles.handbook'),
            'handbook',
        ])
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('/libs/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/libs/select/custom-select.js') }}"></script>
    <script src="{{ asset('/libs/validate/pristine.min.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
@endsection
