<x-content>
    <x-content.title :title="__('School')" :description="__('Manage all users.')" />

    <div class="box-border flex w-full gap-3 overflow-x-auto overflow-y-hidden snap-proximity snap-x">
        <x-form.select class="snap-start" :items="$perPageList" wire:model.live='perPage' />
        <x-form.input class="flex-1 min-w-48 snap-start" type="search" :placeholder="__('Search by :1, :2, or :3', [
            '1' => __('ID'),
            '2' => __('Username'),
            '3' => __('Email'),
        ])" block
            wire:model.live.debounce.750ms='search' />
        <x-form.select class="snap-start" :items="$roles" wire:model.live='role' />
        <x-form.select :items="$activationTypes" wire:model.live='activationType' />
    </div>

    <x-table :columns="['#', __('Username'), __('Email'), __('Fullname'), __('Role'), __('Last Login'), __('Status'), '']">
        <x-slot name="body">
            @forelse ($users as $user)
                <x-table.tr>
                    <x-table.td centered>
                        {{ $users->perPage() * ($users->currentPage() - 1) + $loop->iteration }}
                    </x-table.td>
                    <x-table.td>
                        {{ $user->username }}
                        <div class="text-sm">
                            {{ $user->id }}
                        </div>
                    </x-table.td>
                    <x-table.td>
                        {{ $user->email }}
                    </x-table.td>
                    <x-table.td>
                        @if ($user->role_name == 'School')
                            <x-href href="{{ route('dashboard.school', ['search' => $user->dataRelation->name]) }}"
                                wire:navigate>
                                {{ $user->dataRelation->name }}
                            </x-href>
                        @elseif ($user->role_name == 'Student')
                            <x-href href="{{ route('dashboard.student', ['search' => $user->dataRelation->name]) }}"
                                wire:navigate>
                                {{ $user->dataRelation->name }}
                            </x-href>
                        @endif
                    </x-table.td>
                    <x-table.td centered>
                        <x-badge size="sm" :type="$user->role_name == 'Superadmin'
                            ? 'black'
                            : ($user->role_name == 'Administrator'
                                ? 'success'
                                : ($user->role_name == 'School'
                                    ? 'info'
                                    : ($user->role_name == 'Student'
                                        ? 'warning'
                                        : 'danger')))">
                            {{ __($user->role_name) }}
                        </x-badge>
                    </x-table.td>
                    <x-table.td centered>
                        {{ $user->last_login_at ? \Carbon\Carbon::parse($user->last_login_at)->translatedFormat('d F Y H:i:s') : '-' }}
                    </x-table.td>
                    <x-table.td centered>
                        <x-badge :type="$user->is_suspended ? 'error' : 'success'">
                            {{ $user->is_suspended ? __('Suspended') : __('Active') }}
                        </x-badge>
                    </x-table.td>
                    <x-table.td centered>
                        <x-tooltip :title="__('Forgot Password')">
                            <x-button size="sm" icon="i-ph-key" color="cyan"
                                x-on:click="$dispatch('toggle-forgot-password-modal')"
                                wire:click="$dispatch('setForgotPassword',{ user: '{{ $user->id }}' })" />
                        </x-tooltip>
                        @if ($user->type != \App\Models\Staff::class)
                            <x-tooltip :title="__('Activation Menu')">
                                <x-button size="sm" icon="i-ph-user-check" color="green"
                                    x-on:click="$dispatch('toggle-user-activation-modal')"
                                    wire:click="$dispatch('setUserActivation',{ user: '{{ $user->id }}' })" />
                            </x-tooltip>
                        @endif
                    </x-table.td>
                </x-table.tr>
            @empty
                <x-table.tr>
                    <x-table.td colspan="10">
                        <x-no-data />
                    </x-table.td>
                </x-table.tr>
            @endforelse
        </x-slot>

        <x-slot name="paginate">
            {{ $users->links(data: ['scrollTo' => false]) }}
        </x-slot>
    </x-table>

    <div wire:ignore>
        <x-modal name="user-activation-modal" size="xl" :modalTitle="__('User Activation')">
            <livewire:dashboard.users.user-activation />
        </x-modal>
        <x-modal name="forgot-password-modal" size="xl" :modalTitle="__('Forgot Password')">
            <livewire:dashboard.users.forgot-password />
        </x-modal>
    </div>
</x-content>
