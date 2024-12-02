<x-content>
    <x-content.title :title="__('Available Classes')" :description="__('Manage :manage.', ['manage' => __('Available Classes')])" />

    <div class="box-border flex w-full gap-3 overflow-x-auto overflow-y-hidden snap-proximity snap-x">
        <x-form.select class="snap-start" :items="$perPageList" wire:model.live='perPage' />
        @if (auth()->user()->isAdmin)
            <x-form.select-with-search class="w-72 snap-start" block searchVar="schoolSearch" :items="$schools"
                wire:model="school" error="{{ $errors->first('school') }}" :withReset="true" :buttonText="__('Choose a :item', ['item' => __('School')])" />
        @endif
        <x-form.input class="flex-1 min-w-48 snap-start" type="search" :placeholder="__('Search by :1', [
            '1' => __(':name Name', ['name' => __('Class')]),
        ])" block
            wire:model.live.debounce.750ms='search' />

    </div>

    @forelse ($classes as $class)
        <x-available-class-item :$class />
    @empty
        <x-no-data />
    @endforelse

    {{ $classes->links() }}

    <template x-teleport="body">
        <div wire:ignore>
            <x-modal name="join-class-modal" size="xl" :modalTitle="__('Join Class')">
                <livewire:dashboard.student-class.join />
            </x-modal>
            <x-modal name="cancel-class-modal" size="xl" :modalTitle="__('Cancel Class')">
                <livewire:dashboard.student-class.cancel />
            </x-modal>
        </div>
    </template>
</x-content>
