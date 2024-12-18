<div class="relative cursor-pointer group">
    <div
        class="relative transition-transform duration-500 [transform-style:preserve-3d] p-16 lg:p-24 group-hover:[transform:rotateY(.5turn)]">
        {{-- NOON --}}
        <div
            class="[backface-visibility:hidden] absolute inset-0 px-4 py-6 lg:py-12 bg-gradient-to-br from-white to-primary-50 rounded-xl flex flex-col items-center justify-center shadow-md shadow-primary-50">
            <div class="z-[1] mb-2 text-xl lg:text-4xl font-extrabold text-center text-secondary-500">
                {{ GeneralHelper::numberFormat($count) }}
            </div>
            <div class="z-[1] text-base font-semibold tracking-widest text-center uppercase text-secondary-950">
                {{ $title }}
            </div>
            <div class="absolute top-0 translate-x-1/2 -translate-y-1/2 right-1/2">
                <img class="relative z-10 w-16 lg:w-24" src="{{ Vite::image('star.png') }}" alt="Star Image">
            </div>
        </div>
        {{-- NIGHT --}}
        <div
            class="[backface-visibility:hidden] [transform:rotateY(.5turn)] absolute inset-0 px-4 py-6 lg:py-12 bg-gradient-to-br from-primary-500 to-primary-700 text-secondary-50 text-center grid place-items-center rounded-xl shadow-md shadow-primary-950">
            <div class="z-[1]">
                {{ $description }}
            </div>
            <div class="absolute top-0 translate-x-1/2 -translate-y-1/2 right-1/2">
                <img class="relative z-10 w-16 lg:w-24" src="{{ Vite::image('moon.png') }}" alt="Moon Image">
            </div>
        </div>
    </div>

</div>
