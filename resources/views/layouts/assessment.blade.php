<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth focus:scroll-auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ Vite::image('favicon.png') }}" type="image/x-icon">

    @vite(['resources/css/app.css'])
    <title>{{ $title ?? 'Page Title' }}</title>
</head>

<body class="flex flex-col w-screen h-screen">
    <x-assessment.header />

    <main class="relative flex-1">
        {{ $slot }}
    </main>

    <x-assessment.footer />

    {{-- <livewire:loading-screen /> --}}
    <livewire:loading-state />

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
    @stack('scripts')

</html>
