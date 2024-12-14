<x-content>
    {{-- <x-content.title :title="__('Assessment Result')" :description="__('Assessment Result')" /> --}}

    @if ($assessment->result->status == 'done')
        <x-dynamic-component :component="'assessment.result.' . $assessment->quiz->assessmentRule->type" :$assessment />
    @else
        <x-assessment-on-process />
    @endif

    @if (auth()->user()->isTeacher &&
            $assessment->class->teacher->id == auth()->user()?->teacher->id &&
            $assessment->result->status == 'done')
        <template x-teleport="body">
            <x-modal name="show-detail-modal" size="3xl" :modalTitle="__('Show :show', ['show' => __('Dominance')])">
                <livewire:dashboard.assessment.update-result :result="$assessment->result" />
            </x-modal>
        </template>
    @endif
</x-content>
