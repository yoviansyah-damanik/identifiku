<div class="[perspective:800px] group cursor-pointer">
    <div
        class="relative transition-transform duration-500 [transform-style:preserve-3d] p-24 group-hover:[transform:rotateY(.5turn)]">
        <div
            class="[backface-visibility:hidden] overflow-hidden absolute inset-0 px-4 py-12 bg-gradient-to-br from-primary-50 to-primary-100 rounded-xl flex flex-col items-center justify-center">
            <div class="z-[1] mb-2 text-4xl font-extrabold text-center text-secondary-500">
                {{ GeneralHelper::numberFormat($count) }}
            </div>
            <div class="z-[1] text-base font-semibold tracking-widest text-center uppercase text-secondary-950">
                {{ $title }}
            </div>
            <div
                class="absolute z-0 bottom-0 inset-x-0 translate-y-1/2 w-full rounded-full aspect-square bg-white blur-3xl [backface-visibility:hidden]">
            </div>
        </div>
        <div
            class="[backface-visibility:hidden] overflow-hidden [transform:rotateY(.5turn)] absolute inset-0 px-4 py-12 bg-gradient-to-br from-primary-500 to-primary-700 text-secondary-50 text-center grid place-items-center rounded-xl">
            <div class="z-[1]">
                {{ $description }}
            </div>
            <div
                class="absolute z-0 bottom-0 inset-x-0 translate-y-1/2 w-full rounded-full aspect-square bg-slate-950 blur-3xl [backface-visibility:hidden]">
            </div>
        </div>
    </div>
</div>
