<x-content>
    <x-content.title :title="$class->name" :description="$class->description" />

    <div class="p-6 rounded-lg bg-primary-500 sm:p-8">
        <div class="font-bold text-secondary-500">
            {{ $quiz->name }}
        </div>
        <div class="mt-1 font-light text-secondary-50">
            {!! $quiz->overview !!}
        </div>
    </div>

    <div class="flex flex-col gap-3 lg:flex-row sm:gap-4">
        @if (count($assessments->items()) > 0 && $assessments->onFirstPage())
            <div class="w-full min-w-[250px] lg:max-w-[25%]">
                <div class="space-y-3 sm:space-y-4 max-h-[30dvh] lg:max-h-[50dvh] h-full overflow-auto">
                    @forelse ($assessments as $assessment)
                        <div @class([
                            'relative bg-white rounded-lg cursor-pointer overflow-hidden',
                            'before:z-0 before:absolute before:right-0 before:inset-y-0 before:w-1/4 before:bg-gradient-to-r before:from-transparent before:to-secondary-50' =>
                                $assessment->id == $activeAssessment,
                        ]) wire:click="setAssessmentActive('{{ $assessment->id }}')">
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
                                <div class="flex items-center justify-between">
                                    <div class="text-sm font-light">
                                        {{ $assessment->student->name }} / {{ $assessment->student->grade->name }}
                                    </div>

                                    @if ($assessment->isDone)
                                        <x-badge size="sm" type="success">
                                            {{ __('Done') }}
                                        </x-badge>
                                    @elseif($assessment->isProcess)
                                        <x-badge size="sm" type="info">
                                            {{ __('Process') }}
                                        </x-badge>
                                    @else
                                        <x-badge size="sm" type="warning">
                                            {{ __('Submitted') }}
                                        </x-badge>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <x-no-data />
                    @endforelse
                </div>
                @if ($assessments->hasPages())
                    <div class="mt-3 lg:mt-4">
                        {{ $assessments->links() }}
                    </div>
                @endif
            </div>
            <div class="flex-1">
                <livewire:dashboard.class.quiz.result />
            </div>
        @else
            <div class="flex-1 text-center">
                <x-no-data />
            </div>
        @endif
    </div>
</x-content>
