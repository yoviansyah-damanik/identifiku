<div class="space-y-3 sm:space-y-4 lg:min-h-[50dvh]">
    @if ($activeGroup)
        <div class="p-6 mb-4 rounded-lg shadow-md bg-primary-500 sm:p-8 dark:bg-slate-800">
            <div class="text-xl font-bold text-secondary-500">
                {{ $activeGroup->name }}
            </div>
            <div class="text-sm font-light text-white">
                {{ $activeGroup->description }}
            </div>
        </div>

        <ul class="space-y-3 sm:space-y-4">
            @foreach ($activeGroup->questions as $question)
                <x-preview.question :$question />
            @endforeach
        </ul>
    @else
        <div class="text-center">
            {{ __('Please select the question group first') }}
        </div>
    @endif
</div>
