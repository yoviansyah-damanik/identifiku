<div class="fixed inset-0 z-10 justify-end flex-1 overflow-auto lg:flex lg:relative lg:w-96 bg-secondary-500/80 backdrop-blur-sm lg:backdrop-blur-none lg:bg-transparent"
    x-show="headerMenuToggle" x-transition>
    <nav id="headerNavigations"
        class="flex-col overflow-auto h-dvh w-dvw lg:w-auto lg:h-auto lg:flex lg:flex-row ms-auto px-9 pb-9 pt-24 lg:!p-0 gap-1">
        @foreach ($navigations as $nav)
            <a @class([
                'grid py-5 text-xl font-semibold text-white transition-all rounded-full px-7 place-items-center lg:py-3 lg:text-base lg:text-inherit',
                'lg:text-secondary-500' => $nav['isActive'],
                'hover:bg-primary-50 hover:text-primary-500' => !$nav['isActive'],
            ]) href="{{ $nav['url'] }}" wire:navigate
                x-on:click=" if(window.innerWidth < 768) headerMenuToggle = false">
                {{ $nav['title'] }}
            </a>
        @endforeach
    </nav>
</div>
