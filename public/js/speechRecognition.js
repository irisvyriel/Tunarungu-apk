let recognition = null;
let isListening = false;
let currentAudio = null;

function updateStatus(status, bgClass = "bg-secondary") {
    $("#speechStatus span")
        .removeClass("bg-secondary bg-success bg-danger")
        .addClass(bgClass)
        .text(`Mikrofon: ${status}`);
}

function handleSpeechResult(speech, commands) {
    console.log("Speech detected:", speech);
    $("#speechStatus").fadeOut(100).fadeIn(100);

    const command = commands.find((cmd) => speech.includes(cmd.kata));

    if (command) {
        updateStatus("Menjalankan perintah...", "bg-success");
        window.location.href = command.rute;
    } else {
        switch (true) {
            case /pindah (tab )?materi/.test(speech):
                switchTab("#pills-materi", "#pills-soal");
                break;

            case /pindah (tab )?soal/.test(speech):
                switchTab("#pills-soal", "#pills-materi");
                break;

            case /jalankan materi ke-\d+/.test(speech):
                playAudioFromSpeech(speech, "materi");
                break;

            case /jalankan soal ke-\d+/.test(speech):
                playAudioFromSpeech(speech, "soal");
                break;

            case speech.includes("mantap bosku"):
                Swal.fire({
                    title: "Mantap boskuh!",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000,
                });
                break;

            default:
                updateStatus("Perintah tidak dikenali", "bg-danger");
        }
    }
}

function switchTab(showSelector, hideSelector) {
    $(showSelector).addClass("show active");
    $(hideSelector).removeClass("show active");
    $(`${showSelector}-tab`).addClass("active");
    $(`${hideSelector}-tab`).removeClass("active");
}

async function startSpeechRecognition(commands) {
    if (isListening) return;

    try {
        await navigator.mediaDevices.getUserMedia({ audio: true });
        initializeSpeechRecognition(commands);
    } catch (error) {
        console.error("Kesalahan akses mikrofon:", error);
        updateStatus("Akses Ditolak", "bg-danger");
        Swal.fire({
            icon: "error",
            title: "Akses Mikrofon Ditolak",
            text: "Silakan aktifkan akses mikrofon untuk menggunakan fitur ini.",
        });
    }
}

function initializeSpeechRecognition(commands) {
    recognition = new (window.SpeechRecognition ||
        window.webkitSpeechRecognition)();
    recognition.lang = "id-ID";
    recognition.continuous = true;
    recognition.interimResults = false;

    recognition.onstart = () => {
        isListening = true;
        updateStatus("Mikrofon aktif", "bg-success");
    };

    recognition.onresult = (event) => {
        const lastResult = event.results[event.results.length - 1];
        const speech = lastResult[0].transcript.toLowerCase();
        if (lastResult.isFinal) {
            handleSpeechResult(speech, commands);
        }
    };

    recognition.onerror = (event) => {
        console.error("Kesalahan pada pengenalan suara:", event.error);
        updateStatus("Kesalahan pengenalan suara", "bg-danger");
    };

    recognition.onend = () => {
        if (isListening) recognition.start();
        else updateStatus("Mikrofon dimatikan", "bg-danger");
    };

    recognition.start();
}

function stopSpeechRecognition() {
    if (recognition) {
        isListening = false;
        recognition.stop();
        updateStatus("Mikrofon dimatikan", "bg-danger");
    }
}

function restartSpeechRecognition(commands) {
    stopSpeechRecognition();
    setTimeout(() => {
        startSpeechRecognition(commands);
    }, 1000);
}

$(".play-audio").on("click", function () {
    const audioId = $(this).data("audio-id");
    const audio = $("#" + audioId)[0];
    const playIcon = $(this).find(".fa-play");
    const pauseIcon = $(this).find(".fa-pause");
    const progressBar = $(this).siblings(".progress").find(".progress-bar");

    toggleAudio(audio, playIcon, pauseIcon, progressBar);

    if (currentAudio && currentAudio !== audio) {
        resetPreviousAudio(currentAudio);
    }

    $(audio).on("ended", () => {
        resetPlayPause(playIcon, pauseIcon, progressBar);
        currentAudio = null;
    });

    $(audio).on("timeupdate", function () {
        const percentage = (audio.currentTime / audio.duration) * 100;
        progressBar.css("width", `${percentage}%`);
    });

    currentAudio = audio;
});

function setAudioElement(audioElement, type, index) {
    if (currentAudio && currentAudio !== audioElement) {
        resetPreviousAudio(currentAudio);
    }
    currentAudio = audioElement;

    const playIcon = $(`[data-audio-id="audio-${type}-${index}"] .fa-play`);
    const pauseIcon = $(`[data-audio-id="audio-${type}-${index}"] .fa-pause`);
    const progressBar = $(`[data-audio-id="audio-${type}-${index}"]`)
        .siblings(".progress")
        .find(".progress-bar");

    toggleAudio(audioElement, playIcon, pauseIcon, progressBar);

    $(audioElement)
        .off("ended")
        .on("ended", () => {
            resetPlayPause(playIcon, pauseIcon, progressBar);
            currentAudio = null;
        });

    $(audioElement)
        .off("timeupdate")
        .on("timeupdate", function () {
            const percentage =
                (audioElement.currentTime / audioElement.duration) * 100;
            progressBar.css("width", `${percentage}%`);
        });
}

function toggleAudio(audio, playIcon, pauseIcon, progressBar) {
    if (audio.paused) {
        audio.play();
        playIcon.addClass("d-none");
        pauseIcon.removeClass("d-none");
    } else {
        audio.pause();
        playIcon.removeClass("d-none");
        pauseIcon.addClass("d-none");
    }
}

function resetPreviousAudio(audio) {
    const previousButton = $(".play-audio").filter(function () {
        return $(this).data("audio-id") === audio.id;
    });
    if (previousButton.length) {
        resetPlayPause(
            previousButton.find(".fa-play"),
            previousButton.find(".fa-pause"),
            previousButton.siblings(".progress").find(".progress-bar")
        );
    }
}

function resetPlayPause(playIcon, pauseIcon, progressBar) {
    playIcon.removeClass("d-none");
    pauseIcon.addClass("d-none");
    progressBar.css("width", "0%");
}
