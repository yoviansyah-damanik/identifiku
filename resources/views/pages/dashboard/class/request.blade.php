<x-content>
    <x-content.title :title="__('Class Request')" :description="__('Manage :manage.', ['manage' => __('Class Request')])" />

    <div class="box-border flex w-full gap-3 overflow-x-auto overflow-y-hidden snap-proximity snap-x">
        <x-form.select class="snap-start" :items="$perPageList" wire:model.live='perPage' />
        @if (auth()->user()->isAdmin)
            <x-form.select-with-search class="w-72 snap-start" block searchVar="schoolSearch" :items="$schools"
                wire:model="school" error="{{ $errors->first('school') }}" :withReset="true" :buttonText="__('Choose a :item', ['item' => __('School')])" />
        @endif
        <x-form.input class="flex-1 min-w-48 snap-start" type="search" :placeholder="__('Search by :1, :2, :3, or :4', [
            '1' => 'NISN',
            '2' => 'NIS',
            '3' => __(':name Name', ['name' => __('Student')]),
            '4' => __(':name Name', ['name' => __('Class')]),
        ])" block
            wire:model.live.debounce.750ms='search' />

    </div>

    @forelse ($requests as $request)
        <x-class-request-item :$request />
    @empty
        <x-no-data />
    @endforelse

    {{ $requests->links() }}
    <template x-teleport="body">
        <div wire:ignore>
            <x-modal name="approve-class-modal" size="xl" :modalTitle="__('Join Class')">
                <livewire:dashboard.class.approve />
            </x-modal>
            <x-modal name="reject-class-modal" size="xl" :modalTitle="__('Cancel Class')">
                <livewire:dashboard.class.reject />
            </x-modal>
        </div>
    </template>
</x-content>
