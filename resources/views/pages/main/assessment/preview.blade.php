<div>
    <x-main.breadcrumb :breadcrumbs="[
        [
            'title' => __('Assessment'),
            'url' => route('assessment'),
        ],
        [
            'title' => $quiz->name,
            'url' => route('assessment.show', $quiz->id),
        ],
        [
            'title' => __('Preview'),
        ],
    ]" />

    <x-container>
        <x-preview :$quiz :$selectedQuizPhase :$selectedQuizCategory :$activeGroup />
    </x-container>
</div>
