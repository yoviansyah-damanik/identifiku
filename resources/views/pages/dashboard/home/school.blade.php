<div class="space-y-3 sm:space-y-4">
    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-4 sm:gap-4">
        <x-box color="primary" :href="route('dashboard.student')" icon="i-fluent-emoji-flat-man-student" :title="__('Students')"
            :count="GeneralHelper::numberFormat($students_count)"></x-box>
        <x-box color="primary" :href="route('dashboard.teacher')" icon="i-fluent-emoji-flat-man-teacher" :title="__('Teachers')"
            :count="GeneralHelper::numberFormat($teachers_count)"></x-box>
        <x-box color="primary" :href="route('dashboard.class')" icon="i-fluent-emoji-flat-door" :title="__('Classes')"
            :count="GeneralHelper::numberFormat($classes_count)"></x-box>
    </div>
    <div class="!my-6 border-b"></div>
    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-4 sm:gap-4">
        <x-box color="primary" :href="route('dashboard.student.request')" icon="i-fluent-emoji-flat-man-student" :title="__('Student Requests')"
            :count="GeneralHelper::numberFormat($student_requests_count)"></x-box>
        <x-box color="primary" :href="route('dashboard.teacher.request')" icon="i-fluent-emoji-flat-man-teacher" :title="__('Teacher Requests')"
            :count="GeneralHelper::numberFormat($teacher_requests_count)"></x-box>
    </div>
    <div class="!my-6 border-b"></div>
    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-4 sm:gap-4">
        <x-box color="primary" :href="route('dashboard.quiz.available')" icon="i-fluent-emoji-flat-abacus" :title="__('Available Quizzes')"
            :count="GeneralHelper::numberFormat($quizzes_count)"></x-box>
        <x-box color="primary" :href="route('dashboard.assessment.students')" icon="i-fluent-emoji-flat-bookmark-tabs" :title="__('Student Assessments')"
            :count="GeneralHelper::numberFormat($assessments_count)"></x-box>
    </div>
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
