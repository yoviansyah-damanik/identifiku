<x-content>
    <x-content.title :title="$class->name" :description="$class->description" />

    <div class="flex flex-col gap-3 lg:flex-row sm:gap-4">
        <div class="w-full min-w-[250px] lg:max-w-[25%]">
            <div class="space-y-3 sm:space-y-4 max-h-[30dvh] lg:max-h-[55dvh] h-full overflow-auto">
                @foreach ($class->quizzes as $quiz)
                    @php
                        $assessment = $quiz->assessments
                            ->where('student_id', auth()->user()->student->id)
                            ->where('student_class_id', $class->id)
                            ->first();
                    @endphp

                    <div @class([
                        'relative bg-white rounded-lg cursor-pointer overflow-hidden',
                        'before:z-0 before:absolute before:right-0 before:inset-y-0 before:w-1/4 before:bg-gradient-to-r before:from-transparent before:to-secondary-50' =>
                            $quiz->slug == $activeQuizUrl,
                    ]) wire:click="setQuizActive('{{ $quiz->slug }}')">
                        <div class="relative p-6 sm:p-8">
                            <div @class([
                                'font-semibold truncate',
                                'text-primary-500' => !$assessment,
                                '!text-green-500' => $assessment && $assessment->isDone,
                                'text-yellow-500' =>
                                    $assessment &&
                                    (!is_null($assessment->remainingTime) &&
                                        $assessment->remainingTime > 0),
                                'text-red-500' =>
                                    $assessment &&
                                    (!is_null($assessment->remainingTime) &&
                                        $assessment->remainingTime == 0),
                                'text-blue-500' => $assessment && is_null($assessment->remainingTime),
                            ])>
                                {{ $quiz->name }}
                            </div>
                            <div class="font-light">
                                @if ($assessment)
                                    @if ($assessment->isDone)
                                        <div class="text-green-500">
                                            {{ __('Assessment result completed') }}
                                        </div>
                                    @elseif ($assessment->isSubmitted)
                                        <span class="text-yellow-500">
                                            {{ __('You have completed this assessment') }}!
                                        </span>
                                        {{ __('Assessment results are being processed') }}
                                    @else
                                        @if (is_null($assessment->remainingTime))
                                            <div class="text-blue-500">
                                                {{ __('Assessments have been made, but not yet started') }}
                                            </div>
                                        @else
                                            @if ($assessment->remainingTime > 0)
                                                <div class="text-yellow-600">
                                                    {{ __('You can take this assessment with :minute minutes left', ['minute' => $assessment->remainingTime]) }}
                                                </div>
                                            @elseif($assessment->remainingTime == 0)
                                                <span class="text-red-500">
                                                    {{ __('Time is up') }}!
                                                </span>
                                                {{ __('Assessment results are being processed') }}
                                            @endif
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
        </div>
        <div class="flex-1">
            <livewire:dashboard.student-class.show-quiz :$class :$activeQuizUrl lazy />
        </div>
    </div>
</x-content>
