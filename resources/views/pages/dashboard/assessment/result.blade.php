<x-content>
    {{-- <x-content.title :title="__('Assessment Result')" :description="__('Assessment Result')" /> --}}

    <x-dynamic-component :component="'assessment.result.' . $assessment->quiz->assessmentRule->type" :$assessment />
</x-content>
