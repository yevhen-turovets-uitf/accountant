@extends('index')
@section('title', __('titles.normative_base'))

@section('plugins')
    <link rel="stylesheet" href="{{ asset('/libs/select/custom-select.css') }}">
    <link rel="stylesheet" href="{{ asset('/libs/datapicker/datepicker.min.css') }}">
@endsection

@section('content')
    <div class="content-wrap">
        @livewire('section-detail-table', [
            'slug' => $slug,
            'model' => \App\Models\NormCategory::class,
            'normativeBaseDetail',
            'normativeBaseSection',
            __('titles.normative_base'),
            'normativeBase',
        ])
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('/libs/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/libs/select/custom-select.js') }}"></script>
    <script src="{{ asset('/libs/validate/pristine.min.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
@endsection
