@extends('layouts.app')

@section('title', $bab->nama)

@push('css')
@endpush

@section('main')
    <div class="w-full">
        <div class="px-8 py-6">
            <div class="flex items-center mb-4 gap-2">
                <a href="{{ route('show', $bab->mataPelajaran->uuid) }}"> <x-heroicon-s-arrow-left
                        class="w-4 h-4 text-gray-500" /></a>
                <div class="w-full text-center">
                    <h4 class="text-md font-semibold">
                        @yield('title')
                    </h4>
                </div>
            </div>
            <div role="tablist" class="tabs tabs-lifted">
                <input type="radio" name="my_tabs_2" role="tab" class="tab w-full" aria-label="Materi" />
                <div role="tabpanel" class="tab-content rounded-box p-6">
                    @foreach ($materi as $m)
                        <a class="card bg-base-100 shadow-md w-full">
                            <figure>
                                <img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
                                    alt="Shoes" />
                            </figure>
                            <div class="card-body p-3">
                                <h6 class="tex-sm text-center">Materi {{ $loop->iteration }}</h6>
                                <div class="flex gap-2 justify-center">
                                    <button class="btn btn-circle btn-primary">
                                        <x-heroicon-s-speaker-wave class="w-6 h-6 text-white" />
                                    </button>
                                    <button class="btn btn-circle btn-primary">
                                        <x-heroicon-s-arrow-path class="w-6 h-6 text-white" />
                                    </button>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <input type="radio" name="my_tabs_2" role="tab" class="tab w-full" aria-label="Soal" />
                <div role="tabpanel" class="tab-content rounded-box p-6">
                    @foreach ($ujiKompetensi as $u)
                        <a class="card bg-base-100 shadow-md">
                            <figure>
                                <img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
                                    alt="Shoes" />
                            </figure>
                            <div class="card-body p-3">
                                <h6 class="tex-sm text-center">Soal {{ $loop->iteration }}</h6>
                                <div class="flex gap-2 justify-center">
                                    <button class="btn btn-circle btn-primary">
                                        <x-heroicon-s-speaker-wave class="w-6 h-6 text-white" />
                                    </button>
                                    <button class="btn btn-circle btn-primary">
                                        <x-heroicon-s-arrow-path class="w-6 h-6 text-white" />
                                    </button>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
