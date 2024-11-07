<div class="[perspective:800px] group cursor-pointer">
    <div
        class="relative transition-transform duration-500 [transform-style:preserve-3d] p-24 group-hover:[transform:rotateY(.5turn)]">
        <div
            class="[backface-visibility:hidden] absolute inset-0 px-4 py-12 bg-gradient-to-br from-secondary-50 to-secondary-100">
            <div class="mb-2 text-6xl font-extrabold text-center text-primary-500">
                {{ GeneralHelper::numberFormat($count) }}
            </div>
            <div class="text-base font-semibold tracking-wide text-center uppercase text-secondary-500">
                {{ $title }}
            </div>
        </div>
        <div
            class="[backface-visibility:hidden] [transform:rotateY(.5turn)] absolute inset-0 px-4 py-12 bg-gradient-to-br from-primary-500 to-primary-950 text-white text-center grid place-items-center">
            {{ $description }}
        </div>
    </div>
</div>
