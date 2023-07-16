@extends('index')
@section('title', __('titles.tax_system'))

@section('plugins')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" crossorigin="anonymous">
    <link rel='stylesheet' type='text/css' media='screen' href='{{ asset('/libs/bootstrap/bootstrap.min.css') }}'>
    <link rel='stylesheet' type='text/css' media='screen' href='{{ asset('/css/main.min.css') }}'>
@endsection

@section('content')
    <div class="profile content-wrap">
        @livewire('detail-page-with-tabs', ['slug' => $slug, 'model' => \App\Models\TaxSystem::class, 'modelRedaction' => \App\Models\TaxSystemRedaction::class])
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('/libs/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/libs/tabs/tabby.min.js') }}"></script>
    <script src="{{ asset('/libs/lightbox/fslightbox.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
@endsection
