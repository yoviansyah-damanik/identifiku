<div class="space-y-3 sm:space-y-4">
    <div class="relative w-full p-6 overflow-hidden rounded-lg shadow-md bg-primary-500 lg:p-8">
        <div class="mb-5 text-lg font-bold text-center text-secondary-500">
            {{ __('Dominance') }}
        </div>

        <div class="px-5 py-6 mb-5 bg-white rounded-lg">
            <div
                class="text-3xl font-bold text-center text-transparent bg-clip-text bg-gradient-to-br from-primary-500 to-secondary-500">
                {{ $assessment->result->dominance->title }}
            </div>
        </div>
        <div class="text-sm italic font-light text-center text-white">
            {{ __('Click to see more') }}
        </div>
        <a href="{{ route('dashboard.assessment.result', $assessment) }}" class="absolute inset-0"></a>
    </div>
</div>
