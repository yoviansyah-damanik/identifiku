<x-content>
    <x-content.title :title="__('Add :add', ['add' => __('Quiz')])" :description="__(
        'You can add questions as needed to the quiz. The questions will be displayed and the student can complete the quiz. Each question has a weighted value that must be applied to get the appropriate result.',
    )" />

    <div class="sticky p-6 mb-4 bg-white rounded-lg sm:p-8 dark:bg-slate-800 top-12">
        <x-button color="primary" icon="i-ph-plus" :loading="true" x-on:click="$dispatch('toggle-add-group-modal')">
            {{ __('Add :add', ['add' => __('Group')]) }}
        </x-button>
        <x-button color="primary" icon="i-ph-plus" :loading="true" x-on:click="$dispatch('toggle-add-question-modal')"
            wire:click="$dispatch('setAddQuestion',{ group: '{{ $groupActive }}' })">
            {{ __('Add :add', ['add' => __('Question')]) }}
        </x-button>
    </div>

    @forelse ($groups as $group)
        <x-quiz-group :$group />
    @empty
        <x-no-data />
    @endforelse

    <div wire:ignore>
        <x-modal name="add-group-modal" size="xl" :modalTitle="__('Add :add', ['add' => __('Group')])">
            <livewire:dashboard.quiz.add-group />
        </x-modal>
        <x-modal name="add-group-modal" size="xl" :modalTitle="__('Add :add', ['add' => __('Group')])">
            <livewire:dashboard.quiz.add-group />
        </x-modal>
        <x-modal name="add-question-modal" size="xl" :modalTitle="__('Add :add', ['add' => __('Question')])">
            <livewire:dashboard.quiz.add-question />
        </x-modal>
    </div>
</x-content>
