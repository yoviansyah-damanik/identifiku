<div class="p-6 overflow-hidden bg-white rounded-lg sm:p-8">
    @if ($activeAssessment)
        <div class="flex gap-3 sm:gap-4">
            <div class="w-24 font-bold text-primary-500">
                {{ __(':name Name', ['name' => __('Class')]) }}
            </div>
            <div class="flex-1">
                {{ $activeAssessment->class->name }}
            </div>
        </div>
        <div class="flex gap-3 sm:gap-4">
            <div class="w-24 font-bold text-primary-500">
                {{ __('Status') }}
            </div>
            <div class="flex-1">
                @if ($assessment)
                    @if ($assessment->isDone)
                        <div class="text-green-500">
                            {{ __('Assessment result completed') }}
                        </div>
                    @elseif ($assessment->isSubmitted)
                        <span class="text-yellow-500">
                            {{ __('You have completed this assessment') }}!
                        </span>
                        {{ __('Assessment results are being processed') }}
                    @else
                        @if (is_null($assessment->remainingTime))
                            <div class="text-blue-500">
                                {{ __('Assessments have been made, but not yet started') }}
                            </div>
                        @else
                            @if ($assessment->remainingTime > 0)
                                <div class="text-yellow-600">
                                    {{ __('You can take this assessment with :time left', ['time' => GeneralHelper::getTime($assessment->remainingTime)]) }}
                                </div>
                            @elseif($assessment->remainingTime == 0)
                                <span class="text-red-500">
                                    {{ __('Time is up') }}!
                                </span>
                                {{ __('Assessment results are being processed') }}
                            @endif
                        @endif
                    @endif
                @else
                    {{ __('You have never done this assessment') }}
                @endif
            </div>
        </div>
        <div class="my-6 border-b"></div>
        <div class="relative flex flex-col items-start gap-5 lg:flex-row">
            <div class="flex-none w-full gap-5 md:flex lg:block lg:sticky lg:top-24 lg:w-96">
                <div
                    class="relative md:w-[23rem] lg:w-full flex items-center justify-center aspect-[16/9] bg-primary-50 rounded-lg overflow-hidden">
                    <img src="{{ $activeAssessment->quiz?->picture ?? Vite::image('default-quiz.webp') }}"
                        class="h-full transition-all max-w-fit group-hover:scale-125"
                        alt="{{ $activeAssessment->quiz->name }} Picture" />
                </div>
                <div>
                    <div class="my-5">
                        <div class="flex items-center gap-1">
                            <span class="i-ph-stack-simple-light"></span>
                            <div class="flex-1 font-light truncate">
                                {{ $activeAssessment->quiz->category->name }}
                            </div>
                        </div>
                        <div class="flex items-center gap-1">
                            <span class="i-ph-line-segments-light"></span>
                            <div class="flex-1 font-light truncate">
                                {{ $activeAssessment->quiz->phase->name }}
                                ({{ $activeAssessment->quiz->phase->grades->pluck('name')->join(', ') }})
                            </div>
                        </div>
                        <div class="flex items-center gap-1">
                            <span class="i-ph-clock-countdown-light"></span>
                            <div class="flex-1 font-light truncate">
                                {{ GeneralHelper::getTime($activeAssessment->quiz->estimation_time) }}
                            </div>
                        </div>
                        <div class="flex items-center gap-1">
                            <span class="i-ph-clock-user"></span>
                            <div class="flex-1 font-light truncate">
                                {{ $activeAssessment->quiz->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <x-button color="primary-transparent" :withBorderIcon="false" radius="rounded-full" block
                            :href="route('dashboard.quiz.preview', $activeAssessment->quiz)" icon="i-ph-magnifying-glass-light">
                            {{ __('See Questions') }}
                        </x-button>
                        @if ($assessment)
                            @if ($assessment->isDone)
                                <x-button block color="green" radius="rounded-full" :withBorderIcon="false"
                                    :href="route('dashboard.assessment.result', $assessment)">
                                    {{ __('Show :show', ['show' => __('Result')]) }}
                                </x-button>
                            @elseif ($assessment->isSubmitted)
                                <div class="italic text-center">
                                    {{ __('Assessment results are being processed') }}
                                </div>
                            @else
                                @if (is_null($assessment->remainingTime))
                                    <x-button block color="primary" radius="rounded-full" wire:click="play"
                                        :withBorderIcon="false" icon="i-ph-activity">
                                        {{ __('Conduct Assessment') }}
                                    </x-button>
                                    <div class="text-sm italic text-center text-red-500 leading-0">
                                        {{ __('A device with a screen width of at least 1280px is recommended') }}
                                    </div>
                                @else
                                    @if ($assessment->remainingTime > 0)
                                        <x-button block color="primary" radius="rounded-full" wire:click="play"
                                            :withBorderIcon="false" icon="i-ph-activity">
                                            {{ __('Continue') }}
                                        </x-button>
                                        <div class="text-sm italic text-center text-red-500 leading-0">
                                            {{ __('A device with a screen width of at least 1280px is recommended') }}
                                        </div>
                                    @elseif($assessment->remainingTime == 0)
                                        <div class="italic text-center">
                                            {{ __('Assessment results are being processed') }}
                                        </div>
                                    @endif
                                @endif
                            @endif
                        @else
                            <x-button block color="primary" radius="rounded-full" wire:click="play" :withBorderIcon="false"
                                icon="i-ph-activity">
                                {{ __('Conduct Assessment') }}
                            </x-button>
                            <div class="text-sm italic text-center text-red-500 leading-0">
                                {{ __('A device with a screen width of at least 1280px is recommended') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="w-full my-5 border-b lg:hidden"></div>
            <div class="w-full">
                <h1 class="mb-5 text-2xl font-bold text-primary-500">{{ $activeAssessment->quiz->name }}</h1>

                <div class="space-y-3 sm:space-y-4 mb-7">
                    <div>
                        <div class="text-lg font-semibold text-secondary-500">
                            {{ __('Overview') }}
                        </div>
                        {!! $activeAssessment->quiz->overview !!}
                    </div>
                    <div>
                        <div class="text-lg font-semibold text-secondary-500">
                            {!! __('Content Coverage') !!}
                        </div>
                        {{ $activeAssessment->quiz->content_coverage }}
                    </div>
                    <div>
                        <div class="text-lg font-semibold text-secondary-500">
                            {{ __('Assessment Objectives') }}
                        </div>
                        {!! $activeAssessment->quiz->assessment_objectives !!}
                    </div>
                    <div>
                        <div class="text-lg font-semibold text-secondary-500">
                            {{ __('Question Composition') }}
                        </div>

                        <table class="w-full max-w-[35rem] text-start">
                            <tbody>
                                @foreach ($activeAssessment->quiz->groups as $idx => $group)
                                    <tr>
                                        <td class="w-12 px-3 py-1">
                                            {{ $idx + 1 }}
                                        </td>
                                        <td class="px-3 py-1">
                                            {{ $group->name }}
                                        </td>
                                        <td class="px-3 py-1">
                                            {{ GeneralHelper::numberFormat($group->questions_count) }}
                                            {{ $group->questions_count > 1 ? __('Questions') : __('Question') }}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr class="font-semibold">
                                    <td colspan=2 class="px-3 py-1">
                                        {{ __('Questions Total') }}
                                    </td>
                                    <td class="px-3 py-1">
                                        {{ $activeAssessment->quiz->questionsTotal }}
                                        {{ $activeAssessment->quiz->questionsTotal > 1 ? __('Questions') : __('Question') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center">
            {{ __('Please select the assessment first') }}
        </div>
    @endif
</div>
