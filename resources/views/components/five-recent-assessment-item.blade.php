<div
    class="relative px-6 py-2 overflow-hidden border-b rounded-lg cursor-pointer sm:px-8 bg-gray-50 hover:bg-primary-50 last:border-b-0 group">
    <div class="font-semibold text-primary-500">
        {{ $assessment->student->name }}
    </div>
    <div class="font-light">
        {{ $assessment->class->name }}
    </div>
    @if (auth()->user()->isAdmin)
        <div class="font-light">
            {{ $assessment->student->school->name }}
        </div>
    @endif
    <div class="font-semibold text-secondary-500">
        {{ $assessment->result->dominance->title }}
    </div>
    <a class="absolute inset-0" href="{{ route('dashboard.assessment.result', $assessment) }}"></a>
</div>
