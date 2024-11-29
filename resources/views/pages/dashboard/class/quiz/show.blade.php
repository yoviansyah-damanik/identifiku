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

    <div class="flex gap-3 sm:gap-4">
        <div class="w-full max-w-[700px]">
            <div class="p-6 bg-white rounded-lg sm:p-8 h-[50dvh] overflow-auto">
                @forelse ($assessments as $assessment)
                @empty
                    <x-no-data />
                @endforelse
            </div>
        </div>
        <div class="flex-1">
            <livewire:dashboard.class.quiz.result :$assessment />
        </div>
    </div>
</x-content>
