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

    <div class="w-full p-6 overflow-hidden bg-white rounded-lg shadow-md lg:p-8">
        <div class="mb-5 text-lg font-bold text-center text-primary-500">
            {{ __('Assessment Result') }}
        </div>
        <div class="flex flex-col gap-3 lg:flex-row lg:gap-4">
            <div class="flex-1 space-y-3 lg:space-y-4">
                @foreach ($assessment->result->details as $detail)
                    <div>
                        <div class="flex items-center justify-between gap-3 mb-1 lg:gap-4">
                            <div class="font-semibold">
                                {{ $detail->title }}
                            </div>
                            <div class="text-sm">
                                {{ GeneralHelper::numberFormat(($detail->score / $assessment->result->details->sum('score')) * 100) }}%
                            </div>
                        </div>
                        <div class="relative w-full h-4 overflow-hidden rounded-full shadow bg-red-50">
                            <div style="width: {{ ($detail->score / $assessment->result->details->sum('score')) * 100 > 0 ? ($detail->score / $assessment->result->details->sum('score')) * 100 . '%' : '0px' }}"
                                class="h-full bg-red-500 rounded-full">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
