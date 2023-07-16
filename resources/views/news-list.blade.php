@extends('index')
@section('title', __('titles.news'))

@section('plugins')
@endsection

@section('content')
    <div class="content-wrap">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class=""><a href="{{ route('index') }}">Главная</a></li>
                <li class="">{{ __('titles.news') }}</li>
            </ol>
        </nav>

        @livewire('news-list')
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('/libs/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
@endsection
