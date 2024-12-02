<div class="rounded-lg bg-white shadow max-w-[720px] mx-auto p-6 sm:p-8 space-y-3 sm:space-y-4">
    <div>
        <div class="font-semibold">
            {{ __(':name Name', ['name' => __('Quiz')]) }}
        </div>
        <div class="font-light">
            {{ $quiz->name }}
        </div>
    </div>
    <div>
        <div class="font-semibold">
            {{ __('Number of :subject', ['subject' => __('Question Group')]) }}
        </div>
        <div class="font-light">
            {{ $quiz->groups_count }}
            {{ $quiz->groups_count > 1 ? __('Question Groups') : __('Question Group') }}
        </div>
    </div>
    <div>
        <div class="font-semibold">
            {{ __('Number of :subject', ['subject' => __('Question')]) }}
        </div>
        <div class="font-light">
            {{ $quiz->groups->sum('questions_count') }}
            {{ $quiz->groups->sum('questions_count') > 1 ? __('Questions') : __('Question') }}
        </div>
    </div>
    <div @class([
        'flex items-center gap-3 !mt-7',
        'justify-end' => $this->quiz->isPublished,
        'justify-between' => $this->quiz->isDraft,
    ])>
        @if ($this->quiz->isDraft)
            <div class="text-sm italic">
                {{ __('The quiz will be displayed publicly and can be modified by you after the quiz is published') }}
            </div>
            <x-button wire:click="publish" color="primary">
                {{ __('Publish') }}
            </x-button>
        @else
            <x-button :href="route('dashboard.quiz.show', $this->quiz)" color="primary">
                {{ __('Show :show', ['show' => __('Quiz')]) }}
            </x-button>
        @endif
    </div>
</div>
