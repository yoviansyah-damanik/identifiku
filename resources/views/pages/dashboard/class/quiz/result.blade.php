<div class="w-full p-6 bg-white rounded-lg sm:p-8">
    @if ($assessment)
        @if ($assessment->result)
            <x-dynamic-component :component="'assessment.result.simple-' . $assessment->quiz->assessmentRule->type" :$assessment lazy />
        @else
            <div class="text-center">
                {{ __('No results found yet') }}
            </div>
        @endif
    @else
        <div class="text-center">
            {{ __('Please select Student to display the assessment results') }}
        </div>
    @endif
</div>
