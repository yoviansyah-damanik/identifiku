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


</div>
