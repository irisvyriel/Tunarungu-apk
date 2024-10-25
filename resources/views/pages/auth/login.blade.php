@extends('layouts.auth')

@section('title', 'Login')

@push('css')
<style>
    .background {
        background-image: url('{{ asset('resources/assets/images/BgLogin.jpg') }}'); 
        background-size: cover;
        background-position: center;
        height: 100vh; /* Mengatur tinggi untuk menutupi layar penuh */
        position: relative; /* Untuk menempatkan elemen di atasnya */
    }
    .logo {
        position: absolute;
        top: 50%; /* Pusat secara vertikal */
        left: 50%; /* Pusat secara horizontal */
        transform: translate(-50%, -50%); /* Menggeser kembali untuk pemusatan */
        text-align: center;
    }
    .logo img {
        max-width: 150px; /* Atur ukuran logo sesuai kebutuhan */
    }
</style>
@endpush

@section('main')
<div class="background w-full">
    <div class="logo">
        <img src="{{ asset('resources/assets/images/Studykulogo.png') }}" alt="Logo"> <!-- Ganti dengan path logo -->
        <h1 class="text-2xl font-bold text-white mt-3">Selamat Datang</h1>
    </div>
    <div class="px-8 py-6 mt-32"> 
        <p class="mb-3 text-center text-white">Silahkan Login dengan akunmu</p>
        <div class="form-control mb-3 bg-slate-200 px-4 py-2 rounded-3xl flex flex-row items-center gap-x-3">
            <x-heroicon-s-user class="w-6 h-6 text-gray-500" />
            <input type="text" placeholder="NIS"
                class="input input-bordered text-gray-800 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-xl" />
        </div>
        <div class="form-control mb-3 bg-slate-200 px-4 py-2 rounded-3xl flex flex-row items-center gap-x-3">
            <x-heroicon-s-lock-closed class="w-6 h-6 text-gray-500" />
            <input type="password" placeholder="Password"
                class="input input-bordered text-gray-800 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-xl" />
        </div>
        <div class="flex justify-between mb-3 items-center">
            <div class="form-control">
                <label class="label cursor-pointer gap-2">
                    <input type="checkbox" class="checkbox" />
                    <span class="label-text text-sm">Ingat Saya</span>
                </label>
            </div>
            <div class="text-sm text-white">Lupa Password?</div>
        </div>
    </div>
    <div class="absolute bottom-0 w-full px-8 py-6">
        <a href="{{ route('home') }}" class="btn btn-primary w-full mb-3" type="submit">Login</a>
        <p class="text-center text-sm text-white">Belum punya akun? Daftar </p>
    </div>
</div>
@endsection

@push('js')
@endpush
