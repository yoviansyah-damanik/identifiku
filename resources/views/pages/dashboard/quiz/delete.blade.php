<div>
    <x-modal.body>
        @if (!$isLoading)
            <div>
                {{ __('Are you sure you want to delete the :attribute?', ['attribute' => __('Quiz')]) }}
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
            <div>
                {{ __('Quizzes that have been added to the class will not be completely deleted, you can restore the quiz by restoring it. Quizzes that have not been added to the class will be completely deleted.') }}
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
