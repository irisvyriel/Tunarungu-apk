@extends('layouts.app')

@section('title', 'Materi')

@push('css')
@endpush

@section('main')
    <audio id="audio-player"></audio>
    <nav class="navbar navbar-light bg-light sticky-top mb-3">
        <div class="container d-flex align-items-center w-100 px-4">
            <a href="{{ route('show', $bab->mataPelajaran->uuid) }}" class="text-dark me-3">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div class="flex-grow-1 text-center">
                <h5 class="fw-bold mb-0">@yield('title')</h5>
            </div>
        </div>
    </nav>

    <div class="min-vh-100 overflow-auto">
        <div class="px-4 py-4">
            <h5 class="fw-bold mb-2 text-center">{{ $bab->kode }}</h5>
            <h5 class="fw-semibold mb-4 text-center">{{ $bab->nama }}</h5>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item w-50" role="presentation">
                    <button class="nav-link active w-100 d-block" id="pills-materi-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-materi" type="button" role="tab" aria-controls="pills-materi"
                        aria-selected="true">Materi</button>
                </li>
                <li class="nav-item w-50" role="presentation">
                    <button class="nav-link w-100 d-block" id="pills-soal-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-soal" type="button" role="tab" aria-controls="pills-soal"
                        aria-selected="false">Soal</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-materi" role="tabpanel" aria-labelledby="pills-materi-tab">
                    @foreach ($materi as $m)
                        <div class="card bg-light shadow-sm rounded-lg mb-3">
                            <div class="card-body p-3">
                                <small class="card-title d-block">{{ $m->judul }}</small>
                                <audio id="audio-materi-{{ $loop->iteration }}" src="{{ asset('storage/' . $m->audio) }}"
                                    preload="none"></audio>
                                <div class="text-center">
                                    <button class="btn btn-primary rounded-4 mt-2 play-audio"
                                        data-audio-id="audio-materi-{{ $loop->iteration }}">
                                        <i class="fas fa-play"></i>
                                        <i class="fas fa-pause d-none"></i>
                                    </button>
                                    <div class="progress mt-2" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="badge bg-warning mx-auto mt-3">
                                    Perintah: Jalankan materi ke {{ $loop->iteration }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="tab-pane fade" id="pills-soal" role="tabpanel" aria-labelledby="pills-soal-tab">
                    @foreach ($ujiKompetensi as $u)
                        <div class="card bg-light shadow-sm rounded-lg mb-3">
                            <div class="card-body p-3">
                                <small class="card-title d-block">{!! $u->soal !!}</small>
                                <audio id="audio-soal-{{ $loop->iteration }}" src="{{ asset('storage/' . $u->audio) }}"
                                    preload="none"></audio>
                                <div class="text-center">
                                    <button class="btn btn-primary rounded-4 mt-2 play-audio"
                                        data-audio-id="audio-soal-{{ $loop->iteration }}">
                                        <i class="fas fa-play"></i>
                                        <i class="fas fa-pause d-none"></i>
                                    </button>
                                    <div class="progress mt-2" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="badge bg-warning mx-auto mt-3">
                                    Perintah: Jalankan soal ke {{ $loop->iteration }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            const audioPlayer = $('#audio-player')[0];
            const pengaturanAudio = "{{ asset('storage/' . $pengaturan->audio) }}";
            const babAudio = "{{ asset('storage/' . $bab->audio) }}";
            const aturanAudio = "{{ asset('storage/' . $aturan->audio) }}";
            let isPengaturanAudioPlayed = false;
            let isbabAudioPlayed = false;
            let isAturanAudio = false;
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
                } else if (!isbabAudioPlayed) {
                    audioPlayer.src = babAudio;
                    isbabAudioPlayed = true;
                } else if (!isAturanAudio) {
                    audioPlayer.src = aturanAudio
                    isAturanAudio = true;
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

        function playAudioFromSpeech(speech, type) {
            const match = speech.match(new RegExp(`jalankan ${type} ke[- ]?(\\d+)`));
            const index = match ? match[1] : null;
            if (!index) return;

            const audioElement = $(`#audio-${type}-${index}`)[0];

            if (audioElement) {
                stopSpeechRecognition();

                $('audio').each(function() {
                    if (this !== audioElement) {
                        this.pause();
                        this.currentTime = 0;
                    }
                });

                setAudioElement(audioElement, type, index);
                updateStatus(`Memutar ${type} ke ${index}`, "bg-success");

                audioElement.play();
                $(audioElement).off('ended').on('ended', function() {
                    isAudioComplete = true;
                    initializeSpeechRecognition(@json($commands));
                });

            } else {
                updateStatus(
                    `${type.charAt(0).toUpperCase() + type.slice(1)} tidak ditemukan`,
                    "bg-danger"
                );
            }
        }
    </script>
@endpush
