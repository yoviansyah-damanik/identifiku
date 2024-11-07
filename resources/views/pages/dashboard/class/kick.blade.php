<div>
    <x-modal.body>
        @if (!$isLoading)
            <div>
                {{ __('Are you sure you want to get student out of this class?') }}
            </div>
            <div class="space-y-1">
                <div class="flex gap-3">
                    <div class="w-48">{{ __(':name Name', ['name' => __('Class')]) }}</div>
                    <div class="flex-1 font-semibold">{{ $class->name }}</div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">{{ __(':name Name', ['name' => __('Student')]) }}</div>
                    <div class="flex-1 font-semibold">{{ $student->name }}</div>
                </div>

            </div>
        @else
            <x-loading />
        @endif
    </x-modal.body>
    <x-modal.footer>
        <x-button color="primary" wire:click='kick' :loading="$isLoading">
            {{ __('Get Student Out') }}
        </x-button>
    </x-modal.footer>
</div>
