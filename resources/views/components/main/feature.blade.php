<div class="relative py-12">
    <x-container>
        <x-main.parts.title>
            {{ __('Features') }}
        </x-main.parts.title>
        <x-main.parts.subtitle>
            {{ __("Enjoy some of IdentifiKu's top features") }}
        </x-main.parts.subtitle>

        <div class="space-y-9 sm:space-y-12">
            <div class="relative flex flex-col gap-6 lg:flex-row sm:gap-9">
                <div class="flex-1 w-full ani_slideInLeft aniUtil_active">
                    <img src="{{ Vite::image('device.png') }}" alt="Device Image"
                        class="w-full lg:max-w-full max-w-[80%] mx-auto">
                </div>
                <div
                    class="flex flex-col items-center justify-center flex-1 w-full gap-3 lg:items-start ani_slideInRight aniUtil_active lg:pe-28">
                    <div
                        class="text-2xl font-bold text-center text-transparent lg:text-3xl lg:text-start bg-clip-text bg-gradient-to-br from-primary-500 to-secondary-500">
                        {{ __('Access from multiple devices') }}
                    </div>
                    <div class="text-base text-center lg:text-lg lg:text-start ">
                        {{ __('You can access IdentifiKu on any device anytime and anywhere.') }}
                    </div>
                </div>
                <img class="lg:z-[-1] absolute top-1/2 -translate-y-1/2 right-0 max-w-20 sm:max-w-40 ani_slideInDown aniUtil_active"
                    src="{{ Vite::image('rocket.gif') }}" alt="Rocket Image">
            </div>
            <div class="relative flex flex-col gap-6 lg:flex-row sm:gap-9">
                <div
                    class="flex flex-col items-center justify-center flex-1 order-1 w-full gap-3 lg:ps-28 lg:items-end ani_slideInLeft aniUtil_active lg:order-0">
                    <div
                        class="text-2xl font-bold text-center text-transparent lg:text-3xl lg:text-start bg-clip-text bg-gradient-to-br from-primary-500 to-secondary-500">
                        {{ __('Student and Teacher Management') }}
                    </div>
                    <div class="text-base text-center lg:text-lg lg:text-end">
                        {{ __('The school can manage and monitor the process carried out by students and teachers.') }}
                    </div>
                </div>
                <div class="flex-1 w-full ani_slideInRight aniUtil_active order-0 lg:order-1">
                    <img src="{{ Vite::image('mockup-1.png') }}" alt="Mockup 1 Image"
                        class="w-full lg:max-w-full max-w-[80%] mx-auto">
                </div>
                <img class="lg:z-[-1] absolute top-1/2 -translate-y-1/2 left-0 max-w-20 sm:max-w-40 ani_slideInDown aniUtil_active"
                    src="{{ Vite::image('fly-bird.gif') }}" alt="Fly Bird Image">
            </div>
            <div class="relative flex flex-col gap-6 lg:flex-row sm:gap-9">
                <div class="flex-1 w-full ani_slideInLeft aniUtil_active">
                    <img src="{{ Vite::image('mockup-2.png') }}" alt="Mockup 2 Image"
                        class="w-full lg:max-w-full max-w-[80%] mx-auto">
                </div>
                <div
                    class="flex flex-col items-center justify-center flex-1 w-full gap-3 lg:items-start ani_slideInRight aniUtil_active lg:pe-28">
                    <div
                        class="text-2xl font-bold text-center text-transparent lg:text-3xl lg:text-start bg-clip-text bg-gradient-to-br from-primary-500 to-secondary-500">
                        {{ __('Fast and Precise') }}
                    </div>
                    <div class="text-base text-center lg:text-lg lg:text-start ">
                        {{ __('Assessment results will be released within a few minutes after the assessment is completed according to the requirements of the assessment.') }}
                    </div>
                </div>
                <img class="lg:z-[-1] absolute top-1/2 -translate-y-1/2 right-0 max-w-20 sm:max-w-40 ani_slideInDown aniUtil_active"
                    src="{{ Vite::image('butterfly.gif') }}" alt="Butterfly Image">
            </div>
            <div class="relative flex flex-col gap-6 lg:flex-row sm:gap-9">
                <div
                    class="flex flex-col items-center justify-center flex-1 order-1 w-full gap-3 lg:ps-28 lg:items-end ani_slideInLeft aniUtil_active lg:order-0">
                    <div
                        class="text-2xl font-bold text-center text-transparent lg:text-3xl lg:text-end bg-clip-text bg-gradient-to-br from-primary-500 to-secondary-500">
                        {{ __('Varied Assessments') }}
                    </div>
                    <div class="text-base text-center lg:text-lg lg:text-end">
                        {{ __('There are several types of assessments you can do.') }}
                    </div>
                    <x-button color="primary" base="px-9 text-white" radius="rounded-full" icon="i-ph-arrow-right"
                        iconPosition="right" :withBorderIcon="false" href="{{ route('assessment') }}">
                        {{ __('See Assessment') }}
                    </x-button>
                </div>
                <div class="flex-1 w-full ani_slideInRight aniUtil_active order-0 lg:order-1">
                    <img src="{{ Vite::image('mockup-3.png') }}" alt="Mockup 3 Image"
                        class="w-full lg:max-w-full max-w-[80%] mx-auto">
                </div>
                <img class="lg:z-[-1] absolute top-1/2 -translate-y-1/2 left-0 max-w-20 sm:max-w-40 ani_slideInDown aniUtil_active"src="{{ Vite::image('bird2.gif') }}"
                    alt="Bird Image">
            </div>
        </div>
    </x-container>

    <img class="absolute bottom-[calc(100%_+_1rem)] animate-refine-vertical right-6 lg:right-14 -rotate-6 max-w-40 lg:max-w-96 pointer-events-none"
        src="{{ Vite::image('plane.png') }}" alt="Plane Image">
</div>
