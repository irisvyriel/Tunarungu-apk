@extends('layouts.app')

@section('title', 'Beranda')

@push('css')
@endpush

@section('main')
    <div class="w-full overflow-y-auto">
        <div class="px-8 py-6">
            <h4 class="text-xl font-semibold mb-3">
                @yield('title')
            </h4>
            <div class="bg-gradient-to-r from-blue-500 to-blue-400 rounded-3xl w-full h-32 mb-4 p-4">
                <p class="text-white font-semibold text-sm">
                    Aplikasi Media Pembelajaran
                    Berbasis Artificial Intelligence Untuk Siswa Berkebutuhan Khusus Tunanetra
                </p>
            </div>
            <h5 class="text-md text-center font-semibold mb-3">Daftar Mata Pelajaran</h5>
            <div class="grid grid-cols-2 gap-4">
                @foreach ($mataPelajaran as $m)
                    <a class="card bg-base-100 shadow-md" href="{{ route('show', $m->uuid) }}">
                        <figure>
                            <img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
                                alt="Shoes" />
                        </figure>
                        <div class="card-body p-3">
                            <h6 class="tex-sm text-center">{{ $m->nama }}</h6>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
