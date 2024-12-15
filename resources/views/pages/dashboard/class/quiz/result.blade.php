<div>
    @if ($assessment)
        @if ($assessment->result)
            <x-dynamic-component :component="'assessment.result.simple-' . $assessment->quiz->assessmentRule->type" :$assessment lazy />
        @else
            <div class="w-full p-6 text-center bg-white rounded-lg sm:p-8">
                {{ __('No results found yet') }}
            </div>
        @endif
    @else
        <div class="w-full p-6 text-center bg-white rounded-lg sm:p-8">
            {{ __('Please select Student to display the assessment results') }}
        </div>
    @endif
</div>
