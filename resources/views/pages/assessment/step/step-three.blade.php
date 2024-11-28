<div class="grid h-full place-items-center">
    <div class="px-6 py-4 lg:py-8 w-full max-w-[920px]">
        <div
            class="text-xl font-bold text-transparent lg:text-2xl bg-clip-text from-primary-500 to-secondary-500 bg-gradient-to-br">
            @if (now() > $assessment->started_on->addMinutes($assessment->quiz->estimation_time))
                {{ __('Time is up.') }}
            @else
                {{ __('You have completed this assessment.') }}
            @endif
        </div>
        {{ __('You can view the assessment results on the assessment menu.') }}
        <div class="mt-5">
            <x-button :href="route('dashboard.assessment-history')" color="primary" radius="rounded-full">
                {{ __('Show :show', ['show' => __('Assessment')]) }}
            </x-button>
        </div>
    </div>
</div>
