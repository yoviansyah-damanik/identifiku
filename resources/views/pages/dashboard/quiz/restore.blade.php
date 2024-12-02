<div>
    <x-modal.body>
        @if (!$isLoading)
            <div>
                {{ __('Are you sure you want to restore the :attribute?', ['attribute' => __('Quiz')]) }}
            </div>
            <div class="space-y-1">
                <div class="flex gap-3">
                    <div class="w-48">{{ __(':name Name', ['name' => __('Quiz')]) }}</div>
                    <div class="flex-1 font-semibold">{{ $quiz->name }}</div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">{{ __('Number of :subject', ['subject' => __('Assessments')]) }}</div>
                    <div class="flex-1 font-semibold">
                        {{ GeneralHelper::numberFormat($quiz->assessments_count) .
                            ' ' .
                            ($quiz->assessments_count > 1 ? __('Assessments') : __('Assessment')) }}
                    </div>
                </div>
            </div>
        @else
            <x-loading />
        @endif
    </x-modal.body>
    <x-modal.footer>
        <x-button color="primary" wire:click='restore' :loading="$isLoading">
            {{ __('Restore') }}
        </x-button>
    </x-modal.footer>
</div>
