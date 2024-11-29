<div>
    <x-modal.body>
        @if (!$isLoading)
            <div>
                {{ __('Are you sure you want to exit this class?') }}
            </div>
            <div class="space-y-1">
                <div class="flex gap-3">
                    <div class="w-48">{{ __(':name Name', ['name' => __('Class')]) }}</div>
                    <div class="flex-1 font-semibold">{{ $class->name }}</div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">{{ __('Teacher') }}</div>
                    <div class="flex-1 font-semibold">{{ $class->teacher->name }}</div>
                </div>

            </div>
            <div class="mt-3">
                {{ __('All your assessments for this class will be deleted') }}
            </div>
        @else
            <x-loading />
        @endif
    </x-modal.body>
    <x-modal.footer>
        <x-button color="primary" wire:click='exit' :loading="$isLoading">
            {{ __('Exit') }}
        </x-button>
    </x-modal.footer>
</div>
