<div>
    <x-modal.body>
        @if (!$isLoading && $question)
            <div>
                {{ __('Are you sure you want to delete the :attribute?', ['attribute' => __('Question')]) }}
            </div>
            <div class="space-y-1" wire:ignore>
                <div class="flex gap-3">
                    <div class="w-24">{{ __('Question') }}</div>
                    <div class="flex-1 font-semibold">{{ $question->question }}</div>
                </div>
            </div>
        @else
            <x-loading />
        @endif
    </x-modal.body>
    <x-modal.footer>
        <x-button color="primary" wire:click='delete' :loading="$isLoading">
            {{ __('Delete') }}
        </x-button>
    </x-modal.footer>
</div>
