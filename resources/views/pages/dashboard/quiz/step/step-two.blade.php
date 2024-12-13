<div>
    <div class="flex flex-col items-stretch gap-3 mx-auto mb-4 lg:items-start lg:flex-row sm:gap-4">
        {{-- FORM --}}
        <livewire:dashboard.quiz.step.additional.quiz-type-form :$quiz />
        {{-- END FORM --}}

        {{-- RULES --}}
        <livewire:dashboard.quiz.step.additional.rules-form :rule="$quiz->assessmentRule" />
        {{-- END RULES --}}
    </div>

    <template x-teleport="body">
        <div wire:ignore>
            <x-modal name="add-indicator-modal" size="3xl" :modalTitle="__('Add :add', ['add' => __('Indicator Rule')])">
                <livewire:dashboard.quiz.step.additional.add-indicator-rule />
            </x-modal>
            <x-modal name="edit-indicator-modal" size="3xl" :modalTitle="__('Edit :edit', ['edit' => __('Indicator Rule')])">
                <livewire:dashboard.quiz.step.additional.edit-indicator-rule />
            </x-modal>
            <x-modal name="add-answer-modal" size="3xl" :modalTitle="__('Add :add', ['add' => __('Answer Rule')])">
                <livewire:dashboard.quiz.step.additional.add-answer-rule />
            </x-modal>
            <x-modal name="edit-answer-modal" size="3xl" :modalTitle="__('Edit :edit', ['edit' => __('Answer Rule')])">
                <livewire:dashboard.quiz.step.additional.edit-answer-rule />
            </x-modal>
        </div>
    </template>
</div>
