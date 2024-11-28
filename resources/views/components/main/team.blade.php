<div class="py-12">
    <div>
        <x-container>
            <div class="mb-3 text-3xl font-extrabold tracking-widest text-center uppercase">
                {{ __('Our Team') }}
            </div>
            <div class="mb-5 font-light text-center">
                {{ __('No team is great without trust, hard work, and mutual support. Greatness is not just about talent, but how all the elements come together for a greater cause.') }}
            </div>
            <div class="swiper">
                <div class="swiper-wrapper py-9">
                    @foreach (range(0, 1) as $x)
                        @foreach ($teams as $team)
                            <div
                                class="swiper-slide  shadow-lg max-w-[420px] flex flex-col items-center justify-center rounded-xl  w-full p-6 bg-white shadow-primary-50 sm:p-8">
                                <div class="relative overflow-hidden">
                                    <img class="w-full relative z-[1]" src="{{ $team['avatar'] }}"
                                        alt="{{ $team['name'] }} Avatar" loading="lazy">
                                    <div class="swiper-lazy-preloader"></div>
                                    <div
                                        class="swiper-circle-active-mark duration-1000 transition-all absolute w-[70%] inset-x-0 mx-auto bottom-0 z-0 rounded-full aspect-square bg-primary-50">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <div
                                        class="mt-3 text-lg font-bold text-transparent bg-clip-text bg-gradient-to-br from-primary-500 to-secondary-500">
                                        {{ $team['name'] }}
                                    </div>
                                    <div class="font-light tracking-widest">
                                        {{ $team['as'] }}
                                    </div>
                                    <div class="font-light tracking-wide">
                                        {{ '@' . $team['ig'] }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </x-container>
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
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                centeredSlides: true,
                slidesPerView: 'auto',
                effect: 'coverflow',
                coverflowEffect: {
                    depth: 200,
                    modifier: 1,
                    rotate: 0,
                    scale: 1,
                    slideShadows: false,
                    stretch: 80,
                },
            });
        }
        document.addEventListener('livewire:init', () => initSwiper())
        document.addEventListener('livewire:navigated', () => initSwiper())
    </script>
@endpush
