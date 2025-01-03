<div id="header" x-data="{
    isHomePage: {{ $isHomePage ? 'true' : 'false' }},
    setHeaderOpacity() {
        const el = this.isHomePage ? document.getElementById('hero') : document.getElementById('breadcrumb');
        const headerBackground = document.getElementById('headerBackground');

        maxElementHeight = el.offsetHeight;
        headerBackgroundHeight = headerBackground.scrollHeight;
        windowScroll = window.scrollY;

        {{-- console.log(headerBackgroundHeight, maxElementHeight, windowScroll); --}}
        {{-- headerBackground.style.opacity = Math.max(0, Math.min(1, windowScroll / maxElementHeight)); --}}
        if (windowScroll >= maxElementHeight)
            headerBackground.style.opacity = 1;
        else
            headerBackground.style.opacity = 0;

        if (this.isHomePage === true) {
            const navigation = document.getElementById('headerNavigations')
            navigation.style.color = 'white';
            if (windowScroll > (maxElementHeight - 20)) {
                navigation.style.color = 'inherit';
            }
        }
    }
}" class="fixed inset-x-0 top-0 lg:mt-3 z-header" x-init="setHeaderOpacity()"
    x-on:scroll.window="setHeaderOpacity">
    <x-container>
        <div id="headerBackground" @class([
            'absolute inset-0 mx-auto shadow-md shadow-primary-50 bg-white lg:bg-white/90 lg:backdrop-blur-sm lg:rounded-full text-inherit w-full',
            'opacity-0' => $isHomePage,
        ])>
        </div>
        <div class="relative z-[1] flex h-20 lg:h-[4.75rem] items-center justify-between gap-5 w-full">
            <x-main.header.logo />

            <div class="relative flex items-center justify-end flex-1 gap-5"
                :class="headerMenuToggle ? 'fixed top-0 right-0 z-50' : ''">
                <div class="order-1 lg:hidden">
                    <x-button color="primary" base="text-base flex gap-3 h-full items-center group min-h-10 min-w-16"
                        size="md" radius="rounded-full" x-on:click="headerMenuToggle = !headerMenuToggle">
                        <span x-show="!headerMenuToggle" x-transition
                            class="absolute inset-0 m-auto text-center i-solar-widget-4-bold-duotone"></span>
                        <span x-show="headerMenuToggle" x-transition
                            class="absolute inset-0 m-auto text-center i-solar-widget-4-bold"></span>
                    </x-button>
                </div>

                <div class="fixed flex items-center justify-end flex-none gap-5 lg:relative lg:flex-1">
                    <x-main.header.menu />
                </div>

                <div @class(['flex-none w-auto relative', 'lg:w-72' => auth()->check()])>
                    <x-main.header.user />
                </div>
            </div>
        </div>
    </x-container>
</div>
