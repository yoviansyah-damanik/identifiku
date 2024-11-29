<div class="relative flex flex-col w-full gap-5 p-5 bg-white rounded-lg lg:p-7 lg:flex-row pt-9 drop-shadow-md group">
    <div class="flex items-center justify-center w-full overflow-hidden rounded-lg lg:flex-none h-44 lg:w-72">
        <img src="{{ $assessment->quiz?->picture ?? Vite::image('default-quiz.webp') }}"
            class="w-full transition-all group-hover:scale-125" alt="{{ $assessment->quiz->name }} Picture" />
    </div>
    <div class="lg:[column-count:3] sm:[column-count:2] [column-count:2] [column-gap:1.5rem] w-full lg:w-auto flex-1">
        <x-assessment-history-sub-item :title="__(':name Name', ['name' => __('Quiz')])">
            <x-href class="font-bold text-secondary-500" :href="route('dashboard.quiz.show', $assessment->quiz)">
                {{ $assessment->quiz->name }}
            </x-href>
        </x-assessment-history-sub-item>
        <x-assessment-history-sub-item :title="__('Quiz Category')" :value="$assessment->quiz->category->name" />
        <x-assessment-history-sub-item :title="__('Quiz Phase')" :value="$assessment->quiz->phase->name .
            ' (' .
            $assessment->quiz->phase->grades->pluck('name')->join(', ') .
            ')'" />
        <x-assessment-history-sub-item :title="__('Type')" :value="__(Str::headline($assessment->quiz->type))" />
        <x-assessment-history-sub-item :title="__('Estimation Time')" :value="GeneralHelper::getTime($assessment->quiz->estimation_time)" />
        <x-assessment-history-sub-item :title="__(':name Name', ['name' => __('Class')])" :value="$assessment->class->name" />
        <x-assessment-history-sub-item :title="__('Status')">
            @if ($assessment->isDone)
                <div class="text-green-500">
                    {{ __('Assessment result completed') }}
                </div>
            @elseif ($assessment->isSubmitted)
                <span class="text-yellow-500">
                    {{ __('You have completed this assessment') }}!
                </span>
            @else
                @if (is_null($assessment->remainingTime))
                    <div class="text-blue-500">
                        {{ __('Assessments have been made, but not yet started') }}
                    </div>
                @else
                    @if ($assessment->remainingTime > 0)
                        <div class="text-yellow-600">
                            {{ __('You can take this assessment with :minute minutes left', ['minute' => $assessment->remainingTime]) }}
                        </div>
                    @elseif($assessment->remainingTime == 0)
                        <span class="text-red-500">
                            {{ __('Time is up') }}!
                        </span>
                        {{ __('Assessment results are being processed') }}
                    @endif
                @endif
            @endif
        </x-assessment-history-sub-item>
        {{-- <div class="[column-span:all] w-full max-w-[420px] mt-7"> --}}
        <x-assessment-history-sub-item>
            @if ($assessment->isDone)
                <x-button block color="green" radius="rounded-full" :withBorderIcon="false" :href="route('dashboard.assessment.result', $assessment)">
                    {{ __('Show :show', ['show' => __('Result')]) }}
                </x-button>
            @elseif ($assessment->isSubmitted)
                <div class="italic text-center">
                    {{ __('Assessment results are being processed') }}
                </div>
            @else
                @if (is_null($assessment->remainingTime))
                    <x-button block color="primary" radius="rounded-full"
                        wire:click="play('{{ $assessment->quiz->slug }}','{{ $assessment->class->slug }}')"
                        :withBorderIcon="false" icon="i-ph-activity">
                        {{ __('Conduct Assessment') }}
                    </x-button>
                    <div class="text-sm italic text-center text-red-500 leading-0">
                        {{ __('A device with a screen width of at least 1280px is recommended') }}
                    </div>
                @else
                    @if ($assessment->remainingTime > 0)
                        <x-button block color="primary" radius="rounded-full"
                            wire:click="play('{{ $assessment->quiz->slug }}','{{ $assessment->class->slug }}')"
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
        </x-assessment-history-sub-item>
        {{-- </div> --}}
    </div>
    {{-- <div class="flex flex-col flex-1 gap-3 px-1 lg:flex-row sm:gap-4 lg:px-3 md:px-2">
        <div class="flex-1 order-1 lg:order-0">
            <div class="text-lg font-semibold text-primary-500 line-clamp-2 group-hover:text-secondary-500">
                {{ $assessment->quiz->name }}
            </div>
            <div class="flex items-center gap-1 mt-1 text-sm">
                <span class="i-ph-stack-simple-light"></span>
                <div class="flex-1 font-light truncate">
                    {{ $assessment->quiz->category->name }}
                </div>
            </div>
            <div class="flex items-center gap-1 text-sm">
                <span class="i-ph-line-segments-light"></span>
                <div class="flex-1 font-light truncate">
                    {{ $assessment->quiz->phase->name }}
                    ({{ $assessment->quiz->phase->grades->pluck('name')->join(', ') }})
                </div>
            </div>
            <div class="flex items-center gap-1 text-sm">
                <span class="i-ph-folder"></span>
                <div class="flex-1 font-light truncate">
                    {{ __(Str::headline($assessment->quiz->type)) }}
                </div>
            </div>
            <div class="flex items-center gap-1 text-sm">
                <span class="i-ph-clock-countdown-light"></span>
                <div class="flex-1 font-light truncate">
                    {{ GeneralHelper::getTime($assessment->quiz->estimation_time) }}
                </div>
            </div>
            <div class="flex items-center gap-1 text-sm">
                <span class="i-ph-list-checks-light"></span>
                <div class="flex-1 font-light truncate">
                    {{ $assessment->quiz->questionsTotal }}
                    {{ $assessment->quiz->questionsTotal > 1 ? __('Questions') : __('Question') }}
                </div>
            </div>
        </div>
        <div class="flex-1 order-0 lg:order-1">
            <div class="flex gap-3 sm:gap-4">
                <div class="w-24 font-bold text-primary-500">
                    {{ __(':name Name', ['name' => __('Class')]) }}
                </div>
                <div class="flex-1">
                    {{ $assessment->class->name }}
                </div>
            </div>
            <div class="flex gap-3 sm:gap-4">
                <div class="w-24 font-bold text-primary-500">
                    {{ __('Status') }}
                </div>
                <div class="flex-1">
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
                                    {{ __('You can take this assessment with :minute minutes left', ['minute' => $assessment->remainingTime]) }}
                                </div>
                            @elseif($assessment->remainingTime == 0)
                                <span class="text-red-500">
                                    {{ __('Time is up') }}!
                                </span>
                                {{ __('Assessment results are being processed') }}
                            @endif
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div> --}}
</div>
