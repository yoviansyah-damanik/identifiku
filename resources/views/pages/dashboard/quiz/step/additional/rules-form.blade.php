<div class="flex-1 space-y-3 shadow sm:space-y-4">
    @if ($rule)
        <div class="p-6 bg-white rounded-lg sm:p-8">
            <div>
                <div class="flex flex-col">
                    <div class="flex">
                        <div class="w-[13rem] font-semibold">
                            {{ __('Type') }}
                        </div>
                        <div class="flex-1">
                            {{ collect(QuizHelper::getAssessmentRuleType())->where('value', $rule->type)->first()['title'] }}
                        </div>
                    </div>
                    <div class="flex">
                        <div class="w-[13rem] font-semibold">
                            {{ __(':type Type', ['type' => __('Question')]) }}
                        </div>
                        <div class="flex-1">
                            {{ collect(QuizHelper::getQuestionType($rule->type))->where('value', $rule->question_type)->first()['title'] }}
                        </div>
                    </div>
                    <div class="flex">
                        <div class="w-[13rem] font-semibold">
                            {{ __('Number of :subject', ['subject' => __('Answer Options')]) }}
                        </div>
                        <div class="flex-1">
                            {{ GeneralHelper::numberFormat($rule->max_answer) . ' ' . __('Answer Options') }}
                        </div>
                    </div>
                    <div class="flex">
                        <div class="w-[13rem] font-semibold">
                            {{ __('Number of :subject', ['subject' => __('Indicators')]) }}
                        </div>
                        <div class="flex-1">
                            {{ GeneralHelper::numberFormat($rule->max_indicator) .
                                ' ' .
                                ($rule->max_indicator > 1 ? __('Indicators') : __('Indicator')) }}
                        </div>
                    </div>
                    <div class="flex">
                        <div class="w-[13rem] font-semibold">
                            {{ __('Description') }}
                        </div>
                        <div class="flex-1">
                            {{ collect(QuizHelper::getAssessmentRuleType())->where('value', $rule->type)->first()['description'] }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ANSWER ASSESSMENT RULE --}}
        <div class="p-6 bg-white rounded-lg sm:p-8">
            @foreach (range(0, $rule->max_answer - 1) as $x)
                <div class="pb-3 border-b last:border-b-0" :key="'question-'.$x">
                    <div class="flex">
                        <div
                            class="grid w-16 text-4xl font-bold pointer-events-none place-items-center text-primary-500">
                            {{ GeneralHelper::numberToAlpha($loop->iteration) }}
                        </div>
                        <div class="flex-1 px-5 py-3 sm:px-9">
                            @php
                                $question = $rule->answers
                                    ->where('answer', GeneralHelper::numberToAlpha($loop->iteration))
                                    ->first();
                            @endphp
                            <div class="space-y-3 sm:space-y-4">
                                <div>
                                    <div class="font-semibold">
                                        {{ __('Default') }}
                                    </div>
                                    <div>
                                        {{ $question->default ?: __('No default value set') }}
                                    </div>
                                </div>
                                @if (in_array($rule->type, ['group-calculation', 'calculation-2']))
                                    <div>
                                        <div class="font-semibold">
                                            {{ __('Score') }}
                                        </div>
                                        <div>
                                            {{ $question->score ?: __('No score set') }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="my-3 border-b"></div>
                            <x-button :loading="$isLoading" color="yellow" size="sm"
                                x-on:click="$dispatch('toggle-edit-answer-modal')"
                                wire:click="$dispatch('setEditQuestion',{ answerRule: '{{ $question->id }}'})"
                                icon="i-ph-pen">{{ __('Edit :edit', ['edit' => __('Answer Rule')]) }}</x-button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{-- END ANSWER ASSESSMENT RULE --}}

        @if (in_array($rule->type, ['summation', 'calculation', 'summative', 'calculation-2']))
            {{-- INDICATOR ASSESSMENT RULE --}}
            <div class="p-6 bg-white rounded-lg sm:p-8">
                @foreach (range(0, $rule->max_indicator - 1) as $x)
                    <div class="pb-3 border-b last:border-b-0" :key="'indicator-'.$x">
                        <div class="flex">
                            <div
                                class="grid w-16 text-4xl font-bold pointer-events-none place-items-center text-primary-500">
                                @if ($rule->isAlphabetAnswer)
                                    {{ GeneralHelper::numberToAlpha($loop->iteration) }}
                                @else
                                    {{ $loop->iteration }}
                                @endif
                            </div>
                            <div class="flex-1 px-5 py-3 sm:px-9">
                                @php
                                    $indicator = $rule->indicators
                                        ->where(
                                            'answer',
                                            $rule->isAlphabetAnswer
                                                ? GeneralHelper::numberToAlpha($loop->iteration)
                                                : $loop->iteration,
                                        )
                                        ->first();
                                @endphp
                                @if ($indicator)
                                    <div class="space-y-3 sm:space-y-4">
                                        <div>
                                            <div class="font-semibold">
                                                {{ __('Title') }}
                                            </div>
                                            <div>
                                                {{ $indicator->title ?: __('No title set') }}
                                            </div>
                                        </div>
                                        @if (in_array($rule->type, ['summative', 'calculation-2']))
                                            <div>
                                                <div class="font-semibold">
                                                    {{ __('Min') }}
                                                </div>
                                                <div>
                                                    {{ $indicator->value_min }}
                                                </div>
                                            </div>
                                            <div>
                                                <div class="font-semibold">
                                                    {{ __('Max') }}
                                                </div>
                                                <div>
                                                    {{ $indicator->value_max }}
                                                </div>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="font-semibold">
                                                {{ __('Indicator') }}
                                            </div>
                                            <div class="trix-zone">
                                                {!! $indicator->indicator !!}
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-semibold">
                                                {{ __('Recommendation') }}
                                            </div>
                                            <div class="trix-zone">
                                                {!! $indicator->recommendation !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="my-3 border-b"></div>
                                    <div class="flex gap-1">
                                        <x-button :loading="$isLoading" color="yellow" size="sm"
                                            x-on:click="$dispatch('toggle-edit-indicator-modal')"
                                            wire:click="$dispatch('setEditIndicator',{ indicatorRule: '{{ $indicator->id }}'})"
                                            icon="i-ph-pen">{{ __('Edit :edit', ['edit' => __('Indicator Rule')]) }}</x-button>
                                        {{-- <x-button :loading="$isLoading" color="red" size="sm"
                                        wire:click="deleteIndicator({{ $indicator->id }})"
                                        icon="i-ph-trash">{{ __('Delete :delete', ['delete' => __('Indicator Rule')]) }}</x-button> --}}
                                    </div>
                                @else
                                    <div class="flex flex-col items-start self-center flex-1 gap-1">
                                        {{ __('No indicator rules added yet') }}
                                        <x-button :loading="$isLoading" color="primary" size="sm"
                                            x-on:click="$dispatch('toggle-add-indicator-modal')"
                                            wire:click="$dispatch('setAddIndicator',{ rule: '{{ $rule->id }}', 'answer': '{{ $rule->isAlphabetAnswer ? GeneralHelper::numberToAlpha($loop->iteration) : $loop->iteration }}'})"
                                            icon="i-ph-plus">{{ __('Add :add', ['add' => __('Indicator Rule')]) }}</x-button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- END ANSWER ASSESSMENT RULE --}}
        @endif
    @else
        <div class="p-6 text-center bg-white rounded-lg sm:p-8">
            {{ __('Save the assessment rule first to configure the assessment rule') }}
        </div>
    @endif
</div>
