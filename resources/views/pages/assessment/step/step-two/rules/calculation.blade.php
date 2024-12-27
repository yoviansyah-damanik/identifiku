<div class="flex flex-col lg:h-full lg:flex-row">
    <div class="relative flex flex-col shadow lg:h-[calc(100dvh_-_88px)] lg:w-80 xl:w-96">
        <div class="flex lg:block">
            <div class="flex-1 px-6 py-4 text-sm sm:px-8 lg:py-8 bg-gradient-to-br from-primary-500 to-primary-700">
                <div class="flex">
                    <div class="font-semibold w-28 text-secondary-500">
                        {{ __(':name Name', ['name' => __('Class')]) }}
                    </div>
                    <div class="flex-1 text-secondary-50">
                        {{ $assessment->class->name }}
                    </div>
                </div>
                <div class="flex">
                    <div class="font-semibold w-28 text-secondary-500">
                        {{ __(':name Name', ['name' => __('Quiz')]) }}
                    </div>
                    <div class="flex-1 text-secondary-50">
                        {{ $assessment->quiz->name }}
                    </div>
                </div>
                <div class="flex">
                    <div class="font-semibold w-28 text-secondary-500">
                        {{ __(':type Type', ['type' => __('Quiz')]) }}
                    </div>
                    <div class="flex-1 text-secondary-50">
                        {{ __(Str::headline($assessment->quiz->type)) }}
                    </div>
                </div>
                {{-- <div class="flex">
                    <div class="font-semibold w-28 text-secondary-500">
                        {{ __(':type Type', ['type' => __('Assessment Rule')]) }}
                    </div>
                    <div class="flex-1 text-secondary-50">
                        {{ collect(QuizHelper::getAssessmentRuleType())->where('value', $assessment->rule->type)->first()['title'] }}
                    </div>
                </div> --}}
            </div>
        </div>
        {{-- GROUPS --}}
        <x-assessment.step.calculation.group :groups="$questions" :$questionActive :$result />
        {{-- END GROUPS --}}
    </div>

    <div
        class="relative flex flex-col justify-between lg:h-[calc(100dvh_-_88px)] gap-3 overflow-auto lg:flex-1 sm:gap-4">

        <div class="px-6 py-4 mb-3 font-semibold lg:py-8 bg-primary-50 text-primary-500">
            <div class="text-base lg:text-lg">
                {{ GeneralHelper::numberToRoman($groupActive['order']) }}. {{ $groupActive['name'] }}
            </div>
            <div class="text-sm font-light lg:text-base">
                {{ $groupActive['description'] }}
            </div>
        </div>
        {{-- ACTIVE QUESTION --}}
        <x-assessment.step.calculation.question :$questionActive :$result :$calculationAnswers />
        {{-- END ACTIVE QUESTION --}}

        <div class="fixed inset-x-0 bottom-0 flex items-stretch justify-end lg:p-8 lg:gap-3 lg:relative">
            <div class="flex items-stretch justify-center flex-1 lg:flex-none lg:gap-1">
                <x-button :loading="!$prevButton" wire:click="prev" base="lg:!rounded-full rounded-none" color="red" block
                    icon="i-ph-arrow-left" :withBorderIcon="false">
                    <span class="hidden lg:block">{{ __('Previous') }}</span>
                    <span class="block lg:hidden"></span>
                </x-button>
                <x-button :loading="!$nextButton" wire:click="next" base="lg:!rounded-full rounded-none" color="green" block
                    icon="i-ph-arrow-right" iconPosition="right" :withBorderIcon="false">
                    <span class="hidden lg:block">{{ __('Next') }}</span>
                    <span class="block lg:hidden"></span>
                </x-button>
            </div>
            <x-button wire:click="hasDone" base="max-w-52 lg:max-w-64 lg:!rounded-full rounded-none" block
                color="primary">
                {{ __('Submit') }}
            </x-button>
        </div>
    </div>
</div>

@push('scripts')
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/sort@3.x.x/dist/cdn.min.js"></script>
@endpush
