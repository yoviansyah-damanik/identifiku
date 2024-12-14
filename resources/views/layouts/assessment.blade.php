<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth focus:scroll-auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ Vite::image('favicon.png') }}" type="image/x-icon">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $title ?? 'Page Title' }}</title>
</head>

<body x-data="{
    currentTime: new Date().toLocaleTimeString('en-GB'),
    startTimer(startTime) {
        this.expiry = startTime;
        this.isShowTimer = true;
        console.log('Start Timer');
    },
    isShowTimer: false,
    interval: null,
    expiry: new Date().getTime(),
    remaining: null,
    timeout() {
        $wire.dispatch('setStep', { step: 3 });
        clearInterval(this.interval);
        {{-- Swal.fire({
            title: 'Good job!',
            text: 'You clicked the button!',
            icon: 'success'
        }); --}}
    },
    setRemaining() {
        if (this.remaining == 1)
            return this.timeout();

        const diff = this.expiry - new Date().getTime();
        this.remaining = parseInt(diff / 1000);
    },
    days() {
        return {
            value: this.remaining / 86400,
            remaining: this.remaining % 86400
        };
    },
    hours() {
        return {
            value: this.days().remaining / 3600,
            remaining: this.days().remaining % 3600
        };
    },
    minutes() {
        return {
            value: this.hours().remaining / 60,
            remaining: this.hours().remaining % 60
        };
    },
    seconds() {
        return {
            value: this.minutes().remaining,
        };
    },
    format(value) {
        return ('0' + parseInt(value)).slice(-2)
    },
    time() {
        return {
            days: this.format(this.days().value),
            hours: this.format(this.hours().value),
            minutes: this.format(this.minutes().value),
            seconds: this.format(this.seconds().value),
        }
    },
    init() {
        setInterval(() => {
            this.currentTime = new Date().toLocaleTimeString('en-GB');
        }, 1000);

        this.setRemaining()
        this.interval = setInterval(() => {
            this.setRemaining();
            {{-- console.log(this.remaining) --}}
        }, 1000);
    },
}">
    <div class="flex flex-col w-dvw !h-dvh">
        <x-assessment.header />

        <main class="relative flex-1">
            {{ $slot }}
        </main>

        <x-assessment.footer />
    </div>

    {{-- <livewire:loading-screen /> --}}
    <livewire:loading-state />

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
    @stack('scripts')

</html>
