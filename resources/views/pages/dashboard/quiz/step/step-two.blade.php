<div>
    <div class="flex flex-col-reverse items-stretch gap-3 mx-auto mb-4 lg:items-start lg:flex-row sm:gap-4">
        <div
            class="w-full lg:max-w-[520px] 2xl:max-w-[720px] space-y-3 sm:space-y-4 bg-white rounded-lg shadow p-6 sm:p-8">
            <x-form.select :loading="$isLoading" :label="__(':type Type', ['type' => __('Question')])" block :items="$questionTypes" wire:model.live="questionType"
                :error="$errors->first('questionType')" required />
            <x-form.select :loading="$isLoading" :label="__(':type Type', ['type' => __('Assessment Rule')])" block :items="$assessmentRules" wire:model.live="assessmentRule"
                :error="$errors->first('assessmentRule')" required />
            @if ($questionType != 'dichotomous' || ($questionType == 'dichotomous' && $assessmentRule == 'summative'))
                <x-form.input :label="__('Number of :subject', ['subject' => __('Indicator')])" type="number" block wire:model="max" :error="$errors->first('max')" required />
            @endif

            <div class="flex flex-col-reverse lg:flex-row items-end justify-between gap-3 !mt-7">
                @if ($quiz->assessmentRule)
                    <div class="text-sm italic">
                        *) {{ __('Changing the data above will delete all questions that have been created') }}
                    </div>
                @endif
                <x-button color="primary" wire:click="save">{{ __('Save') }}</x-button>
            </div>
        </div>
        <div class="flex-1 p-6 space-y-3 bg-white rounded-lg shadow sm:space-y-4 sm:p-8">
            @if ($quiz->assessmentRule)
                <div>
                    <div class="flex flex-col">
                        <div class="flex">
                            <div class="w-[12rem] font-semibold">
                                {{ __('Type') }}
                            </div>
                            <div class="flex-1">
                                {{ __(Str::headline($quiz->assessmentRule->type)) }}
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-[12rem] font-semibold">
                                {{ __(':type Type', ['type' => __('Question')]) }}
                            </div>
                            <div class="flex-1">
                                {{ __(Str::headline($quiz->assessmentRule->question_type)) }}
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-[12rem] font-semibold">
                                {{ __('Number of :subject', ['subject' => __('Indicator')]) }}
                            </div>
                            <div class="flex-1">
                                {{ __(Str::headline($quiz->assessmentRule->max_item)) }}
                            </div>
                        </div>
                    </div>
                </div>

                @foreach (range(0, $quiz->assessmentRule->max_item - 1) as $x)
                    <div class="pb-3 border-b" :key="'indicator-'.$x">
                        <div class="flex">
                            <div
                                class="grid w-16 text-4xl font-bold border-r pointer-events-none aspect-square place-items-center text-primary-300">
                                @if ($quiz->assessmentRule->isAlphabetAnswer)
                                    {{ GeneralHelper::numberToAlpha($loop->iteration) }}
                                @else
                                    {{ $loop->iteration }}
                                @endif
                            </div>
                            <div class="flex-1 py-3 px-9">
                                @php
                                    $detail = $quiz->assessmentRule->details
                                        ->where(
                                            'answer',
                                            $quiz->assessmentRule->isAlphabetAnswer
                                                ? GeneralHelper::numberToAlpha($loop->iteration)
                                                : $loop->iteration,
                                        )
                                        ->first();
                                @endphp
                                @if ($detail)
                                    <div class="space-y-3 sm:space-y-4">
                                        @if ($quiz->assessmentRule->type == 'summative')
                                            <div>
                                                <div class="font-semibold">
                                                    {{ __('Min') }}
                                                </div>
                                                <div class="">
                                                    {{ $detail->value_min }}
                                                </div>
                                            </div>
                                            <div>
                                                <div class="font-semibold">
                                                    {{ __('Max') }}
                                                </div>
                                                <div class="">
                                                    {{ $detail->value_max }}
                                                </div>
                                            </div>
                                        @else
                                            <div>
                                                <div class="font-semibold">
                                                    {{ __('Default') }}
                                                </div>
                                                <div class="">
                                                    {{ $detail->default ?? __('No default value set') }}
                                                </div>
                                            </div>
                                        @endif
                                        @if (in_array($quiz->assessmentRule->type, ['calculation-2', 'summative']))
                                            <div>
                                                <div class="font-semibold">
                                                    {{ __('Score') }}
                                                </div>
                                                <div class="">
                                                    {!! $detail->score !!}
                                                </div>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="font-semibold">
                                                {{ __('Indicator') }}
                                            </div>
                                            <div class="">
                                                {!! $detail->indicator !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="my-3 border-b"></div>
                                    <div class="flex gap-1">
                                        <x-button color="yellow" size="sm"
                                            x-on:click="$dispatch('toggle-edit-indicator-modal')"
                                            wire:click="$dispatch('setEditIndicator',{ detail: '{{ $detail->id }}'})"
                                            icon="i-ph-pen">{{ __('Edit :edit', ['edit' => __('Indicator')]) }}</x-button>
                                        <x-button color="red" size="sm"
                                            wire:click="deleteIndicator({{ $detail->id }})"
                                            icon="i-ph-trash">{{ __('Delete :delete', ['delete' => __('Indicator')]) }}</x-button>
                                    </div>
                                @else
                                    <div class="flex flex-col items-start self-center flex-1 gap-1">
                                        {{ __('No indicators added yet') }}
                                        <x-button color="primary" size="sm"
                                            x-on:click="$dispatch('toggle-add-indicator-modal')"
                                            wire:click="$dispatch('setAddIndicator',{ rule: '{{ $quiz->assessmentRule->id }}', 'answer': '{{ $quiz->assessmentRule->isAlphabetAnswer ? GeneralHelper::numberToAlpha($loop->iteration) : $loop->iteration }}'})"
                                            icon="i-ph-plus">{{ __('Add :add', ['add' => __('Indicator')]) }}</x-button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center">
                    {{ __('Save the assessment rule first to configure the assessment rule') }}
                </div>
            @endif
        </div>
    </div>

    <div wire:ignore>
        <x-modal name="add-indicator-modal" size="3xl" :modalTitle="__('Add :add', ['add' => __('Indicator')])">
            <livewire:dashboard.quiz.step.additional.add-indicator />
        </x-modal>
        <x-modal name="edit-indicator-modal" size="3xl" :modalTitle="__('Edit :edit', ['edit' => __('Indicator')])">
            <livewire:dashboard.quiz.step.additional.edit-indicator />
        </x-modal>
    </div>
</div>
