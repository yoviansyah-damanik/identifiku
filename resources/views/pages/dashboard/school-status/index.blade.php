<x-content>
    <x-content.title :title="__('School Status')" :description="__('Manage :manage.', ['manage' => __('School Status')])" />

    <div class="box-border flex w-full gap-3 overflow-x-auto overflow-y-hidden snap-proximity snap-x">
        <x-button color="primary" base="snap-start" icon="i-ph-plus"
            x-on:click="$dispatch('toggle-create-school-status-modal')">
            {{ __('Add :add', ['add' => __('School Status')]) }}
        </x-button>
        <x-form.select class="snap-start" :items="$perPageList" wire:model.live='perPage' />
        <x-form.input class="flex-1 min-w-48 snap-start" type="search" :placeholder="__('Search by :1', ['1' => __(':name Name', ['name' => __('School Status')])])" block
            wire:model.live.debounce.750ms='search' />
    </div>

    <x-table :columns="[
        '#',
        __(':name Name', ['name' => __('School Status')]),
        __('Description'),
        __('Number of :subject', ['subject' => __('Schools')]),
        __('Number of :subject', ['subject' => __('Students')]),
        __('Action'),
    ]" :hasPages="$schoolStatuses->hasPages()">
        <x-slot name="body">
            @forelse ($schoolStatuses as $schoolStatus)
                <x-table.tr>
                    <x-table.td class="w-16" centered>
                        {{ $schoolStatuses->perPage() * ($schoolStatuses->currentPage() - 1) + $loop->iteration }}
                    </x-table.td>
                    <x-table.td>
                        {{ $schoolStatus->name }}
                    </x-table.td>
                    <x-table.td>
                        {{ $schoolStatus->description }}
                    </x-table.td>
                    <x-table.td centered>
                        {{ GeneralHelper::numberFormat($schoolStatus->schools_count) .
                            ' ' .
                            ($schoolStatus->schools_count > 1 ? __('Schools') : __('School')) }}
                    </x-table.td>
                    <x-table.td centered>
                        {{ GeneralHelper::numberFormat($schoolStatus->schools->sum('students_count')) .
                            ' ' .
                            ($schoolStatus->schools->sum('students_count') > 1 ? __('Students') : __('Student')) }}
                    </x-table.td>
                    <x-table.td centered>
                        <x-tooltip :title="__('Edit')">
                            <x-button color="yellow" icon="i-ph-pen" size="sm"
                                wire:click="$dispatch('setEditSchoolStatus',{ schoolStatus: '{{ $schoolStatus->id }}' })"
                                x-on:click="$dispatch('toggle-edit-school-status-modal')">
                            </x-button>
                        </x-tooltip>
                        <x-tooltip :title="__('Delete')">
                            <x-button color="red" icon="i-ph-trash" size="sm"
                                wire:click="$dispatch('setDeleteSchoolStatus',{ schoolStatus: '{{ $schoolStatus->id }}' })"
                                x-on:click="$dispatch('toggle-delete-school-status-modal')">
                            </x-button>
                        </x-tooltip>
                    </x-table.td>
                </x-table.tr>
            @empty
                <x-table.tr>
                    <x-table.td colspan="6">
                        <x-no-data />
                    </x-table.td>
                </x-table.tr>
            @endforelse
        </x-slot>

        <x-slot name="paginate">
            {{ $schoolStatuses->links(data: ['scrollTo' => 'table']) }}
        </x-slot>
    </x-table>

    <template x-teleport="body">
        <div wire:ignore>
            <x-modal name="create-school-status-modal" size="xl" :modalTitle="__('Add :add', ['add' => __('School Status')])">
                <livewire:dashboard.school-status.create />
            </x-modal>
            <x-modal name="edit-school-status-modal" size="xl" :modalTitle="__('Edit :edit', ['edit' => __('School Status')])">
                <livewire:dashboard.school-status.edit />
            </x-modal>
            <x-modal name="delete-school-status-modal" size="xl" :modalTitle="__('Delete :delete', ['delete' => __('School Status')])">
                <livewire:dashboard.school-status.delete />
            </x-modal>
        </div>
    </template>
</x-content>
