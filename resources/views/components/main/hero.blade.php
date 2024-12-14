<div id="hero" class="h-[420px] lg:h-[640px] w-full bg-gradient-to-b from-primary-950 to-primary-500">
    <div class="flex flex-col items-center justify-center h-full gap-5 px-5 xl:px-7">
        <div
            class="ani_slideInDown aniUtil_active text-4xl md:text-5xl tracking-[.25em] text-center lg:text-6xl 2xl:text-8xl font-hero font-bold uppercase bg-gradient-to-r from-red-500 to-secondary-500 text-transparent bg-clip-text leading-snug">
            {{ __('Diagnostic Assessment') }}
        </div>
        <div class="text-lg text-center ani_zoomIn aniUtil_active lg:text-2xl 2xl:text-3xl text-secondary-50">
            {{ __('Differentiated Learning Needs in the Merdeka Curriculum') }}
        </div>
        {{-- <button class="flex items-center gap-3 bg-primary-50 text-primary-500 ">
            <span class="i-ph-arrow-right"></span>
        </button> --}}
        <div class="flex gap-3 ani_slideInUp aniUtil_active">
            <x-button color="secondary" base="px-9" radius="rounded-full"
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
        VANTA.DOTS({
            el: "#hero",
            mouseControls: true,
            touchControls: true,
            gyroControls: true,
            minHeight: 200.00,
            minWidth: 200.00,
            scale: 1.00,
            scaleMobile: 0.5,
            color: 0xfb773c,
            size: 5.10,
            spacing: 47.00,
            showLines: false,
            backgroundAlpha: 0
        })
    </script>
@endpush
