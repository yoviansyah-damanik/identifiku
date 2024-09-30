<x-content>
    <x-content.title :title="__('Account Settings')" :description="__('Manage your account.')" />

    <div class="flex gap-5">
        <div class="flex-none bg-white p-7 flex flex-col gap-3 w-72 rounded-lg">
            @foreach ($choices as $item)
                <x-button block wire:click="$set('choice','{{ $item }}')" :color="$choice == $item ? 'primary' : 'primary-transparent'">
                    {{ __(Str::of($item)->headline()->value) }}
                </x-button>
            @endforeach
        </div>

        <div class="flex-1 bg-white p-7 flex flex-col gap-3 rounded-lg">
            <livewire:dashboard.account.administrator />
        </div>
    </div>
</x-content>
