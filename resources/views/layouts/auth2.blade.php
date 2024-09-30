<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ Vite::image('favicon.png') }}" type="image/x-icon">

    @vite(['resources/css/app.css'])
    <title>{{ $title ?? 'Page Title' }}</title>
</head>

<body>
    <div class="flex w-dvw h-dvh bg-primary-50">
        <div class="flex-1 hidden lg:block bg-gradient-to-br from-primary-500 to-secondary-500"></div>
        <div
            class="relative p-9 h-full overflow-y-auto lg:p-16 bg-white w-full md:w-[480px] lg:w-[620px] flex items-start justify-center my-auto ">
            <div class="flex flex-col items-center justify-center w-full gap-5 my-auto">
                <img src="{{ Vite::image('logo.png') }}" alt="Logo" class="w-72 lg:w-96">
                <x-href :href="route('home')" icon="i-ph-house">
                    {{ __('Back to :page', ['page' => __('Home Page')]) }}
                </x-href>
                {{ $slot }}

                @if (!request()->routeIs('login'))
                    <div @class([
                        'flex justify-center items-center mt-7',
                        'justify-between gap-3 w-full' => !request()->routeIs('register'),
                    ])>
                        @if (!request()->routeIs('register'))
                            <x-href :href="route('registration')" icon="i-ph-arrow-left">
                                {{ __('Back to :page', ['page' => __('the Beginning')]) }}
                            </x-href>
                        @endif
                        <x-href :href="route('login')">
                            {{ __('Already have an account?') }}
                        </x-href>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <livewire:loading-screen />
    <livewire:loading-state />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
</body>

</html>
