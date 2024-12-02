<x-content>
    <x-content.title :title="__('Region')" :description="__('Manage :manage.', ['manage' => __('Region')])" />

    <div class="box-border flex w-full gap-3 overflow-x-auto overflow-y-hidden snap-proximity snap-x">
        <x-button base="snap-start" color="primary" icon="i-ph-plus" x-on:click="$dispatch('toggle-create-region-modal')">
            {{ __('Add :add', ['add' => __('Region')]) }}
        </x-button>
        <x-form.select class="snap-start" :items="$perPageList" wire:model.live='perPage' />
        <x-form.input class="flex-1 min-w-48 snap-start" type="search" :placeholder="__('Search by :1', ['1' => __(':name Name', ['name' => __('Region')])])" block
            wire:model.live.debounce.750ms='search' />
    </div>

    <x-table :hasPages="$regions->hasPages()" :columns="[
        '#',
        __('Code'),
        __(':name Name', ['name' => __('Region')]),
        __('Number of :subject', ['subject' => __('Schools')]),
        __('Action'),
    ]">
        <x-slot name="body">
            @forelse ($regions as $region)
                <x-table.tr>
                    <x-table.td class="w-16" centered>
                        {{ $regions->perPage() * ($regions->currentPage() - 1) + $loop->iteration }}
                    </x-table.td>
                    <x-table.td>
                        {{ $region->code }}
                    </x-table.td>
                    <x-table.td>
                        {{ $region->name }}
                    </x-table.td>
                    <x-table.td centered>
                        {{ GeneralHelper::numberFormat($region->schoolCount) .
                            ' ' .
                            ($region->schoolCount > 1 ? __('Schools') : __('School')) }}
                    </x-table.td>
                    <x-table.td centered>
                        <x-tooltip :title="__('Edit')">
                            <x-button color="yellow" icon="i-ph-pen" size="sm"
                                wire:click="$dispatch('setEditRegion',{ region: '{{ $region->code }}' })"
                                x-on:click="$dispatch('toggle-edit-region-modal')">
                            </x-button>
                        </x-tooltip>
                        <x-tooltip :title="__('Delete')">
                            <x-button color="red" icon="i-ph-trash" size="sm"
                                wire:click="$dispatch('setDeleteRegion',{ region: '{{ $region->code }}' })"
                                x-on:click="$dispatch('toggle-delete-region-modal')">
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
            {{ $regions->links(data: ['scrollTo' => 'table']) }}
        </x-slot>
    </x-table>

    <template x-teleport="body">
        <div wire:ignore>
            <x-modal name="create-region-modal" size="xl" :modalTitle="__('Add :add', ['add' => __('Region')])">
                <livewire:dashboard.region.create />
            </x-modal>
            <x-modal name="edit-region-modal" size="xl" :modalTitle="__('Edit :edit', ['edit' => __('Region')])">
                <livewire:dashboard.region.edit />
            </x-modal>
            <x-modal name="delete-region-modal" size="xl" :modalTitle="__('Delete :delete', ['delete' => __('Region')])">
                <livewire:dashboard.region.delete />
            </x-modal>
        </div>
    </template>
</x-content>
