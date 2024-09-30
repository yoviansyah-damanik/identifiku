<x-content>
    <x-content.title :title="__('School')" :description="__('Manage all students.')" />

    <div class="box-border flex w-full gap-3 overflow-x-auto overflow-y-hidden snap-proximity snap-x">
        <x-form.select class="snap-start" :items="$perPageList" wire:model.live='perPage' />
        <x-form.select-with-search class="w-72 snap-start" block searchVar="schoolSearch" :items="$schools"
            wire:model="school" error="{{ $errors->first('school') }}" :withReset="true" :buttonText="__('Choose a :item', ['item' => __('School')])" />
        <x-form.input class="flex-1 min-w-48 snap-start" type="search" :placeholder="__('Search by :1, :2, or :3', [
            '1' => 'NISN',
            '2' => 'NIS',
            '3' => __(':name Name', ['name' => __('Student')]),
        ])" block
            wire:model.live.debounce.750ms='search' />

    </div>

    @forelse ($students as $student)
        <x-student-item :$student />
    @empty
        <x-no-data />
    @endforelse

    {{ $students->links() }}
    <div wire:ignore>
        <x-modal name="delete-student-modal" size="2xl" :modalTitle="__('Delete :delete', ['delete' => __('Student')])">
            <livewire:dashboard.student.delete />
        </x-modal>
    </div>
</x-content>
