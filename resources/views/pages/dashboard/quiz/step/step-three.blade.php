<div>
    <div class="flex flex-col items-start gap-4 lg:flex-row">
        {{-- SIDEBAR --}}
        <div class="w-full lg:max-w-[380px] 2xl:max-w-[450px]">
            <div class="p-6 mb-4 rounded-lg shadow-md bg-primary-500 sm:p-8 dark:bg-slate-800">
                <div class="pb-3 mb-3 border-b">
                    <div class="text-xl font-bold text-secondary-500">
                        {{ $quiz->name }}
                    </div>
                    <div class="text-sm font-light text-white">
                        {{ $quiz->escription }}
                    </div>
                </div>
                <div class="mb-5">
                    <div class="pb-3 mb-3 border-b">
                        <div class="flex items-center gap-1 text-sm text-white">
                            <span class="i-ph-line-segments-light"></span>
                            <div class="flex-1 font-light truncate">
                                {{ __($selectedQuizPhase) }}
                            </div>
                        </div>
                        <div class="flex items-center gap-1 text-sm text-white">
                            <span class="i-ph-stack-simple-light"></span>
                            <div class="flex-1 font-light truncate">
                                {{ __($selectedQuizCategory) }}
                            </div>
                        </div>
                        <div class="flex items-center gap-1 text-sm text-white">
                            <span class="i-ph-folder"></span>
                            <div class="flex-1 font-light truncate">
                                {{ __(Str::headline($quiz->type)) }}
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-1 text-sm text-white">
                        <span class="i-ph-folder"></span>
                        <div class="flex-1 font-light truncate">
                            {{ __(Str::headline($quiz->assessmentRule->question_type)) }}
                        </div>
                    </div>
                    <div class="flex items-center gap-1 text-sm text-white">
                        <span class="i-ph-folder"></span>
                        <div class="flex-1 font-light truncate">
                            {{ __(Str::headline($quiz->assessmentRule->typeName)) }}
                        </div>
                    </div>
                </div>
                <div class="flex flex-col items-stretch gap-3 lg:items-center lg:flex-row">
                    <x-button size="sm" color="secondary" icon="i-ph-plus"
                        x-on:click="$dispatch('toggle-add-group-modal')"
                        wire:click="$dispatch('setAddGroup',{ quiz: '{{ $quiz->slug }}'})">
                        {{ __('Add :add', ['add' => __(':group Group', ['group' => __('Question')])]) }}
                    </x-button>
                </div>
            </div>
            {{-- QUIZ GROUP --}}
            <div class="mb-4 overflow-hidden bg-white rounded-lg shadow-md">
                <ul x-data="{
                    groupActive: '',
                    handle: (item, position, last) => {
                        $wire.reorderQuizGroup(item, position);
                    }
                }" x-sort.ghost="handle" x-sort:group="groups">
                    @foreach ($quiz->groups as $group)
                        <x-quiz.question-group :key="$group->id" :$group />
                    @endforeach
                </ul>
            </div>
            {{-- END QUIZ GROUP --}}
        </div>
        {{-- END SIDEBAR --}}

        {{-- CONTENT --}}
        <div class="flex-1">
            <x-quiz.active-group :$activeGroup />
        </div>
        {{-- END CONTENT --}}
    </div>

    <template x-teleport="body">
        <div wire:ignore>
            <x-modal name="add-group-modal" size="xl" :modalTitle="__('Add :add', ['add' => __('Group')])">
                <livewire:dashboard.quiz.step.additional.add-group :$quiz />
            </x-modal>
            <x-modal name="add-question-modal" size="4xl" :modalTitle="__('Add :add', ['add' => __('Question')])">
                <livewire:dashboard.quiz.step.additional.add-question :$quiz />
            </x-modal>
            <x-modal name="edit-group-modal" size="xl" :modalTitle="__('Edit :edit', ['edit' => __('Group')])">
                <livewire:dashboard.quiz.step.additional.edit-group :$quiz />
            </x-modal>
            <x-modal name="edit-question-modal" size="4xl" :modalTitle="__('Edit :edit', ['edit' => __('Question')])">
                <livewire:dashboard.quiz.step.additional.edit-question :$quiz />
            </x-modal>
            <x-modal name="delete-group-modal" size="xl" :modalTitle="__('Delete :delete', ['delete' => __('Group')])">
                <livewire:dashboard.quiz.step.additional.delete-group :$quiz />
            </x-modal>
            <x-modal name="delete-question-modal" size="xl" :modalTitle="__('Delete :delete', ['delete' => __('Question')])">
                <livewire:dashboard.quiz.step.additional.delete-question :$quiz />
            </x-modal>
        </div>
    </template>
</div>
