<div class="relative py-12 z-[1]">
    <x-container>
        <div class="relative flex items-center justify-center pb-8 lg:pb-24">
            <img class="hidden pointer-events-none lg:block lg:w-60 xl:w-72 ani_bounceInLeft aniUtil_active"
                src="{{ Vite::image('bird-left.png') }}" alt="Bird Image">
            <div
                class="z-[1] relative aspect-[16/9] max-w-[720px] w-full bg-white rounded-xl overflow-hidden shadow-lg shadow-primary-50 ani_bounceIn aniUtil_active">
                <iframe width="100%" height="100%" src="https://www.youtube.com/embed/tgbNymZ7vqY">
                </iframe>
            </div>
            <img class="hidden pointer-events-none lg:block lg:w-60 xl:w-72 ani_bounceInRight aniUtil_active"
                src="{{ Vite::image('bird-right.png') }}" alt="Bird Image">
            {{-- <img class="absolute inset-x-0 bottom-0 w-full pointer-events-none" src="{{ Vite::image('grass2.png') }}"
                alt="Grass Image"> --}}
        </div>
    </x-container>
</div>
