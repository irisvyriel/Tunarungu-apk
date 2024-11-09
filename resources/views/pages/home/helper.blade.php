@extends('layouts.app')

@section('title', 'Bantuan')

@push('css')
@endpush

@section('main')
    <nav class="navbar navbar-light bg-light sticky-top mb-3">
        <div class="container d-flex align-items-center w-100 px-4">
            <a href="{{ route('home') }}" class="text-dark me-3">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div class="flex-grow-1 text-center">
                <h5 class="fw-bold mb-0">@yield('title')</h5>
            </div>
        </div>
    </nav>

    <div class="min-vh-100 overflow-auto">
        <div class="px-4 py-4">
            <iframe src="https://pdftron.s3.amazonaws.com/downloads/pl/demo-annotated.pdf" class="w-100 min-vh-100"
                frameborder="0"></iframe>
        </div>
    </div>
@endsection

@push('js')
    <script></script>
@endpush
