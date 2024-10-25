@extends('layouts.app')

@section('title', $bab->nama)

@push('css')
    <style>
        .selection-button {
            display: block;
            width: 100%;
            padding: 12px;
            text-align: center;
            background-color: #f8fafc; 
            border: 1px solid #e2e8f0; 
            border-radius: 8px;
            font-weight: 600;
            transition: background-color 0.3s ease, color 0.3s ease;
            cursor: pointer;
        }

        .selection-button:hover {
            background-color: #007bff;
            color: white;
        }

        .active {
            background-color: #007bff;
            color: white;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 20px;
        }
    </style>
@endpush

@section('main')
    <div class="w-full">
        <div class="px-8 py-6">
            <div class="flex items-center mb-4 gap-2">
                <a href="{{ route('show', $bab->mataPelajaran->uuid) }}">
                    <x-heroicon-s-arrow-left class="w-4 h-4 text-gray-500" />
                </a>
                <div class="w-full text-center">
                    <h4 class="text-md font-semibold">
                        @yield('title')
                    </h4>
                </div>
            </div>

            <div class="content-grid">
                <button id="materi-btn" class="selection-button active">Materi</button>
                <button id="soal-btn" class="selection-button">Soal</button>
            </div>

            <div id="materi-content">
                <div class="grid grid-cols-2 gap-4">
                    @foreach ($materi as $m)
                        <a class="custom-card bg-base-100 shadow-md">
                            <figure>
                                <img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
                                    alt="Shoes" />
                            </figure>
                            <div class="card-body p-3">
                                <h6 class="text-sm text-center">Materi {{ $loop->iteration }}</h6>
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

            <div id="soal-content" class="hidden">
                <div class="grid grid-cols-2 gap-4">
                    @foreach ($ujiKompetensi as $u)
                        <a class="custom-card bg-base-100 shadow-md">
                            <figure>
                                <img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
                                alt="Shoes" />
                            </figure>
                            <div class="card-body p-3">
                                <h6 class="text-sm text-center">Soal {{ $loop->iteration }}</h6>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const materiBtn = document.getElementById('materi-btn');
            const soalBtn = document.getElementById('soal-btn');
            const materiContent = document.getElementById('materi-content');
            const soalContent = document.getElementById('soal-content');

            // When Materi button is clicked
            materiBtn.addEventListener('click', function () {
                materiBtn.classList.add('active');
                soalBtn.classList.remove('active');
                materiContent.classList.remove('hidden');
                soalContent.classList.add('hidden');
            });

            // When Soal button is clicked
            soalBtn.addEventListener('click', function () {
                soalBtn.classList.add('active');
                materiBtn.classList.remove('active');
                soalContent.classList.remove('hidden');
                materiContent.classList.add('hidden');
            });
        });
    </script>
@endsection

@push('js')
@endpush
