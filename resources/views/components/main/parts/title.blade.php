<div x-data="{
    id: $id('title')
}" class="flex flex-col items-center justify-center ani_fadeInUp aniUtil_active group"
    :id="id">
    <div
        class="inline-block relative mx-auto mb-3 text-4xl font-bold tracking-[.275em]  text-primary-500 uppercase font-hero cursor-default">
        <div class="aniCus-text aniCus_text-bounce aniUtil_onMouse aniUtil_active">
            {{ $slot }}
        </div>
        <div class="absolute right-0 bottom-full ani_tada aniUtil_active">
            <img src="{{ Vite::image('title-decoration.png') }}" alt="Title Decoration"
                class="transition-all group-hover:-translate-y-3 group-hover:scale-110">
        </div>
    </div>
</div>
