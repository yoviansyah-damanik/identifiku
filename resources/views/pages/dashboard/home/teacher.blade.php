<div class="space-y-3 sm:space-y-4">
    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-4 sm:gap-4">
        <x-box color="primary" :href="route('dashboard.class')" icon="i-fluent-emoji-flat-door" :title="__('Classes')"
            :count="GeneralHelper::numberFormat($classes_count)"></x-box>
        <x-box color="primary" :href="route('dashboard.class.request')" icon="i-fluent-emoji-flat-door" :title="__('Class Requests')"
            :count="GeneralHelper::numberFormat($class_requests_count)"></x-box>
    </div>

    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-4 sm:gap-4">
        <x-box color="primary" :href="route('dashboard.quiz.available')" icon="i-fluent-emoji-flat-abacus" :title="__('Available Quizzes')"
            :count="GeneralHelper::numberFormat($available_quizzes_count)"></x-box>
        <x-box color="primary" :href="route('dashboard.assessment.students')" icon="i-fluent-emoji-flat-bookmark-tabs" :title="__('Student Assessments')"
            :count="GeneralHelper::numberFormat($assessments_count)"></x-box>
    </div>

    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-4 sm:gap-4">
        <x-five-recent-assessment-group :title="__('Five Recent of :type', ['type' => __('Student Learning Style')])" :assessments="$five_recent_of_student_learning_style" />
        <x-five-recent-assessment-group :title="__('Five Recent of :type', ['type' => __('Personality Type')])" :assessments="$five_recent_of_personality_type" />
        <x-five-recent-assessment-group :title="__('Five Recent of :type', ['type' => __('Keirsey Temperament Sorter')])" :assessments="$five_recent_of_keirsey_temperament_sorter" />
        <x-five-recent-assessment-group :title="__('Five Recent of :type', ['type' => __('Multiple Intelligence Type')])" :assessments="$five_recent_of_multiple_intelligence_type" />
    </div>
</div>
