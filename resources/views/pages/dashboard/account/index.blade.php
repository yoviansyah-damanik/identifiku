<x-content>
    <x-content.title :title="__('Your Account')" :description="__('Manage :manage.', ['manage' => __('Your Account')])" />

    <div class="flex items-start gap-5">
        <div class="flex flex-col flex-none gap-3 bg-white rounded-lg p-7 w-72">
            @foreach ($choices as $item)
                <x-button block wire:click="$set('choice','{{ $item }}')" :color="$choice == $item ? 'primary' : 'primary-transparent'">
                    {{ __(Str::of($item)->headline()->value) }}
                </x-button>
            @endforeach
        </div>

        <div class="flex flex-col flex-1 gap-3 bg-white rounded-lg max-w-[920px] p-7">
            <livewire:is :component="'dashboard.account.' . $choice" :key="$choice" />
            {{-- @if ($choice == 'user')
                <livewire:dashboard.account.user />
            @elseif ($choice == 'password')
                <livewire:dashboard.account.password />
            @else
                @livewire('dashboard.account.' . Str::lower(auth()->user()->roleName != 'Superadmin' ? auth()->user()->roleName : 'Administrator'))
            @endif --}}
        </div>
    </div>
</x-content>
