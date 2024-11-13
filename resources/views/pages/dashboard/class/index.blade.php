<x-content>
    <x-content.title :title="__('Class')" :description="__('Manage :manage.', ['manage' => __('Class')])" />

    <div class="box-border flex w-full gap-3 overflow-x-auto overflow-y-hidden snap-proximity snap-x">
        @haspermission('class create')
            <x-button color="primary" icon="i-ph-plus" x-on:click="$dispatch('toggle-create-class-modal')">
                {{ __('Add :add', ['add' => __('Class')]) }}
            </x-button>
        @endhaspermission
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
        <x-class-item :$class />
    @empty
        <x-no-data />
    @endforelse

    {{ $classes->links() }}
    <div wire:ignore>
        @haspermission('class create')
            <x-modal name="create-class-modal" size="xl" :modalTitle="__('Add :add', ['add' => __('Class')])">
                <livewire:dashboard.class.create />
            </x-modal>
        @endhaspermission
        @haspermission('class edit')
            <x-modal name="edit-class-modal" size="xl" :modalTitle="__('Edit :edit', ['edit' => __('Class')])">
                <livewire:dashboard.class.edit />
            </x-modal>
        @endhaspermission
        @haspermission('class delete')
            <x-modal name="delete-class-modal" size="xl" :modalTitle="__('Delete :delete', ['delete' => __('Class')])">
                <livewire:dashboard.class.delete />
            </x-modal>
        @endhaspermission
    </div>
</x-content>
