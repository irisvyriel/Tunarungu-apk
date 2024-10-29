@extends('layouts.app')

@section('title', 'Profile')

@section('main')
    <nav class="navbar navbar-light bg-white border-bottom sticky-top mb-4">
        <div class="container d-flex align-items-center w-100 px-4">
            <a href="{{ route('home') }}" class="text-dark me-3">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div class="flex-grow-1 text-center">
                <h5 class="fw-bold mb-0">Profil Siswa</h5>
            </div>
        </div>
    </nav>
    <div class="min-vh-100 overflow-auto">
        <div class="px-4 py-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                            style="width: 100px; height: 100px;">
                            <i class="fas fa-user fs-2 text-secondary"></i>
                        </div>
                        <h4 class="fw-bold">{{ auth('siswas')->user()->nama }}</h4>
                        <p class="text-muted">{{ auth('siswas')->user()->kelas->nama }}</p>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                <tr class="bg-light">
                                    <th class="fw-bold text-secondary px-3 py-3" width="30%">NIS</th>
                                    <td class="px-3 py-3">{{ auth('siswas')->user()->nis }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold text-secondary px-3 py-3">Tempat Lahir</th>
                                    <td class="px-3 py-3">{{ auth('siswas')->user()->tempat_lahir }}</td>
                                </tr>
                                <tr class="bg-light">
                                    <th class="fw-bold text-secondary px-3 py-3">Tanggal Lahir</th>
                                    <td class="px-3 py-3">{{ auth('siswas')->user()->tanggal_lahir }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold text-secondary px-3 py-3">Jenis Kelamin</th>
                                    <td class="px-3 py-3">{{ auth('siswas')->user()->jenis_kelamin }}</td>
                                </tr>
                                <tr class="bg-light">
                                    <th class="fw-bold text-secondary px-3 py-3">Alamat</th>
                                    <td class="px-3 py-3">{{ auth('siswas')->user()->alamat }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="text-center mb-4">
                <a href="{{ route('logout') }}"
                    class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center">
                    <i class="bi bi-box-arrow-right me-2"></i>
                    Logout
                </a>
            </div>
        </div>
    </div>
@endsection


@push('js')
    <script>
        $(document).ready(function() {
            initializeSpeechRecognition(@json($commands));
        });
    </script>
@endpush
