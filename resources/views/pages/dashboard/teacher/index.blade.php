<x-content>
    <x-content.title :title="__('Teacher')" :description="__('Manage :manage.', ['manage' => __('Teacher')])" />

    <div class="box-border flex w-full gap-3 overflow-x-auto overflow-y-hidden snap-proximity snap-x">
        <x-form.select class="snap-start" :items="$perPageList" wire:model.live='perPage' />
        <x-form.select-with-search class="w-72 snap-start" block searchVar="schoolSearch" :items="$schools"
            wire:model="school" error="{{ $errors->first('school') }}" :withReset="true" :buttonText="__('Choose a :item', ['item' => __('School')])" />
        <x-form.input class="flex-1 min-w-48 snap-start" type="search" :placeholder="__('Search by :1, :2, or :3', [
            '1' => 'NISN',
            '2' => 'NIS',
            '3' => __(':name Name', ['name' => __('Teacher')]),
        ])" block
            wire:model.live.debounce.750ms='search' />

    </div>

    @forelse ($teachers as $teacher)
        <x-teacher-item :$teacher />
    @empty
        <x-no-data />
    @endforelse

    {{ $teachers->links() }}
    <div wire:ignore>
        <x-modal name="delete-teacher-modal" size="2xl" :modalTitle="__('Delete :delete', ['delete' => __('Teacher')])">
            <livewire:dashboard.teacher.delete />
        </x-modal>
    </div>
</x-content>
