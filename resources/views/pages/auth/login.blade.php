@extends('layouts.auth')

@section('title', 'Login')

@push('css')
@endpush

@section('main')
    <form id="login" autocomplete="off"
        class="d-flex flex-column min-vh-100 justify-content-between align-items-center w-100">
        <div class="d-grid gap-2 w-100">
            <div class="position-relative d-flex justify-content-center align-items-center mb-4">
                <div class="w-100 rounded-bottom-5 position-absolute top-0 start-0 h-100"
                    style="background-image: url('{{ asset('images/background.jpg') }}');
                            background-size: cover;
                            background-position: center;
                            filter: blur(1px);">
                </div>
                <img src="{{ asset('images/logo.png') }}" width="100" class="img-fluid  position-relative z-1 py-5"
                    alt="">
            </div>
            <h4 class="mb-2 text-center fw-bold">Selamat Datang</h4>
            <small class="text-small mb-4 d-block text-center">Silahkan login dengan akunmu</small>
            <div class="input-group px-3">
                <label for="nis" class="input-group-text bg-white">
                    <i class="fas fa-user"></i>
                </label>
                <input type="text" class="form-control" name="nis" id="nis" placeholder="Masukkan NIS">
            </div>
            <small class="text-danger d-block px-3 text-small" id="errornis"></small>
            <div class="input-group px-3">
                <label for="password" class="input-group-text bg-white">
                    <i class="fas fa-lock"></i>
                </label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password">
            </div>
            <small class="text-danger d-block px-3 text-small" id="errorpassword"></small>
        </div>
        <div class="d-grid gap-2 w-100 p-3 mb-3">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $("#login").submit(function(e) {
                setButtonLoadingState("#login .btn.btn-primary", true, "Login");
                e.preventDefault();
                const url = "{{ route('login') }}";
                const data = new FormData(this);

                const successCallback = function(response) {
                    setButtonLoadingState("#login .btn.btn-primary", false,
                        "Login");
                    handleSuccess(response, "/");
                };

                const errorCallback = function(error) {
                    setButtonLoadingState("#login .btn.btn-primary", false, "Login");
                    handleValidationErrors(error, "login", ["nis", "password"]);
                };

                ajaxCall(url, "POST", data, successCallback, errorCallback);
            });
        });
    </script>
@endpush
