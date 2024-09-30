<x-content>
    <x-content.title :title="__('Quiz Phase')" :description="__('Manage quiz phases.')" />

    <div class="box-border flex w-full gap-3 overflow-x-auto overflow-y-hidden snap-proximity snap-x">
        <x-button color="primary" icon="i-ph-plus" x-on:click="$dispatch('toggle-create-quiz-phase-modal')">
            {{ __('Add :add', ['add' => __('Quiz Phase')]) }}
        </x-button>
        <x-form.select class="snap-start" :items="$perPageList" wire:model.live='perPage' />
        <x-form.input class="flex-1 min-w-48 snap-start" type="search" :placeholder="__('Search by :1', ['1' => __(':name Name', ['name' => __('Quiz Phase')])])" block
            wire:model.live.debounce.750ms='search' />
    </div>

    <x-table :columns="[
        '#',
        __(':name Name', ['name' => __('Quiz Phase')]),
        __('Description'),
        __('Grade Levels'),
        __('Number of :subject', ['subject' => __('quizzes')]),
        __('Action'),
    ]">
        <x-slot name="body">
            @forelse ($quizPhases as $quizPhase)
                <x-table.tr>
                    <x-table.td class="w-16" centered>
                        {{ $quizPhases->perPage() * ($quizPhases->currentPage() - 1) + $loop->iteration }}
                    </x-table.td>
                    <x-table.td>
                        {{ $quizPhase->name }}
                    </x-table.td>
                    <x-table.td>
                        {{ $quizPhase->description }}
                    </x-table.td>
                    <x-table.td>
                        {{ $quizPhase->grades->pluck('name')->join(', ') }}
                    </x-table.td>
                    <x-table.td centered>
                        {{ GeneralHelper::numberFormat($quizPhase->quizzes_count) .
                            ' ' .
                            ($quizPhase->quizzes_count > 1 ? __('quizzes') : __('Quiz')) }}
                    </x-table.td>
                    <x-table.td centered>
                        <x-tooltip :title="__('Edit')">
                            <x-button color="yellow" icon="i-ph-pen" size="sm"
                                wire:click="$dispatch('setEditQuizPhase',{ quizPhase: '{{ $quizPhase->id }}' })"
                                x-on:click="$dispatch('toggle-edit-quiz-phase-modal')">
                            </x-button>
                        </x-tooltip>
                        <x-tooltip :title="__('Delete')">
                            <x-button color="red" icon="i-ph-trash" size="sm"
                                wire:click="$dispatch('setDeleteQuizPhase',{ quizPhase: '{{ $quizPhase->id }}' })"
                                x-on:click="$dispatch('toggle-delete-quiz-phase-modal')">
                            </x-button>
                        </x-tooltip>
                    </x-table.td>
                </x-table.tr>
            @empty
                <x-table.tr>
                    <x-table.td colspan="5">
                        <x-no-data />
                    </x-table.td>
                </x-table.tr>
            @endforelse
        </x-slot>

        <x-slot name="paginate">
            {{ $quizPhases->links(data: ['scrollTo' => 'table']) }}
        </x-slot>
    </x-table>

    <div wire:ignore>
        <x-modal name="create-quiz-phase-modal" size="xl" :modalTitle="__('Add :add', ['add' => __('Quiz Phase')])">
            <livewire:dashboard.quiz-phase.create :$gradeLevels />
        </x-modal>
        <x-modal name="edit-quiz-phase-modal" size="xl" :modalTitle="__('Edit :edit', ['edit' => __('Quiz Phase')])">
            <livewire:dashboard.quiz-phase.edit :$gradeLevels />
        </x-modal>
        <x-modal name="delete-quiz-phase-modal" size="xl" :modalTitle="__('Delete :delete', ['delete' => __('Quiz Phase')])">
            <livewire:dashboard.quiz-phase.delete />
        </x-modal>
    </div>
</x-content>
