<x-content>
    <x-content.title :title="$class->name" :description="$class->description" />

    <div class="flex flex-col gap-3 lg:flex-row sm:gap-4">
        <div class="w-full min-w-[250px] lg:max-w-[25%] space-y-3 sm:space-y-4 lg:h-auto h-60 overflow-auto">
            @foreach ($class->quizzes as $quiz)
                <div @class([
                    'relative bg-white rounded-lg cursor-pointer overflow-hidden',
                    'before:z-0 before:absolute before:right-0 before:inset-y-0 before:w-1/4 before:bg-gradient-to-r before:from-transparent before:to-secondary-50' =>
                        $quiz->slug == $activeQuizUrl,
                ]) wire:click="setQuizActive('{{ $quiz->slug }}')">
                    <div class="relative p-6 sm:p-8">
                        <div class="font-semibold text-primary-500">
                            {{ $quiz->name }}
                        </div>
                        <div class="mt-1 font-light">
                            @php
                                $assessment = $quiz->assessments
                                    ->where('student_id', auth()->user()->student->id)
                                    ->first();
                            @endphp
                            @if ($assessment)
                                @if ($assessment->isDone)
                                    {{ __('You have completed this assessment') }}
                                @else
                                    @if ($assessment->started_on)
                                        {{ __('You can take this assessment with :minute minutes left', ['minute' => $assessment->remainingTime]) }}
                                    @else
                                        {{ __("You haven't started working on this yet, but the assessment has been registered") }}
                                    @endif
                                @endif
                            @else
                                {{ __('You have never done this assessment') }}
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="flex-1">
            <livewire:dashboard.student-class.show-quiz :$class :$activeQuizUrl />
        </div>
    </div>
</x-content>
