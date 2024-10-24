@extends('layouts.app')

@section('title', 'Mata Pelajaran')

@push('css')
@endpush

@section('main')
    <div class="w-full">
        <div class="px-8 py-6">
            <div class="flex items-center mb-3 gap-2">
                <a href="{{ route('home') }}"> <x-heroicon-s-arrow-left class="w-4 h-4  text-gray-500" /></a>
                <div class="w-full text-center">
                    <h4 class="text-md font-semibold">
                        @yield('title')
                    </h4>
                </div>
            </div>
            <div class="card bg-base-100 shadow-md mb-4">
                <figure>
                    <img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp" alt="Shoes" />
                </figure>
                <div class="card-body p-3">
                    <h6 class="tex-sm text-center">{{ $mataPelajaran->nama }}</h6>
                </div>
            </div>
            <h5 class="text-md text-center font-semibold mb-3">Daftar Bab</h5>
            <div class="grid grid-cols-2 gap-4">
                @foreach ($bab as $b)
                    <a class="card bg-base-100 shadow-md" href="{{ route('materi', $b->uuid) }}">
                        <figure>
                            <img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
                                alt="Shoes" />
                        </figure>
                        <div class="card-body p-3">
                            <h6 class="tex-sm text-center">{{ $b->nama }}</h6>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
