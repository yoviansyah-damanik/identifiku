<x-content>
    <x-content.title :title="__('Student')" :description="__('Manage :manage.', ['manage' => __('Student')])" />

    <div class="box-border flex w-full gap-3 overflow-x-auto overflow-y-hidden snap-proximity snap-x">
        <x-form.select class="snap-start" :items="$perPageList" wire:model.live='perPage' />
        @if (auth()->user()->isAdmin)
            <x-form.select-with-search class="w-72 snap-start" block searchVar="schoolSearch" :items="$schools"
                wire:model="schoolSearch" error="{{ $errors->first('school') }}" :withReset="true" :buttonText="__('Choose a :item', ['item' => __('School')])" />
        @endif
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

    @if ($students->hasPages())
        <div class="px-8 py-3 bg-white col-span-full dark:bg-slate-800 min-h-14 mt-9">
            {{ $students->links() }}
        </div>
    @endif

    <template x-teleport="body">
        <div wire:ignore>
            <x-modal name="delete-student-modal" size="2xl" :modalTitle="__('Delete :delete', ['delete' => __('Student')])">
                <livewire:dashboard.student.delete />
            </x-modal>
            <x-modal name="user-activation-modal" size="xl" :modalTitle="__('User Activation')">
                <livewire:dashboard.users.user-activation />
            </x-modal>
            <x-modal name="forgot-password-modal" size="xl" :modalTitle="__('Forgot Password')">
                <livewire:dashboard.users.forgot-password />
            </x-modal>
        </div>
    </template>
</x-content>
