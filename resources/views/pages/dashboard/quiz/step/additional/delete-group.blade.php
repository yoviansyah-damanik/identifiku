<div>
    <x-modal.body>
        @if (!$isLoading)
            <div>
                {{ __('Are you sure you want to delete the :attribute?', ['attribute' => __('Question Group')]) }}
            </div>
            <div class="space-y-1" wire:ignore>
                <div class="flex gap-3">
                    <div class="w-48">{{ __(':name Name', ['name' => __('Question Group')]) }}</div>
                    <div class="flex-1 font-semibold">{{ $group->name }}</div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">{{ __('Description') }}</div>
                    <div class="flex-1 font-semibold">{{ $group->description }}</div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">
                        {{ __('Number of :subject', ['subject' => __('Question')]) }}
                    </div>
                    <div class="flex-1 font-semibold">
                        {{ GeneralHelper::numberFormat($group->questions->count()) .
                            ' ' .
                            ($group->questions->count() > 1 ? __('Questions') : __('Question')) }}
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
