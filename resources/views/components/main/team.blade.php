<div class="relative py-12 bg-bottom bg-no-repeat bg-cover lg:bg-contain bg-hill">
    <x-container class="relative z-[1]">
        <x-main.parts.title>
            {{ __('Our Team') }}
        </x-main.parts.title>
        <x-main.parts.subtitle>
            {{ __('No team is great without trust, hard work, and mutual support. Greatness is not just about talent, but how all the elements come together for a greater cause.') }}
        </x-main.parts.subtitle>
        <div class="swiper">
            <div class="swiper-wrapper py-9">
                @foreach (range(0, 1) as $x)
                    @foreach ($teams as $team)
                        <div
                            class="swiper-slide shadow-lg max-w-[90dvw] sm:max-w-[65dvw] lg:max-w-[420px] flex flex-row items-center justify-center rounded-xl w-full lg:flex-col p-6 transition-all bg-gradient-to-br from-primary-400 to-primary-500 sm:p-8">
                            <div class="relative w-1/3 overflow-hidden lg:w-auto">
                                <img class="w-full relative z-[1]" src="{{ $team['avatar'] }}"
                                    alt="{{ $team['name'] }} Avatar" loading="lazy">
                                <div class="swiper-lazy-preloader"></div>
                                <div
                                    class="swiper-circle-active-mark duration-1000 transition-all absolute w-[70%] inset-x-0 mx-auto bottom-0 z-0 rounded-full aspect-square bg-secondary-50">
                                </div>
                            </div>
                            <div class="flex flex-col flex-1 gap-1 mt-3 text-center lg:gap-0 text-primary-50">
                                <div class="text-base font-bold text-secondary-500 lg:text-lg">
                                    {{ $team['name'] }}
                                </div>
                                <div class="text-sm font-light tracking-widest">
                                    {{ $team['as'] }}
                                </div>
                                <div class="text-sm font-light tracking-wide">
                                    {{ '@' . $team['ig'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
            {{-- <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div> --}}
        </div>
    </x-container>
    <div class="absolute bottom-0 left-0 z-0 -translate-x-1/2 pointer-events-none">
        <img class="2xl:h-[1200px]" src="{{ Vite::image('tree.png') }}" />
    </div>
</div>

@push('headers')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush
@push('scripts')
    <script type="text/javascript">
        function initSwiper() {
            new Swiper('.swiper', {
                loop: true,
                speed: 1000,
                autoplay: {
                    delay: 3000,
                },
                grabCursor: true,
                // navigation: {
                //     nextEl: '.swiper-button-next',
                //     prevEl: '.swiper-button-prev',
                // },
                centeredSlides: true,
                slidesPerView: 'auto',
                effect: 'coverflow',
                coverflowEffect: {
                    depth: 200,
                    modifier: 1,
                    rotate: 30,
                    scale: 1,
                    slideShadows: true,
                    // stretch: 80,
                },
            });
        }
        document.addEventListener('livewire:init', () => initSwiper())
        document.addEventListener('livewire:navigated', () => initSwiper())
    </script>
@endpush
