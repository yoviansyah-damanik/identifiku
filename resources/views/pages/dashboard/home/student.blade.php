<div class="space-y-3 sm:space-y-4">
    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-4 sm:gap-4">
        <x-box color="primary" :href="route('dashboard.student-class')" icon="i-fluent-emoji-flat-door" :title="__('Classes')"
            :count="GeneralHelper::numberFormat(auth()->user()->student->hasClasses->count())"></x-box>
        <x-box color="cyan" :href="route('dashboard.assessment')" icon="i-fluent-emoji-flat-bookmark-tabs" :title="__('Available Assessments')"
            :count="GeneralHelper::numberFormat(
                auth()->user()->student->classes->sum(fn($q) => $q->hasQuizzes()->count()),
            )"></x-box>
        <x-box color="secondary" :href="route('dashboard.assessment-history')" icon="i-fluent-emoji-flat-bookmark-tabs" :title="__('Assessment History')"
            :count="GeneralHelper::numberFormat(auth()->user()->student->assessments->count())"></x-box>
        <x-box color="green" :href="route('dashboard.assessment-history')" icon="i-fluent-emoji-flat-bookmark-tabs" :title="__('Assessment Completed')"
            :count="GeneralHelper::numberFormat(auth()->user()->student->assessments()->done()->count())"></x-box>
    </div>

    <livewire:dashboard.home.additional.last-assessment />
</div>
