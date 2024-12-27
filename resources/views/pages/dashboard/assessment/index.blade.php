<x-content>
    <x-content.title :title="__('Assessment')" :description="__('Assessment')" />

    <div class="box-border flex w-full gap-3 overflow-x-auto overflow-y-hidden snap-proximity snap-x">
        <x-form.select class="snap-start" :items="$perPageList" wire:model.live='perPage' />
        <x-form.input class="flex-1 min-w-48 snap-start" type="search" :placeholder="__('Search by :1', ['1' => __(':name Name', ['name' => __('Assessment')])])" block
            wire:model.live.debounce.750ms='search' wire:change="$dispatch('setRefreshActiveAssessment')" />
    </div>

    <div class="flex flex-col gap-3 lg:flex-row sm:gap-4">
        @if (count($hasQuizzes->items()) > 0 && $hasQuizzes->onFirstPage())
            <div class="w-full min-w-[250px] lg:max-w-[25%]">
                <div @class([
                    'space-y-3 sm:space-y-4 max-h-[30dvh] lg:max-h-[60dvh] h-full overflow-auto',
                    'lg:!max-h-[55dvh]' => $hasQuizzes->hasPages(),
                ])>
                    @forelse ($hasQuizzes as $hasQuiz)
                        @php
                            $assessment = $hasQuiz->quiz->assessments
                                ->where('student_id', auth()->user()->student->id)
                                ->where('student_class_id', $hasQuiz->class->id)
                                ->first();
                        @endphp
                        <div @class([
                            'relative bg-white rounded-lg cursor-pointer overflow-hidden',
                            'before:z-0 before:absolute before:right-0 before:inset-y-0 before:w-1/4 before:bg-gradient-to-r before:from-transparent before:to-secondary-50' =>
                                $hasQuiz->id == $activeAssessment,
                        ])
                            wire:click="setAssessmentActive('{{ $hasQuiz->id }}','{{ $hasQuiz->quiz->slug }}','{{ $hasQuiz->class->slug }}')">
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
                                    {{ $hasQuiz->quiz->name }}
                                </div>
                                <div class="font-light">
                                    {{ $hasQuiz->class->name }}
                                </div>
                                <div class="font-semibold">
                                    {{ __(Str::headline($hasQuiz->quiz->type)) }}
                                </div>
                                {{-- <div class="font-light">
                                    {{ collect(QuizHelper::getAssessmentRuleType())->where('value', $hasQuiz->quiz->assessmentRule->type)->first()['title'] }}
                                </div> --}}
                            </div>
                        </div>
                    @empty
                        <x-no-data />
                    @endforelse
                </div>
                <div class="mt-5">
                    {{ $hasQuizzes->links() }}
                </div>
            </div>
            <div class="flex-1">
                <livewire:dashboard.assessment.show-quiz lazy />
            </div>
        @else
            <div class="flex-1 text-center">
                <x-no-data />
            </div>
        @endif
    </div>
</x-content>
