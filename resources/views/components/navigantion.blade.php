<div class="flex w-full justify-between absolute fixed-bottom bottom-0  text-white bg-white">
    <a class="bg-slate-700 rounded-tr-[80px] w-40 h-16 flex items-center justify-center" href="{{ route('home') }}">
        <x-heroicon-o-home class="w-6 h-6 text-gray-500" />
    </a>
    <div class="absolute left-1/2 -translate-x-1/2 -translate-y-2">
        <button
            class="btn bg-white w-16 h-16 rounded-full shadow-2xl flex items-center justify-center hover:bg-white hover:ring-2 hover:ring-blue-500">
            <x-heroicon-o-microphone class="w-6 h-6 text-blue-500" />
        </button>
    </div>
    <a class="bg-slate-700 rounded-tl-[80px] w-40 h-16 flex items-center justify-center" href="{{ route('profile') }}">
        <x-heroicon-o-user class="w-6 h-6 text-gray-500" />
    </a>
</div>
