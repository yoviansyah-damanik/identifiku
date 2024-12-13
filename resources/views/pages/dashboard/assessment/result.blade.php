<x-content>
    {{-- <x-content.title :title="__('Assessment Result')" :description="__('Assessment Result')" /> --}}

    <x-dynamic-component :component="'assessment.result.' . $assessment->quiz->assessmentRule->type" :$assessment />

    @if (auth()->user()->isTeacher && $assessment->class->teacher->id == auth()->user()?->teacher->id)
        <template x-teleport="body">
            <x-modal name="show-detail-modal" size="3xl" :modalTitle="__('Show :show', ['show' => __('Dominance')])">
                <livewire:dashboard.assessment.update-result :result="$assessment->result" />
            </x-modal>
        </template>
    @endif
</x-content>
