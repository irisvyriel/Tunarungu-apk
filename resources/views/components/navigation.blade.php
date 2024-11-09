<div id="helper-button">
    <a href="{{ route('helper') }}" class="btn btn-info text-white rounded-5 btn-lg">
        <i class="fas fa-circle-info"></i>
    </a>
</div>

<nav class="navbar gradient-bg bg-primary sticky-bottom mb-0 rounded-top-5 shadow-lg" style="z-index: 9999;">
    <div class="container-fluid px-2 py-1">
        <div class="d-flex justify-content-between w-100 px-4">
            <a class="px-3" href="{{ route('home') }}">
                <i class="fas fa-house fs-4 text-white"></i>
            </a>
            <a class="px-3 text-decoration-none" id="restartSpeech" role="button">
                <i class="fas fa-microphone-alt fs-4 text-white"></i>
            </a>
            <a class="px-3" href="{{ route('profile') }}">
                <i class="fas fa-user fs-4 text-white"></i>
            </a>
        </div>
    </div>
</nav>
