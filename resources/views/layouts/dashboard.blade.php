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

<body x-data="{ sidebarToggle: false, loadingScreen: false }" class="relative flex flex-col overflow-hidden lg:flex-row w-dvw h-dvh bg-primary-50"
    x-init="sidebarToggle = JSON.parse(localStorage.getItem('sidebarToggle'));
    $watch('sidebarToggle', value => localStorage.setItem('sidebarToggle', JSON.stringify(value)))">
    <x-dashboard.sidebar />
    <div class="flex-1">
        <x-dashboard.header />
        <main class="w-full h-[calc(100dvh_-_6.5rem)] sm:h-[calc(100dvh_-_6.5rem)] p-4 overflow-y-auto">
            {{ $slot }}
        </main>
        <x-dashboard.footer />
    </div>

    {{-- <livewire:loading-screen /> --}}
    <livewire:loading-state />
    {{-- <livewire:offline-state /> --}}

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
    @stack('scripts')

</html>
