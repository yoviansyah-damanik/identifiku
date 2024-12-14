<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth focus:scroll-auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ Vite::image('favicon.png') }}" type="image/x-icon">
    @stack('headers')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $title ?? 'Page Title' }}</title>
</head>

<body x-data="{ sidebarToggle: false, headerMenuToggle: window.innerWidth > 768, loadingScreen: false }"
    :class="(headerMenuToggle && window.innerWidth <= 768) || loadingScreen ? 'h-dvh w-dvh overflow-hidden' : ''"
    class="bg-sky-50">
    <x-main.header />

    <main class="min-h-[70dvh] relative">
        {{ $slot }}
    </main>

    <x-main.footer />

    {{-- <livewire:loading-screen /> --}}
    <livewire:loading-state />

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11" data-navigate-once></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js" data-navigate-once></script>
    <script src="https://cdn.jsdelivr.net/npm/vanta/dist/vanta.dots.min.js" data-navigate-once></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js" data-navigate-once></script>
    <script src="https://cdn.jsdelivr.net/gh/KodingKhurram/animate.css-dynamic@main/animate.min.js"></script>

    <x-livewire-alert::scripts />
    @stack('scripts')

</html>
