@extends('layouts.app')

@section('title', 'Beranda')

@push('css')
@endpush

@section('main')
    <audio id="audio-player"></audio>
    <div class="min-vh-100 overflow-auto">
        <div class="px-4 py-4">
            <h5 class="fw-bold mb-3">
                @yield('title')
            </h5>
            <div class="rounded-4 gradient-bg text-white w-100 mb-4 p-4 d-flex align-items-center">
                <div class="row">
                    <div class="col-8">
                        <div class="small text-center">
                            Aplikasi Media Pembelajaran
                            Berbasis Artificial Intelligence Untuk Siswa Berkebutuhan Khusus Tunanetra
                        </div>
                    </div>
                    <div class="col-4">
                        <img src="{{ asset('images/logo.png') }}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
            <h6 class="text-center font-weight-bold mb-3">Daftar Mata Pelajaran</h6>
            <div class="row row-cols-2 g-3 pb-5">
                @foreach ($mataPelajaran as $m)
                    <div class="col">
                        <a class="card bg-light shadow-sm rounded-lg transition-transform transform-scale-on-hover text-decoration-none"
                            href="{{ route('show', $m->uuid) }}">
                            <img src="{{ asset('storage/' . $m->gambar) }}" height="120" style="object-fit: cover"
                                class="card-img-top rounded-top" alt="Mata Pelajaran">
                            <div class="card-body p-2">
                                <small class="card-title text-center">{{ $m->nama }}</small>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            const audioPlayer = $('#audio-player')[0];
            const pengaturanAudio = "{{ asset('storage/' . $pengaturan->audio) }}";
            const mataPelajaranAudioSources = @json($mataPelajaran->pluck('audio')->map(fn($audio) => asset('storage/' . $audio))->toArray());
            let currentMataPelajaranIndex = 0;
            let isPengaturanAudioPlayed = false;
            let isSpeechRecognitionPaused = false;
            let isAudioComplete = false;

            function pauseSpeechRecognition() {
                if (!isSpeechRecognitionPaused) {
                    stopSpeechRecognition();
                    isSpeechRecognitionPaused = true;
                }
            }

            function resumeSpeechRecognition() {
                if (isSpeechRecognitionPaused) {
                    initializeSpeechRecognition(@json($commands));
                    isSpeechRecognitionPaused = false;
                }
            }

            function playNextAudio() {
                if (isAudioComplete) return;

                pauseSpeechRecognition();

                if (!isPengaturanAudioPlayed) {
                    audioPlayer.src = pengaturanAudio;
                    isPengaturanAudioPlayed = true;
                } else if (currentMataPelajaranIndex < mataPelajaranAudioSources.length) {
                    audioPlayer.src = mataPelajaranAudioSources[currentMataPelajaranIndex];
                    currentMataPelajaranIndex++;
                } else {
                    isAudioComplete = true;
                    resumeSpeechRecognition();
                    $(audioPlayer).off('ended');
                    return;
                }
                audioPlayer.play();
            }

            playNextAudio();

            $(audioPlayer).on('ended', playNextAudio);
        });
    </script>
@endpush
