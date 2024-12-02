<div>
    <x-modal.body>
        @if (!$isLoading)
            <div>
                {{ __('Are you sure you want to delete the :attribute?', ['attribute' => __('Quiz Phase')]) }}
            </div>
            <div class="space-y-1">
                <div class="flex gap-3">
                    <div class="w-48">{{ __(':name Name', ['name' => __('Quiz Phase')]) }}</div>
                    <div class="flex-1 font-semibold">{{ $quizPhase->name }}</div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">{{ __('Description') }}</div>
                    <div class="flex-1 font-semibold">{{ $quizPhase->description }}</div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">{{ __('Grade Levels') }}</div>
                    <div class="flex-1 font-semibold"> {{ $quizPhase->grades->pluck('name')->join(', ') }}
                    </div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">{{ __('Number of :subject', ['subject' => __('Quizzes')]) }}</div>
                    <div class="flex-1 font-semibold">
                        {{ GeneralHelper::numberFormat($quizPhase->quizzes_count) .
                            ' ' .
                            ($quizPhase->quizzes_count > 1 ? __('Quizzes') : __('Quiz')) }}
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
