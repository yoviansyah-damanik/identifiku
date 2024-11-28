<div class="grid h-full place-items-center">
    <div class="px-6 py-4 lg:py-8 w-full max-w-[920px]">
        @if ($step == 1)
            <div>
                <div
                    class="text-xl font-bold text-transparent lg:text-2xl bg-clip-text from-primary-500 to-secondary-500 bg-gradient-to-br">
                    {{ __('Welcome, :name!', ['name' => auth()->user()->student->name]) }}
                </div>
                <div class="mb-5 font-normal">
                    {{ __('Before starting the assessment, please note the steps that will be explained in the following guidelines.') }}
                </div>
                <x-button color="primary" wire:click="next" icon="i-ph-arrow-right" radius="rounded-full" :withBorderIcon="false"
                    iconPosition="right">
                    {{ __('Next') }}
                </x-button>
            </div>
        @endif

        @if ($step == 2)
            <div>
                <div class="flex">
                    <div class="font-semibold w-36 lg:w-48">
                        {{ __('Name') }}
                    </div>
                    <div class="flex-1">
                        {{ auth()->user()->student->name }}
                    </div>
                </div>
                <div class="flex">
                    <div class="font-semibold w-36 lg:w-48">
                        {{ __('School') }}
                    </div>
                    <div class="flex-1">
                        {{ auth()->user()->getSchoolData->name }}
                    </div>
                </div>
                <div class="my-3 border-b"></div>
                <div class="flex">
                    <div class="font-semibold w-36 lg:w-48">
                        {{ __('Class') }}
                    </div>
                    <div class="flex-1">
                        {{ $assessment->class->name }}
                    </div>
                </div>
                <div class="flex">
                    <div class="font-semibold w-36 lg:w-48">
                        {{ __(':name Name', ['name' => __('Quiz')]) }}
                    </div>
                    <div class="flex-1">
                        {{ $assessment->quiz->name }}
                    </div>
                </div>
                <div class="flex">
                    <div class="font-semibold w-36 lg:w-48">
                        {{ __(':type Type', ['type' => __('Quiz')]) }}
                    </div>
                    <div class="flex-1">
                        {{ __(Str::headline($assessment->quiz->type)) }}
                    </div>
                </div>
                <div class="flex">
                    <div class="font-semibold w-36 lg:w-48">
                        {{ __('Estimation Time') }}
                    </div>
                    <div class="flex-1">
                        {{ GeneralHelper::numberFormat($assessment->quiz->estimation_time) . ' ' . __('Minutes') }}
                    </div>
                </div>

                <div class="mt-5">
                    <div class="mb-5">
                        {{ __('Make sure all the data above matches the assessment you choose. If it does not match, please re-select the assessment available in the class you have attended.') }}
                    </div>
                    <div class="flex gap-1">
                        <x-button color="red" wire:click="next" icon="i-ph-arrow-left" radius="rounded-full"
                            :withBorderIcon="false" :href="route('dashboard.assessment')">
                            {{ __('Check Assessment') }}
                        </x-button>
                        <x-button color="primary" wire:click="next" icon="i-ph-arrow-right" radius="rounded-full"
                            :withBorderIcon="false" iconPosition="right">
                            {{ __('Next') }}
                        </x-button>
                    </div>
                </div>
            </div>
        @endif

        @if ($step == 3)
            <div class="text-justify lg:text-start">
                <div
                    class="mb-5 text-xl font-bold text-transparent bg-clip-text bg-gradient-to-br from-primary-500 to-secondary-500">
                    {{ __('The question type in this assessment is :type.', ['type' => __('Multiple Choice')]) }}
                </div>
                @if ($assessment->quiz->assessmentRule->question_type == 'dichotomous')
                    <x-assessment.helper.dichotomous :questionType="$assessment->quiz->assessmentRule->question_type" />
                @elseif($assessment->quiz->assessmentRule->question_type == 'multipleChoice')
                    <x-assessment.helper.multiple-choice :questionType="$assessment->quiz->assessmentRule->question_type" />
                @endif

                <div class="mt-5 space-y-5">
                    <div class="">{{ __("Press the 'start' button below to begin the assessment.") }}</div>
                    <x-button color="primary" block wire:click="start" radius="rounded-full">
                        {{ __('Start') }}
                    </x-button>
                </div>
            </div>
        @endif
    </div>
</div>
