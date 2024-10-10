<div>
    <x-modal.body>
        @if (!$isLoading)
            <div>
                {{ __('Are you sure you want to reject the :attribute?', ['attribute' => __('Teacher')]) }}
            </div>
            <div class="space-y-1">
                <div class="flex gap-3">
                    <div class="w-48">NUPTK</div>
                    <div class="flex-1 font-semibold">{{ $teacher->nuptk }}</div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">{{ __(':name Name', ['name' => __('Teacher')]) }}</div>
                    <div class="flex-1 font-semibold">{{ $teacher->name }}</div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">{{ __(':name Name', ['name' => __('School')]) }}</div>
                    <div class="flex-1 font-semibold">{{ $teacher->school->name }}</div>
                </div>
            </div>
        @else
            <x-loading />
        @endif
    </x-modal.body>
    <x-modal.footer>
        <x-button color="primary" wire:click='submit' :loading="$isLoading">
            {{ __('Reject') }}
        </x-button>
    </x-modal.footer>
</div>
