<div>
    <x-modal.body>
        @if (!$isLoading)
            <div>
                {{ __('Are you sure you want to reject the :attribute?', ['attribute' => __('Class Request')]) }}
            </div>
            <div class="space-y-1">
                <div class="flex gap-3">
                    <div class="w-48">{{ __(':name Name', ['name' => __('Class')]) }}</div>
                    <div class="flex-1 font-semibold">{{ $request->class->name }}</div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">{{ __(':name Name', ['name' => __('Student')]) }}</div>
                    <div class="flex-1 font-semibold">{{ $request->student->name }}</div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">{{ __('Teacher') }}</div>
                    <div class="flex-1 font-semibold">{{ $request->class->teacher->name }}</div>
                </div>
            </div>
        @else
            <x-loading />
        @endif
    </x-modal.body>
    <x-modal.footer>
        <x-button color="primary" wire:click='reject' :loading="$isLoading">
            {{ __('Reject') }}
        </x-button>
    </x-modal.footer>
</div>
