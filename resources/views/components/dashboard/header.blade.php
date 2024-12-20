<header class="sticky h-16 px-4 transition-all duration-300 z-header top-3">
    <div
        class="flex items-center justify-between gap-1 rounded-full shadow bg-white/70 dark:bg-slate-900/30 backdrop-blur-md">
        <div class="flex items-center flex-1 gap-3 ms-1">
            <x-button color="primary" base="text-base flex gap-3 h-full items-center group min-h-10 min-w-16"
                size="md" radius="rounded-full" x-on:click='sidebarToggle = !sidebarToggle'>
                <span x-show="!sidebarToggle" x-transition
                    class="absolute inset-0 m-auto text-center i-solar-widget-4-bold-duotone"></span>
                <span x-show="sidebarToggle" x-transition
                    class="absolute inset-0 m-auto text-center i-solar-widget-4-bold"></span>
            </x-button>
            <x-button color="primary-transparent" :withNavigated="false"
                base="text-base flex justify-center h-full items-center group min-h-10 min-w-16" size="md"
                radius="rounded-full" href="{{ route('home') }}">
                <div class="flex items-center justify-center gap-3">
                    <span class="i-ph-house"></span>
                    <span class="hidden md:block">{{ __('Home Page') }}</span>
                </div>
            </x-button>
        </div>
        <div class="relative flex-none lg:w-72">
            {{-- <x-dashboard.theme base="-mt-5 hidden sm:block" /> --}}
            <x-dashboard.header.user />
        </div>
    </div>
</header>
