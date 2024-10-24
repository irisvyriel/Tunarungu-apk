<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    @stack('css')
</head>

<body class="antialiased bg-slate-100">
    <main class="bg-white max-w-md flex justify-center min-h-screen mx-auto relative">
        @yield('main')
    </main>

    @vite('resources/js/app.js')
    @stack('js')
</body>

</html>
