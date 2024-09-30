<header class="sticky z-header h-16 px-4 overflow-hidden transition-all duration-300 shadow-sm top-3">
    <div
        class="flex items-center justify-between gap-1 rounded-full shadow bg-white/70 dark:bg-slate-900/30 backdrop-blur-md">
        <div class="flex items-center flex-1 ms-1 gap-3">
            <x-button color="primary" base="text-base flex gap-3 h-full items-center group min-h-10 min-w-16"
                size="md" radius="rounded-full" x-on:click='sidebarToggle = !sidebarToggle'>
                <span x-show="!sidebarToggle" x-transition
                    class="absolute inset-0 m-auto text-center i-solar-widget-4-bold-duotone"></span>
                <span x-show="sidebarToggle" x-transition
                    class="absolute inset-0 m-auto text-center i-solar-widget-4-bold"></span>
            </x-button>
            <x-button color="primary-transparent" :withNavigated="false"
                base="text-base flex justify-center h-full items-center group min-h-10 min-w-16" icon="i-ph-house"
                size="md" radius="rounded-full" href="{{ route('home') }}">
                <span class="hidden md:block">{{ __('Home Page') }}</span>
            </x-button>
        </div>
        <div class="flex items-center flex-none gap-6">
            {{-- <x-dashboard.theme base="-mt-5 hidden sm:block" /> --}}
            <x-dashboard.header.user />
        </div>
    </div>
</header>
