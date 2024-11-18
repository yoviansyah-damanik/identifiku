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

        <ul x-data="{
            handle: (item, position, last) => {
                $wire.reorderQuestionGroup(item, position);
            }
        }" x-sort.ghost="handle" x-sort:group="questions" class="space-y-3 sm:space-y-4">
            @foreach ($activeGroup->questions as $question)
                <livewire:dashboard.quiz.step.additional.question :key="$question->id" :$question />
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
