<div>
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
                            {{ __(Str::headline($quizType)) }}
                        </div>
                    </div>
                </div>
                <div class="flex flex-col items-stretch gap-3 lg:items-center lg:flex-row">
                    <x-button size="sm" color="secondary" icon="i-ph-plus"
                        x-on:click="$dispatch('toggle-group-type-modal')" wire:click="$dispatch('setGroupType')">
                        {{ __('Add :add', ['add' => __(':group Group', ['group' => __('Question')])]) }}
                    </x-button>
                </div>
            </div>
            {{-- QUIZ TYPE --}}
            <div class="mb-4 overflow-hidden bg-white rounded-lg shadow-md">
                <ul x-data="{
                    typeActive: '',
                    handle: (item, position, last) => {
                        $wire.reorderQuizType(item, position);
                        {{-- console.log(item, position); --}}
                    }
                }" x-sort.ghost="handle" x-sort:group="types">
                    {{-- @foreach ($types as $type) --}}
                    {{-- <livewire:dashboard.quiz.step.additional.question-type :key="$type->id" :$type /> --}}
                    {{-- @endforeach --}}
                </ul>
            </div>
            {{-- END QUIZ TYPE --}}
        </div>
        {{-- END SIDEBAR --}}

        {{-- CONTENT --}}
        <div class="flex-1">
            {{-- <livewire:dashboard.quiz.step.additional.active-type /> --}}
        </div>
        {{-- END CONTENT --}}
    </div>

    <div wire:ignore>
        <x-modal name="add-group-modal" size="xl" :modalTitle="__('Add :add', ['add' => __('Group')])">
            <livewire:dashboard.quiz.step.additional.add-group :$quiz />
        </x-modal>
        <x-modal name="add-question-modal" size="xl" :modalTitle="__('Add :add', ['add' => __('Question')])">
            <livewire:dashboard.quiz.step.additional.add-question />
        </x-modal>
        <x-modal name="edit-group-modal" size="xl" :modalTitle="__('Edit :edit', ['edit' => __('Group')])">
            <livewire:dashboard.quiz.step.additional.edit-group :$quiz />
        </x-modal>
        <x-modal name="edit-question-modal" size="xl" :modalTitle="__('Edit :edit', ['edit' => __('Question')])">
            <livewire:dashboard.quiz.step.additional.edit-question />
        </x-modal>
        <x-modal name="delete-group-modal" size="xl" :modalTitle="__('Delete :delete', ['delete' => __('Group')])">
            <livewire:dashboard.quiz.step.additional.delete-group :$quiz />
        </x-modal>
        <x-modal name="delete-question-modal" size="xl" :modalTitle="__('Delete :delete', ['delete' => __('Question')])">
            <livewire:dashboard.quiz.step.additional.delete-question />
        </x-modal>
    </div>
</div>
