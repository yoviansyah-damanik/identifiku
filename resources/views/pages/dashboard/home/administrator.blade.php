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
    <div class="!my-6 border-b"></div>
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
    <div class="!my-6 border-b"></div>
    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-4 sm:gap-4">
        <x-box color="primary" :href="route('dashboard.education-level')" icon="i-fluent-emoji-flat-level-slider" :title="__('Education Levels')"
            :count="GeneralHelper::numberFormat($education_levels_count)"></x-box>
        <x-box color="primary" :href="route('dashboard.grade-level')" icon="i-fluent-emoji-flat-level-slider" :title="__('Grade Levels')"
            :count="GeneralHelper::numberFormat($grade_levels_count)"></x-box>
        <x-box color="primary" :href="route('dashboard.school-status')" icon="i-fluent-emoji-flat-level-slider" :title="__('School Statuses')"
            :count="GeneralHelper::numberFormat($school_statuses_count)"></x-box>
    </div>
    <div class="!my-6 border-b"></div>
    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-4 sm:gap-4">
        <x-box color="primary" :href="route('dashboard.quiz-category')" icon="i-fluent-emoji-flat-card-file-box" :title="__('Quiz Categories')"
            :count="GeneralHelper::numberFormat($quiz_categories_count)"></x-box>
        <x-box color="primary" :href="route('dashboard.quiz-phase')" icon="i-fluent-emoji-flat-card-file-box" :title="__('Quiz Phases')"
            :count="GeneralHelper::numberFormat($quiz_phases_count)"></x-box>
    </div>
    <div class="!my-6 border-b"></div>
    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-4 sm:gap-4">
        <x-box color="primary" :href="route('dashboard.quiz')" icon="i-fluent-emoji-flat-abacus" :title="__('Number of :subject', ['subject' => __('Quizzes')])"
            :count="GeneralHelper::numberFormat($quizzes_count)"></x-box>
        <x-box color="primary" :href="route('dashboard.quiz')" icon="i-fluent-emoji-flat-abacus" :title="__('Draft Quizzes')"
            :count="GeneralHelper::numberFormat($draft_quizzes_count)"></x-box>
        <x-box color="primary" :href="route('dashboard.quiz')" icon="i-fluent-emoji-flat-abacus" :title="__('Available Quizzes')"
            :count="GeneralHelper::numberFormat($published_quizzes_count)"></x-box>
    </div>
    <div class="!my-6 border-b"></div>
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
    <div class="!my-6 border-b"></div>
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
    <div class="!my-6 border-b"></div>
    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-4 sm:gap-4">
        <div class="w-full p-6 overflow-hidden bg-white rounded-lg shadow-md sm:flex-1 lg:p-8">
            <div class="mb-5 text-lg font-bold text-center text-primary-500">
                {{ __('Five Recent of :type', ['type' => __('Student Learning Style')]) }}
            </div>
            <div class="max-h-[40dvh] overflow-auto">
                @forelse ($five_recent_of_student_learning_style as $assessment)
                    <div class="relative px-3 py-5 border-b cursor-pointer last:border-b-0 group">
                        <div class="font-semibold text-secondary-500 group-hover:text-secondary-950">
                            {{ $assessment->student->name }}
                        </div>
                        <div class="font-light">
                            {{ $assessment->student->school->name }}
                        </div>
                        <div class="font-light">
                            {{ $assessment->result->dominance->title }}
                        </div>
                        <a class="absolute inset-0" href="{{ route('dashboard.assessment.result', $assessment) }}"></a>
                    </div>
                @empty
                    <x-no-data />
                @endforelse
            </div>
        </div>
        <div class="w-full p-6 overflow-hidden bg-white rounded-lg shadow-md sm:flex-1 lg:p-8">
            <div class="mb-5 text-lg font-bold text-center text-primary-500">
                {{ __('Five Recent of :type', ['type' => __('Personality Type')]) }}
            </div>
            <div class="max-h-[40dvh] overflow-auto">
                @forelse ($five_recent_of_personality_type as $assessment)
                    <div class="px-3 py-5 border-b last:border-b-0">
                        <div class="font-semibold text-secondary-500">
                            {{ $assessment->student->name }}
                        </div>
                        <div class="font-light">
                            {{ $assessment->student->school->name }}
                        </div>
                        <div class="font-light">
                            {{ $assessment->result->dominance->title }}
                        </div>
                    </div>
                @empty
                    <x-no-data />
                @endforelse
            </div>
        </div>
        <div class="w-full p-6 overflow-hidden bg-white rounded-lg shadow-md sm:flex-1 lg:p-8">
            <div class="mb-5 text-lg font-bold text-center text-primary-500">
                {{ __('Five Recent of :type', ['type' => __('Keirsey Temperament Sorter')]) }}
            </div>
            <div class="max-h-[40dvh] overflow-auto">
                @forelse ($five_recent_of_keirsey_temperament_sorter as $assessment)
                    <div class="px-3 py-5 border-b last:border-b-0">
                        <div class="font-semibold text-secondary-500">
                            {{ $assessment->student->name }}
                        </div>
                        <div class="font-light">
                            {{ $assessment->student->school->name }}
                        </div>
                        <div class="font-light">
                            {{ $assessment->result->dominance->title }}
                        </div>
                    </div>
                @empty
                    <x-no-data />
                @endforelse
            </div>
        </div>
        <div class="w-full p-6 overflow-hidden bg-white rounded-lg shadow-md sm:flex-1 lg:p-8">
            <div class="mb-5 text-lg font-bold text-center text-primary-500">
                {{ __('Five Recent of :type', ['type' => __('Multiple Intelligence Type')]) }}
            </div>
            <div class="max-h-[40dvh] overflow-auto">
                @forelse ($five_recent_of_multiple_intelligence_type as $assessment)
                    <div class="px-3 py-5 border-b last:border-b-0">
                        <div class="font-semibold text-secondary-500">
                            {{ $assessment->student->name }}
                        </div>
                        <div class="font-light">
                            {{ $assessment->student->school->name }}
                        </div>
                        <div class="font-light">
                            {{ $assessment->result->dominance->title }}
                        </div>
                    </div>
                @empty
                    <x-no-data />
                @endforelse
            </div>
        </div>
    </div>
</div>
