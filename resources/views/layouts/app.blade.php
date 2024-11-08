<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth focus:scroll-auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ Vite::image('favicon.png') }}" type="image/x-icon">

    @vite(['resources/css/app.css'])
    <title>{{ $title ?? 'Page Title' }}</title>
</head>

<body x-data="{ sidebarToggle: false, headerMenuToggle: window.innerWidth > 768, loadingScreen: false }"
    :class="(headerMenuToggle && window.innerWidth <= 768) || loadingScreen ? 'h-dvh w-dvh overflow-hidden' : ''">
    <x-main.header />

    <main class="min-h-[60dvh] relative">
        {{ $slot }}
    </main>

    <x-main.footer />

    {{-- <livewire:loading-screen /> --}}
    <livewire:loading-state />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanta/dist/vanta.net.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
    @stack('scripts')

</html>
