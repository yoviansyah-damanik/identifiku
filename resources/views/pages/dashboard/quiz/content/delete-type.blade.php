<div>
    <x-modal.body>
        @if (!$isLoading)
            <div>
                {{ __('Are you sure you want to delete the :attribute?', ['attribute' => __('Question Type')]) }}
            </div>
            <div class="space-y-1" wire:ignore>
                <div class="flex gap-3">
                    <div class="w-48">{{ __(':name Name', ['name' => __('Question Type')]) }}</div>
                    <div class="flex-1 font-semibold">{{ $type->id }}</div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">{{ __(':name Name', ['name' => __('Question Type')]) }}</div>
                    <div class="flex-1 font-semibold">{{ $type->name }}</div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">{{ __('Description') }}</div>
                    <div class="flex-1 font-semibold">{{ $type->description }}</div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">
                        {{ __('Number of :subject', ['subject' => __('Question Group')]) }}
                    </div>
                    <div class="flex-1 font-semibold">
                        {{ GeneralHelper::numberFormat($type->groups->count()) .
                            ' ' .
                            ($type->groups->count() > 1 ? __('Question Groups') : __('Question Group')) }}
                    </div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">
                        {{ __('Number of :subject', ['subject' => __('Question')]) }}
                    </div>
                    <div class="flex-1 font-semibold">
                        {{ GeneralHelper::numberFormat($type->groups->sum(fn($q) => $q->questions->count())) .
                            ' ' .
                            ($type->groups->sum(fn($q) => $q->questions->count()) > 1 ? __('Questions') : __('Question')) }}
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
