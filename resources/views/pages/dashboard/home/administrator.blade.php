<div class="space-y-3 sm:space-y-4">
    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-4 sm:gap-4">
        <x-box color="primary" :href="route('dashboard.student')" icon="i-fluent-emoji-flat-man-student" :title="__('Students')"
            :count="GeneralHelper::numberFormat($students_count)"></x-box>
        <x-box color="primary" :href="route('dashboard.teacher')" icon="i-fluent-emoji-flat-man-teacher" :title="__('Teachers')"
            :count="GeneralHelper::numberFormat($teachers_count)"></x-box>
        <x-box color="primary" :href="route('dashboard.school')" icon="i-fluent-emoji-flat-school" :title="__('Schools')"
            :count="GeneralHelper::numberFormat($schools_count)"></x-box>
        <x-box color="primary" :href="route('dashboard.class')" icon="i-fluent-emoji-flat-door" :title="__('Classes')"
            :count="GeneralHelper::numberFormat($classes_count)"></x-box>
    </div>

    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-4 sm:gap-4">
        <x-box color="primary" :href="route('dashboard.student.request')" icon="i-fluent-emoji-flat-man-student" :title="__('Student Requests')"
            :count="GeneralHelper::numberFormat($student_requests_count)"></x-box>
        <x-box color="primary" :href="route('dashboard.teacher.request')" icon="i-fluent-emoji-flat-man-teacher" :title="__('Teacher Requests')"
            :count="GeneralHelper::numberFormat($teacher_requests_count)"></x-box>
        <x-box color="primary" :href="route('dashboard.school.request')" icon="i-fluent-emoji-flat-school" :title="__('School Requests')"
            :count="GeneralHelper::numberFormat($school_requests_count)"></x-box>
        <x-box color="primary" :href="route('dashboard.class.request')" icon="i-fluent-emoji-flat-door" :title="__('Class Requests')"
            :count="GeneralHelper::numberFormat($class_requests_count)"></x-box>
    </div>

    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-4 sm:gap-4">
        <x-box color="primary" :href="route('dashboard.education-level')" icon="i-fluent-emoji-flat-level-slider" :title="__('Education Levels')"
            :count="GeneralHelper::numberFormat($education_levels_count)"></x-box>
        <x-box color="primary" :href="route('dashboard.grade-level')" icon="i-fluent-emoji-flat-level-slider" :title="__('Grade Levels')"
            :count="GeneralHelper::numberFormat($grade_levels_count)"></x-box>
        <x-box color="primary" :href="route('dashboard.school-status')" icon="i-fluent-emoji-flat-level-slider" :title="__('School Statuses')"
            :count="GeneralHelper::numberFormat($school_statuses_count)"></x-box>
    </div>

    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-4 sm:gap-4">
        <x-box color="primary" :href="route('dashboard.quiz-category')" icon="i-fluent-emoji-flat-card-file-box" :title="__('Quiz Categories')"
            :count="GeneralHelper::numberFormat($quiz_categories_count)"></x-box>
        <x-box color="primary" :href="route('dashboard.quiz-phase')" icon="i-fluent-emoji-flat-card-file-box" :title="__('Quiz Phases')"
            :count="GeneralHelper::numberFormat($quiz_phases_count)"></x-box>
    </div>

    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-4 sm:gap-4">
        <x-box color="primary" :href="route('dashboard.quiz')" icon="i-fluent-emoji-flat-abacus" :title="__('Number of :subject', ['subject' => __('Quizzes')])"
            :count="GeneralHelper::numberFormat($quizzes_count)"></x-box>
        <x-box color="primary" :href="route('dashboard.quiz', ['status' => 'draft'])" icon="i-fluent-emoji-flat-abacus" :title="__('Draft Quizzes')"
            :count="GeneralHelper::numberFormat($draft_quizzes_count)"></x-box>
        <x-box color="primary" :href="route('dashboard.quiz', ['status' => 'published'])" icon="i-fluent-emoji-flat-abacus" :title="__('Available Quizzes')"
            :count="GeneralHelper::numberFormat($published_quizzes_count)"></x-box>
    </div>

    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-4 sm:gap-4">
        <x-box color="primary" :href="route('dashboard.assessment.students')" icon="i-fluent-emoji-flat-bookmark-tabs" :title="__('All Assessments')"
            :count="GeneralHelper::numberFormat($assessments_count)"></x-box>
        <x-box color="primary" :href="route('dashboard.assessment.students', ['status' => 1])" icon="i-fluent-emoji-flat-bookmark-tabs" :title="__('Assessment Process')"
            :count="GeneralHelper::numberFormat($process_assessments_count)"></x-box>
        <x-box color="primary" :href="route('dashboard.assessment.students', ['status' => 2])" icon="i-fluent-emoji-flat-bookmark-tabs" :title="__('Assessment Submitted')"
            :count="GeneralHelper::numberFormat($submitted_assessments_count)"></x-box>
        <x-box color="primary" :href="route('dashboard.assessment.students', ['status' => 3])" icon="i-fluent-emoji-flat-bookmark-tabs" :title="__('Assessment Completed')"
            :count="GeneralHelper::numberFormat($completed_assessments_count)"></x-box>
    </div>

    {{-- REGION --}}
    @if (auth()->user()->roleName == 'Superadmin')
        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-4 sm:gap-4">
            <x-box color="primary" :href="route('dashboard.region')" icon="i-fluent-emoji-flat-world-map" :title="__('Provinces')"
                :count="GeneralHelper::numberFormat($provinces_count)"></x-box>
            <x-box color="primary" :href="route('dashboard.region')" icon="i-fluent-emoji-flat-world-map" :title="__('Regencies')"
                :count="GeneralHelper::numberFormat($regencies_count)"></x-box>
            <x-box color="primary" :href="route('dashboard.region')" icon="i-fluent-emoji-flat-world-map" :title="__('Districts')"
                :count="GeneralHelper::numberFormat($districts_count)"></x-box>
            <x-box color="primary" :href="route('dashboard.region')" icon="i-fluent-emoji-flat-world-map" :title="__('Villages')"
                :count="GeneralHelper::numberFormat($villages_count)"></x-box>
        </div>
    @endif
    {{-- END REGION --}}

    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-4 sm:gap-4">
        <x-five-recent-assessment-group :title="__('Five Recent of :type', ['type' => __('Student Learning Style')])" :assessments="$five_recent_of_student_learning_style" />
        <x-five-recent-assessment-group :title="__('Five Recent of :type', ['type' => __('Personality Type')])" :assessments="$five_recent_of_personality_type" />
        <x-five-recent-assessment-group :title="__('Five Recent of :type', ['type' => __('Keirsey Temperament Sorter')])" :assessments="$five_recent_of_keirsey_temperament_sorter" />
        <x-five-recent-assessment-group :title="__('Five Recent of :type', ['type' => __('Multiple Intelligence Type')])" :assessments="$five_recent_of_multiple_intelligence_type" />
    </div>
</div>
