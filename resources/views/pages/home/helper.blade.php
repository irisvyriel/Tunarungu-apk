@extends('layouts.app')

@section('title', 'Bantuan')

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
                <h5 class="fw-bold mb-0">@yield('title')</h5>
            </div>
        </div>
    </nav>
    <div class="min-vh-100 overflow-auto">
        <div class="px-4 py-4">
            <iframe src="https://pdftron.s3.amazonaws.com/downloads/pl/demo-annotated.pdf" class="w-100 min-vh-100"
                frameborder="0"></iframe>
        </div>
    </div>
@endsection

@push('js')
    @if (isset($help))
        <script>
            $(document).ready(function() {
                const audioPlayer = $('#audio-player')[0];
                const pengaturanAudio = "{{ asset('storage/' . $help->audio) }}";
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
    @endif
@endpush
