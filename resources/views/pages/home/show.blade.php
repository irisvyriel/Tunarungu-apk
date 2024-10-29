@extends('layouts.app')

@section('title', 'Mata Pelajaran')

@push('css')
@endpush

@section('main')
    <audio id="audio-player"></audio>
    <nav class="navbar navbar-light bg-light sticky-top mb-3">
        <div class="container d-flex align-items-center w-100 px-4">
            <a href="{{ route('home') }}" class="text-dark me-3">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div class="flex-grow-1 text-center">
                <h5 class="fw-bold mb-0">
                    @yield('title')
                </h5>
            </div>
        </div>
    </nav>
    <div class="min-vh-100 overflow-auto">
        <div class="px-4 py-4">
            <div class="card bg-light shadow-sm mb-4">
                <img src="{{ asset('storage/' . $mataPelajaran->gambar) }}" height="180" style="object-fit: cover"
                    class="card-img-top rounded-top" alt="Shoes">
                <div class="card-body p-3">
                    <h6 class="card-title text-center">{{ $mataPelajaran->nama }}</h6>
                </div>
            </div>
            <h5 class="h6 text-center font-weight-bold mb-3">Daftar Bab</h5>
            <div class="row row-cols-2 g-3 pb-5">
                @foreach ($bab as $b)
                    <div class="col">
                        <a class="card bg-light shadow-sm rounded-lg transition-transform transform-scale-on-hover text-decoration-none h-100"
                            href="{{ route('bab', $b->uuid) }}">
                            <img src="{{ asset('storage/' . $b->gambar) }}" height="120" style="object-fit: cover"
                                class="card-img-top rounded-top" alt="Bab">
                            <div class="card-body p-3">
                                <small class="d-block">{{ $b->kode }}</small>
                                <small class="card-title text-center">{{ $b->nama }}</small>
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
            const mataPelajaranAudio = "{{ asset('storage/' . $mataPelajaran->audio) }}";
            const babAudioSources = @json($bab->pluck('audio')->map(fn($audio) => asset('storage/' . $audio))->toArray());
            let currentBabIndex = 0;
            let isPengaturanAudioPlayed = false;
            let isMataPelajaranAudioPlayed = false;
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
                    audioPlayer.src = pengaturanAudio
                    isPengaturanAudioPlayed = true;
                } else if (!isMataPelajaranAudioPlayed) {
                    audioPlayer.src = mataPelajaranAudio;
                    isMataPelajaranAudioPlayed = true;
                } else if (currentBabIndex < babAudioSources.length) {
                    audioPlayer.src = babAudioSources[currentBabIndex];
                    currentBabIndex++;
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
