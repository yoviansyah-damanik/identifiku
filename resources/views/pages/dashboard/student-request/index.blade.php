<x-content>
    <x-content.title :title="__('Student Request')" :description="__('Manage :manage.', ['manage' => __('Student Request')])" />

    <div class="box-border flex w-full gap-3 overflow-x-auto overflow-y-hidden snap-proximity snap-x">
        <x-form.select class="snap-start" :items="$perPageList" wire:model.live='perPage' />
        <x-form.select-with-search class="w-72" block searchVar="schoolSearch" :items="$schools" wire:model="school"
            error="{{ $errors->first('school') }}" :withReset="true" :buttonText="__('Choose a :item', ['item' => __('School')])" />
        <x-form.input class="flex-1 min-w-48 snap-start" type="search" :placeholder="__('Search by :1, :2, or :3', [
            '1' => 'NISN',
            '2' => 'NIS',
            '3' => __(':name Name', ['name' => __('Student')]),
        ])" block
            wire:model.live.debounce.750ms='search' />

    </div>

    @forelse ($students as $student)
        <x-student-request-item :$student />
    @empty
        <x-no-data />
    @endforelse

    {{ $students->links() }}

    <template x-teleport="body">
        <div wire:ignore>
            <x-modal name="approved-student-request-modal" size="xl" :modalTitle="__('Approved Registration')">
                <livewire:dashboard.student-request.approved />
            </x-modal>
            <x-modal name="rejected-student-request-modal" size="xl" :modalTitle="__('Rejected Registration')">
                <livewire:dashboard.student-request.rejected />
            </x-modal>
        </div>
    </template>
</x-content>
