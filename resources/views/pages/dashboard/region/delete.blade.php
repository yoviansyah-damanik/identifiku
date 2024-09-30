<div>
    <x-modal.body>
        @if (!$isLoading)
            <div>
                {{ __('Are you sure you want to delete the :attribute?', ['attribute' => __('Region')]) }}
            </div>
            <div class="space-y-1" wire:ignore>
                <div class="flex gap-3">
                    <div class="w-48">{{ __(':name Name', ['name' => __('Region')]) }}</div>
                    <div class="flex-1 font-semibold">{{ $region->name }}</div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">{{ __('Code') }}</div>
                    <div class="flex-1 font-semibold">{{ $region->code }}</div>
                </div>
                {{-- <div class="flex gap-3">
                    <div class="w-48">{{ __('Number of :subject', ['subject' => __('Schools')]) }}</div>
                    <div class="flex-1 font-semibold">
                        {{ GeneralHelper::numberFormat($region->schools_count) .
                            ' ' .
                            ($region->schools_count > 1 ? __('Schools') : __('School')) }}
                    </div>
                </div> --}}
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
