@extends('layouts.auth')

@section('title', 'Login')

@push('css')
@endpush

@section('main')
    <div class="w-full ">
        <div class="bg-gradient-to-r from-blue-500 to-blue-400 rounded-b-3xl w-full h-32 mb-10">
        </div>
        <div class="px-8 py-6">
            <h1 class="text-2xl font-bold text-center mb-3">Selamat Datang</h1>
            <p class="mb-3 text-center">Silahkan Login dengan akunmu</p>
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
                <div class="text-sm">Lupa Password?</div>
            </div>
        </div>
        <div class="absolute bottom-0 w-full px-8 py-6">
            <a href="{{ route('home') }}" class="btn btn-primary w-full mb-3" type="submit">Login</a>
            <p class="text-center text-sm">Belum punya akun? Daftar </p>
        </div>
    </div>
@endsection

@push('js')
@endpush
