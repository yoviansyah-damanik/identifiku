<div id="hero" class="h-[480px] lg:h-[640px] w-full bg-gradient-to-br from-primary-500 to-primary-700">
    <div class="flex flex-col items-center justify-center h-full gap-5 px-5 xl:px-7">
        <div
            class="text-4xl md:text-5xl tracking-[.25em] text-center lg:text-6xl 2xl:text-8xl font-hero font-bold uppercase bg-gradient-to-r from-red-500 to-secondary-500 text-transparent bg-clip-text leading-snug">
            {{ __('Diagnostic Assessment') }}
        </div>
        <div class="text-lg text-center lg:text-2xl 2xl:text-3xl text-secondary-50">
            {{ __('Differentiated Learning Needs in the Merdeka Curriculum') }}
        </div>
        {{-- <button class="flex items-center gap-3 bg-primary-50 text-primary-500 ">
            <span class="i-ph-arrow-right"></span>
        </button> --}}
        <div class="flex gap-3">
            <x-button color="primary-transparent" base="px-9" radius="rounded-full"
                x-on:click="window.scrollTo(0,document.getElementById('hero').offsetHeight)">
                {{ __('Get Started') }}
            </x-button>
            <x-button color="transparent" base="px-9 text-white" radius="rounded-full" icon="i-ph-arrow-right"
                iconPosition="right" :withBorderIcon="false" href="{{ route('assessment') }}">
                {{ __('See Assessment') }}
            </x-button>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        VANTA.NET({
            el: "#hero",
            mouseControls: true,
            touchControls: true,
            gyroControls: false,
            minHeight: 300.00,
            minWidth: 300.00,
            scale: 1.00,
            scaleMobile: 0.5,
            color: 0xfb773c,
            points: 10.00,
            spacing: 17.00,
            backgroundColor: 0x00183D,
        })
    </script>
@endpush
