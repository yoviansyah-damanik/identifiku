<div class="space-y-3 sm:space-y-4">
    @if ($activeGroup)
        <div class="p-6 mb-4 rounded-lg shadow-md bg-primary-500 sm:p-8 dark:bg-slate-800">
            <div class="text-xl font-bold text-secondary-500">
                {{ $activeGroup->name }}
            </div>
            <div class="text-sm font-light text-white">
                {{ $activeGroup->description }}
            </div>
        </div>
        @if (in_array($this->quiz->assessmentRule->type, ['group-calculation']))
            <div class="p-6 mb-4 bg-white rounded-lg shadow-md sm:p-8 dark:bg-slate-800">
                @php
                    $indicator = $this->quiz->assessmentRule->indicators->where('answer', $activeGroup['id'])->first();
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
                        @if (in_array($this->quiz->assessmentRule->type, ['summative', 'calculation-2']))
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
                        <x-button color="yellow" size="sm" x-on:click="$dispatch('toggle-edit-indicator-modal')"
                            wire:click="$dispatch('setEditIndicator',{ indicatorRule: '{{ $indicator->id }}'})"
                            icon="i-ph-pen">{{ __('Edit :edit', ['edit' => __('Indicator Rule')]) }}</x-button>
                        {{-- <x-button color="red" size="sm" wire:click="deleteIndicator({{ $indicator->id }})"
                            icon="i-ph-trash">{{ __('Delete :delete', ['delete' => __('Indicator Rule')]) }}</x-button> --}}
                    </div>
                @else
                    <div class="flex flex-col items-start self-center flex-1 gap-1">
                        {{ __('No indicator rules added yet') }}
                        <x-button color="primary" size="sm" x-on:click="$dispatch('toggle-add-indicator-modal')"
                            wire:click="$dispatch('setAddIndicator',{ rule: '{{ $this->quiz->assessmentRule->id }}', 'answer': '{{ $activeGroup['id'] }}'})"
                            icon="i-ph-plus">{{ __('Add :add', ['add' => __('Indicator Rule')]) }}</x-button>
                    </div>
                @endif
            </div>
        @endif

        <ul x-data="{
            handle: (item, position, last) => {
                $wire.reorderQuestion(item, position, '{{ $activeGroup->id }}');
            }
        }" x-sort.ghost="handle" x-sort:group="questions" class="space-y-3 sm:space-y-4">
            @foreach ($activeGroup->questions as $question)
                <x-quiz.question :key="$question->id" :$question />
            @endforeach
        </ul>

        <x-button block color="secondary" x-on:click="$dispatch('toggle-add-question-modal')"
            wire:click="$dispatch('setAddQuestion', { group: '{{ $activeGroup->id }}'})">
            {{ __('Add :add', ['add' => __('Question')]) }}
        </x-button>
    @else
        <div class="text-center">
            {{ __('Please select the question group first') }}
        </div>
    @endif
</div>
