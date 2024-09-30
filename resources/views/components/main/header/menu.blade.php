<div class="fixed lg:flex justify-end lg:relative flex-1 overflow-auto lg:w-96 inset-0 bg-secondary-500/80 z-10 backdrop-blur-sm lg:backdrop-blur-none lg:bg-transparent"
    x-show="headerMenuToggle" x-transition>
    <nav id="headerNavigations"
        class="overflow-auto h-dvh w-dvw lg:w-auto lg:h-auto lg:flex flex-col lg:flex-row ms-auto p-9 lg:p-0">
        @foreach ($navigations as $nav)
            <a class="px-7 hover:bg-primary-50 rounded-full grid place-items-center font-semibold text-xl transition-all py-5 lg:py-3 lg:text-base text-white hover:text-primary-500 lg:text-inherit"
                href="{{ $nav['url'] }}" wire:navigate
                x-on:click=" if(window.innerWidth < 768) headerMenuToggle = false">
                {{ $nav['title'] }}
            </a>
        @endforeach
    </nav>
</div>
