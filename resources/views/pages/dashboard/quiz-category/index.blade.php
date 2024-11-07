<x-content>
    <x-content.title :title="__('Quiz Category')" :description="__('Manage :manage.', ['manage' => __('Quiz Category')])" />

    <div class="box-border flex w-full gap-3 overflow-x-auto overflow-y-hidden snap-proximity snap-x">
        <x-button color="primary" icon="i-ph-plus" x-on:click="$dispatch('toggle-create-quiz-category-modal')">
            {{ __('Add :add', ['add' => __('Quiz Category')]) }}
        </x-button>
        <x-form.select class="snap-start" :items="$perPageList" wire:model.live='perPage' />
        <x-form.input class="flex-1 min-w-48 snap-start" type="search" :placeholder="__('Search by :1', ['1' => __(':name Name', ['name' => __('Quiz Category')])])" block
            wire:model.live.debounce.750ms='search' />
    </div>

    <x-table :columns="[
        '#',
        __(':name Name', ['name' => __('Quiz Category')]),
        __('Description'),
        __('Number of :subject', ['subject' => __('quizzes')]),
        __('Action'),
    ]">
        <x-slot name="body">
            @forelse ($quizCategories as $quizCategory)
                <x-table.tr>
                    <x-table.td class="w-16" centered>
                        {{ $quizCategories->perPage() * ($quizCategories->currentPage() - 1) + $loop->iteration }}
                    </x-table.td>
                    <x-table.td>
                        {{ $quizCategory->name }}
                    </x-table.td>
                    <x-table.td>
                        {{ $quizCategory->description }}
                    </x-table.td>
                    <x-table.td centered>
                        {{ GeneralHelper::numberFormat($quizCategory->quizzes_count) .
                            ' ' .
                            ($quizCategory->quizzes_count > 1 ? __('quizzes') : __('Quiz')) }}
                    </x-table.td>
                    <x-table.td centered>
                        <x-tooltip :title="__('Edit')">
                            <x-button color="yellow" icon="i-ph-pen" size="sm"
                                wire:click="$dispatch('setEditQuizCategory',{ quizCategory: '{{ $quizCategory->id }}' })"
                                x-on:click="$dispatch('toggle-edit-quiz-category-modal')">
                            </x-button>
                        </x-tooltip>
                        <x-tooltip :title="__('Delete')">
                            <x-button color="red" icon="i-ph-trash" size="sm"
                                wire:click="$dispatch('setDeleteQuizCategory',{ quizCategory: '{{ $quizCategory->id }}' })"
                                x-on:click="$dispatch('toggle-delete-quiz-category-modal')">
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
            {{ $quizCategories->links(data: ['scrollTo' => 'table']) }}
        </x-slot>
    </x-table>

    <div wire:ignore>
        <x-modal name="create-quiz-category-modal" size="xl" :modalTitle="__('Add :add', ['add' => __('Quiz Category')])">
            <livewire:dashboard.quiz-category.create />
        </x-modal>
        <x-modal name="edit-quiz-category-modal" size="xl" :modalTitle="__('Edit :edit', ['edit' => __('Quiz Category')])">
            <livewire:dashboard.quiz-category.edit />
        </x-modal>
        <x-modal name="delete-quiz-category-modal" size="xl" :modalTitle="__('Delete :delete', ['delete' => __('Quiz Category')])">
            <livewire:dashboard.quiz-category.delete />
        </x-modal>
    </div>
</x-content>
