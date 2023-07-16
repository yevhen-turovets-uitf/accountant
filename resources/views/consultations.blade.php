@extends('index')
@section('title', __('titles.consultations'))

@section('plugins')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" crossorigin="anonymous">
    <link rel='stylesheet' type='text/css' media='screen' href='{{ asset('/libs/bootstrap/bootstrap.min.css') }}'>
    <link rel='stylesheet' type='text/css' media='screen' href='{{ asset('/css/main.min.css') }}'>
@endsection

@section('content')
    <div class="content-wraper">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class=""><a href="{{ route('index') }}">Главная</a></li>
                <li class="">{{ __('titles.consultations') }}</li>
            </ol>
        </nav>

        @livewire('sections-tree', ['model' => \App\Models\ConsultationCategory::class, 'consultationsDetail', 'detailModel' => \App\Models\Consultation::class, 'detailModelRedaction' => \App\Models\ConsultationRedaction::class])
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('/libs/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/libs/tabs/tabby.min.js') }}"></script>
    <script src="{{ asset('/libs/lightbox/fslightbox.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
@endsection
