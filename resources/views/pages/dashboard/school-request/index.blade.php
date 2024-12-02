<x-content>
    <x-content.title :title="__('School Request')" :description="__('Manage :manage.', ['manage' => __('School Request')])" />

    <div class="box-border flex w-full gap-3 overflow-x-auto overflow-y-hidden snap-proximity snap-x">
        <x-form.select class="snap-start" :items="$perPageList" wire:model.live='perPage' />
        <x-form.input class="flex-1 min-w-48 snap-start" type="search" :placeholder="__('Search by :1, :2, :3, or :4', [
            '1' => 'NPSN',
            '2' => 'NSS',
            '3' => 'NIS',
            '4' => __(':name Name', ['name' => __('School')]),
        ])" block
            wire:model.live.debounce.750ms='search' />
        <x-form.select class="snap-start" :items="$educationLevels" wire:model.live='educationLevel' />
        <x-form.select class="snap-start" :items="$schoolStatuses" wire:model.live='schoolStatus' />
    </div>

    @forelse ($schools as $school)
        <x-school-request-item :$school />
    @empty
        <x-no-data />
    @endforelse

    {{ $schools->links() }}

    <template x-teleport="body">
        <div wire:ignore>
            <x-modal name="approved-school-request-modal" size="xl" :modalTitle="__('Approved Registration')">
                <livewire:dashboard.school-request.approved />
            </x-modal>
            <x-modal name="rejected-school-request-modal" size="xl" :modalTitle="__('Rejected Registration')">
                <livewire:dashboard.school-request.rejected />
            </x-modal>
        </div>
    </template>
</x-content>
