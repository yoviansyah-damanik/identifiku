<x-content>
    <x-content.title :title="__('Education Level')" :description="__('Manage :manage.', ['manage' => __('Education Level')])" />

    <div class="box-border flex w-full gap-3 overflow-x-auto overflow-y-hidden snap-proximity snap-x">
        <x-button color="primary" icon="i-ph-plus" x-on:click="$dispatch('toggle-create-education-level-modal')">
            {{ __('Add :add', ['add' => __('Education Level')]) }}
        </x-button>
        <x-form.select class="snap-start" :items="$perPageList" wire:model.live='perPage' />
        <x-form.input class="flex-1 min-w-48 snap-start" type="search" :placeholder="__('Search by :1', ['1' => __(':name Name', ['name' => __('Education Level')])])" block
            wire:model.live.debounce.750ms='search' />
    </div>

    <x-table :columns="[
        '#',
        __(':name Name', ['name' => __('Education Level')]),
        __('Description'),
        __('Number of :subject', ['subject' => __('Grade Levels')]),
        __('Number of :subject', ['subject' => __('Schools')]),
        __('Number of :subject', ['subject' => __('Students')]),
        __('Action'),
    ]">
        <x-slot name="body">
            @forelse ($educationLevels as $educationLevel)
                <x-table.tr>
                    <x-table.td class="w-16" centered>
                        {{ $educationLevels->perPage() * ($educationLevels->currentPage() - 1) + $loop->iteration }}
                    </x-table.td>
                    <x-table.td>
                        {{ $educationLevel->name }}
                    </x-table.td>
                    <x-table.td>
                        {{ $educationLevel->description }}
                    </x-table.td>
                    <x-table.td centered>
                        {{ GeneralHelper::numberFormat($educationLevel->grades_count) .
                            ' ' .
                            ($educationLevel->grades_count > 1 ? __('Grade Levels') : __('Grade Level')) }}
                    </x-table.td>
                    <x-table.td centered>
                        {{ GeneralHelper::numberFormat($educationLevel->schools_count) .
                            ' ' .
                            ($educationLevel->schools_count > 1 ? __('Schools') : __('School')) }}
                    </x-table.td>
                    <x-table.td centered>
                        {{ GeneralHelper::numberFormat($educationLevel->grades->sum('students_count')) .
                            ' ' .
                            ($educationLevel->grades->sum('students_count') > 1 ? __('Students') : __('Student')) }}
                    </x-table.td>
                    <x-table.td centered>
                        <x-tooltip :title="__('Edit')">
                            <x-button color="yellow" icon="i-ph-pen" size="sm"
                                wire:click="$dispatch('setEditEducationLevel',{ educationLevel: '{{ $educationLevel->id }}' })"
                                x-on:click="$dispatch('toggle-edit-education-level-modal')">
                            </x-button>
                        </x-tooltip>
                        <x-tooltip :title="__('Delete')">
                            <x-button color="red" icon="i-ph-trash" size="sm"
                                wire:click="$dispatch('setDeleteEducationLevel',{ educationLevel: '{{ $educationLevel->id }}' })"
                                x-on:click="$dispatch('toggle-delete-education-level-modal')">
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
            {{ $educationLevels->links(data: ['scrollTo' => 'table']) }}
        </x-slot>
    </x-table>

    <div wire:ignore>
        <x-modal name="create-education-level-modal" size="xl" :modalTitle="__('Add :add', ['add' => __('Education Level')])">
            <livewire:dashboard.education-level.create />
        </x-modal>
        <x-modal name="edit-education-level-modal" size="xl" :modalTitle="__('Edit :edit', ['edit' => __('Education Level')])">
            <livewire:dashboard.education-level.edit />
        </x-modal>
        <x-modal name="delete-education-level-modal" size="xl" :modalTitle="__('Delete :delete', ['delete' => __('Education Level')])">
            <livewire:dashboard.education-level.delete />
        </x-modal>
    </div>
</x-content>
