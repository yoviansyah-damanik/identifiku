<div>
    <x-modal.body>
        @if (!$isLoading)
            <div>
                {{ __('Are you sure you want to delete the :attribute?', ['attribute' => __('School Status')]) }}
            </div>
            <div class="space-y-1" wire:ignore>
                <div class="flex gap-3">
                    <div class="w-48">{{ __(':name Name', ['name' => __('School Status')]) }}</div>
                    <div class="flex-1 font-semibold">{{ $schoolStatus->name }}</div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">{{ __('Description') }}</div>
                    <div class="flex-1 font-semibold">{{ $schoolStatus->description }}</div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">{{ __('Number of :subject', ['subject' => __('Schools')]) }}</div>
                    <div class="flex-1 font-semibold">
                        {{ GeneralHelper::numberFormat($schoolStatus->schools_count) .
                            ' ' .
                            ($schoolStatus->schools_count > 1 ? __('Schools') : __('School')) }}
                    </div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">{{ __('Number of :subject', ['subject' => __('Students')]) }}</div>
                    <div class="flex-1 font-semibold">
                        {{ GeneralHelper::numberFormat($schoolStatus->schools->sum(fn($q) => $q->students->count())) .
                            ' ' .
                            ($schoolStatus->schools->sum(fn($q) => $q->students->count()) > 1 ? __('Students') : __('Student')) }}
                    </div>
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
