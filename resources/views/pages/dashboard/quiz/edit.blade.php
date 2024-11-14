<x-content>
    <ol
        class="flex flex-col justify-around overflow-hidden text-sm font-medium text-center text-gray-500 bg-white border border-gray-200 rounded-lg shadow lg:items-center lg:flex-row dark:text-gray-400 sm:text-base dark:bg-gray-800 dark:border-gray-700 rtl:space-x-reverse">
        @foreach ($steps as $item)
            <li wire:click="setStep({{ $item['step'] }})" @class([
                'flex items-center justify-center flex-1 p-4 cursor-pointer',
                'bg-primary-500 text-primary-100' => $item['step'] == $step,
            ])>
                <div @class([
                    'flex items-center justify-center w-8 h-8 text-xs rounded-full me-2 shrink-0 bg-gray-500 text-gray-100',
                    '!bg-green-500 !text-green-100' => $step > $item['step'],
                    '!bg-secondary-500 !text-secondary-100' => $item['step'] == $step,
                ])>
                    @if ($item['step'] > $step)
                        {{ $item['step'] }}
                    @elseif($item['step'] == $step)
                        <span class="i-ph-person-simple-run"></span>
                    @else
                        <span class="i-ph-check"></span>
                    @endif
                </div>
                <div class="text-start">
                    <div @class([
                        'text-gray-500 font-bold',
                        'text-green-600 dark:text-green-500' => $step > $item['step'],
                        'text-secondary-600 dark:text-secondary-500' => $item['step'] == $step,
                    ])>
                        {{ $item['title'] }}
                    </div>
                    <div class="hidden text-sm font-light lg:block">
                        {{ $item['description'] }}
                    </div>
                </div>
            </li>
        @endforeach
    </ol>

    @if ($step == 1)
        <div wire:key="step-1"
            class="flex flex-col max-w-screen-xl gap-6 p-6 mx-auto bg-white rounded-lg sm:p-8 lg:flex-row sm:gap-8">
            <div class="flex-1 space-y-3 sm:space-y-4">
                <x-form.input :loading="$isLoading" :label="__(':name Name', ['name' => __('Quiz')])" :placeholder="__('Entry :entry', ['entry' => __(':name Name', ['name' => __('Quiz')])])" block type="text"
                    wire:model="quizName" :error="$errors->first('quizName')" required />
                <x-form.select :loading="$isLoading" :label="__(':type Type', ['type' => __('Quiz')])" block :items="$quizTypes" wire:model="quizType"
                    :error="$errors->first('quizType')" required />
                <x-form.select :loading="$isLoading" :label="__(':type Type', ['type' => __('Quiz Category')])" block :items="$quizCategories" wire:model="quizCategory"
                    :error="$errors->first('quizCategory')" required />
                <x-form.select :loading="$isLoading" :label="__(':type Type', ['type' => __('Quiz Phase')])" block :items="$quizPhases" wire:model="quizPhase"
                    :error="$errors->first('quizPhase')" required />
                <x-form.input :loading="$isLoading" :label="__('Estimation Time')" :placeholder="__('Entry :entry', ['entry' => __('Estimation Time')]) . ' (' . __('Minute') . ')'" block type="number"
                    wire:model="estimationTime" :error="$errors->first('estimationTime')" required />
            </div>
            <div class="flex-1 space-y-3 sm:space-y-4">
                <x-form.textarea :loading="$isLoading" limit="250" :label="__('Overview')" :placeholder="__('Entry :entry', ['entry' => __('Overview')])" block
                    wire:model="overview" :error="$errors->first('overview')" required />
                <x-form.textarea :loading="$isLoading" limit="250" :label="__('Content Coverage')" :placeholder="__('Entry :entry', ['entry' => __('Content Coverage')])" block
                    wire:model="contentCoverage" :error="$errors->first('contentCoverage')" required />
                <x-form.textarea :loading="$isLoading" limit="250" :label="__('Assessment Objectives')" :placeholder="__('Entry :entry', ['entry' => __('Assessment Objectives')])" block
                    wire:model="assessmentObjectives" :error="$errors->first('assessmentObjectives')" required />
                <div class="text-end !mt-9">
                    <x-button color="primary" wire:click="saveQuiz">
                        {{ __('Save') }}
                    </x-button>
                </div>
            </div>
        </div>
    @endif
    @if ($step == 2)
        <div wire:key="step-2">
            <div class="flex flex-col items-start gap-4 lg:flex-row">
                {{-- SIDEBAR --}}
                <div class="w-auto lg:w-full lg:max-w-[380px] 2xl:max-w-[450px]">
                    <div class="p-6 mb-4 rounded-lg shadow-md bg-primary-500 sm:p-8 dark:bg-slate-800">
                        <div class="pb-3 mb-3 border-b">
                            <div class="text-xl font-bold text-secondary-500">
                                {{ $quizName }}
                            </div>
                            <div class="text-sm font-light text-white">
                                {{ $quizDescription }}
                            </div>
                        </div>
                        <div class="mb-5">
                            <div class="flex items-center gap-1 text-sm text-white">
                                <span class="i-ph-line-segments-light"></span>
                                <div class="flex-1 font-light truncate">
                                    {{ __($selectedQuizPhase->name) }}
                                </div>
                            </div>
                            <div class="flex items-center gap-1 text-sm text-white">
                                <span class="i-ph-stack-simple-light"></span>
                                <div class="flex-1 font-light truncate">
                                    {{ __($selectedQuizCategory->name) }}
                                </div>
                            </div>
                            <div class="flex items-center gap-1 text-sm text-white">
                                <span class="i-ph-folder"></span>
                                <div class="flex-1 font-light truncate">
                                    {{ __(Str::headline($quizType)) }}
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col items-stretch gap-3 lg:items-center lg:flex-row">
                            <x-button size="sm" color="secondary" icon="i-ph-plus"
                                x-on:click="$dispatch('toggle-add-type-modal')" wire:click="$dispatch('setAddType')">
                                {{ __('Add :add', ['add' => __(':type Type', ['type' => __('Question')])]) }}
                            </x-button>
                        </div>
                    </div>
                    {{-- QUIZ TYPE --}}
                    <div class="mb-4 overflow-hidden bg-white rounded-lg shadow-md">
                        <ul x-data="{
                            typeActive: '',
                            handle: (item, position, last) => {
                                $wire.reorderQuizType(item, position);
                                console.log(item, position);
                            }
                            {{-- handle: (item, position, last) => { console.log(item, position, last) } --}}
                        }" x-sort.ghost="handle" x-sort:group="types">
                            @foreach ($quiz->types as $type)
                                <livewire:dashboard.quiz.content.question-type :key="$type->id" :$type />
                            @endforeach
                        </ul>
                    </div>
                    {{-- END QUIZ TYPE --}}
                </div>
                {{-- END SIDEBAR --}}

                {{-- CONTENT --}}
                <div class="flex-1">
                    <ol class="list-decimal">
                        {{-- @foreach ($types as $type)
                            <li>
                                {{ $type['name'] }}.{{ $type['order'] }}
                                @if (!empty($type['groups']))
                                    <ol class="list-disc">
                                        @foreach ($type['groups'] as $group)
                                            <li>{{ $group['name'] }}</li>
                                        @endforeach
                                    </ol>
                                @endif
                            </li>
                        @endforeach --}}
                    </ol>
                    {{-- @if ($types->count() > 0)
                        <div class="sticky top-0 p-6 mb-4 rounded-lg shadow-md bg-primary-500 sm:p-8 dark:bg-slate-800">
                            <div class="flex flex-col items-stretch gap-3 lg:items-center lg:flex-row">
                                <x-tooltip :title="__('Choose the question type first.')">
                                    <x-button color="secondary" icon="i-ph-plus" :loading="true"
                                        x-on:click="$dispatch('toggle-add-group-modal')">
                                        {{ __('Add :add', ['add' => __('Group')]) }}
                                    </x-button>
                                </x-tooltip>
                                <x-tooltip :title="__('Choose the question group first.')">
                                    <x-button color="secondary" icon="i-ph-plus" :loading="true"
                                        x-on:click="$dispatch('toggle-add-question-modal')"
                                        wire:click="$dispatch('setAddQuestion',{ group: '{{ $groupActive }}' })">
                                        {{ __('Add :add', ['add' => __('Question')]) }}
                                    </x-button>
                                </x-tooltip>
                            </div>
                        </div>
                    @else
                        <x-no-data />
                    @endif --}}
                </div>
                {{-- END CONTENT --}}
            </div>
        </div>
    @endif
    @if ($step == 3)
    @endif
    @if ($step == 4)
    @endif

    <div wire:ignore>
        <x-modal name="add-type-modal" size="xl" :modalTitle="__('Add :add', ['add' => __('Type')])">
            <livewire:dashboard.quiz.content.add-type :$quiz />
        </x-modal>
        <x-modal name="add-group-modal" size="xl" :modalTitle="__('Add :add', ['add' => __('Group')])">
            <livewire:dashboard.quiz.content.add-group />
        </x-modal>
        <x-modal name="add-question-modal" size="xl" :modalTitle="__('Add :add', ['add' => __('Question')])">
            <livewire:dashboard.quiz.content.add-question />
        </x-modal>
        <x-modal name="edit-type-modal" size="xl" :modalTitle="__('Edit :edit', ['edit' => __('Type')])">
            <livewire:dashboard.quiz.content.edit-type :$quiz />
        </x-modal>
        <x-modal name="edit-group-modal" size="xl" :modalTitle="__('Edit :edit', ['edit' => __('Group')])">
            <livewire:dashboard.quiz.content.edit-group />
        </x-modal>
        <x-modal name="edit-question-modal" size="xl" :modalTitle="__('Edit :edit', ['edit' => __('Question')])">
            <livewire:dashboard.quiz.content.edit-question />
        </x-modal>
    </div>
</x-content>

@push('scripts')
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/sort@3.x.x/dist/cdn.min.js"></script>
@endpush
