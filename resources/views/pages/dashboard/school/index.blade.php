<x-content>
    <x-content.title :title="__('School')" :description="__('Manage :manage.', ['manage' => __('School')])" />

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
        <x-form.select class="snap-start" :items="$activationStatuses" wire:model.live='activationStatus' />
        <x-form.select class="snap-start" :items="$openStatuses" wire:model.live='openStatus' />
    </div>

    @forelse ($schools as $school)
        <x-school-item :$school />
    @empty
        <x-no-data />
    @endforelse

    {{ $schools->links() }}
    <div wire:ignore>
        <x-modal name="delete-school-modal" size="2xl" :modalTitle="__('Delete :delete', ['delete' => __('School')])">
            <livewire:dashboard.school.delete />
        </x-modal>
        <x-modal name="user-activation-modal" size="xl" :modalTitle="__('User Activation')">
            <livewire:dashboard.users.user-activation />
        </x-modal>
        <x-modal name="forgot-password-modal" size="xl" :modalTitle="__('Forgot Password')">
            <livewire:dashboard.users.forgot-password />
        </x-modal>
    </div>
</x-content>
