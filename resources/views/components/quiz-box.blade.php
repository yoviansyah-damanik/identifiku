<div @class([
    'relative group',
    'bg-white rounded-lg pb-3 shadow-md' => $withBox,
])>
    <div
        class="relative aspect-[16/9] bg-primary-50 rounded-lg grid place-items-center overflow-hidden after:absolute after:bottom-0 after:inset-x-0 after:h-16 after:bg-gradient-to-t after:from-primary-500 after:to-transparent">
        <img src="{{ $quiz?->picture ?? Vite::image('default-quiz.webp') }}"
            class="w-full group-hover:scale-125 transition-all" alt="{{ $quiz->name }} Picture" />
        <div class="absolute left-0 bottom-0 px-2 py-2 flex text-xs items-center gap-1 z-[1] text-white">
            <span class="i-ph-clock-thin"></span>
            <div class="font-light">
                {{ $quiz->created_at->diffForHumans() }}
            </div>
        </div>
    </div>
    <div class="lg:px-3 md:px-2 px-1">
        <div class="line-clamp-2 mt-3 group-hover:text-secondary-500 font-semibold">
            {{ $quiz->name }}
        </div>
        <div class="flex text-xs items-center gap-1 mt-1">
            <span class="i-ph-stack-simple-light"></span>
            <div class="font-light flex-1 truncate">
                {{ $quiz->category->name }}
            </div>
        </div>
        <div class="flex text-xs items-center gap-1">
            <span class="i-ph-line-segments-light"></span>
            <div class="font-light flex-1 truncate">
                {{ $quiz->phase->name }}
                ({{ $quiz->phase->grades->pluck('name')->join(', ') }})
            </div>
        </div>
        <div class="flex justify-between items-center">
            <div class="flex text-xs items-center gap-1">
                <span class="i-ph-clock-countdown-light"></span>
                <div class="font-light flex-1 truncate">
                    {{ GeneralHelper::numberFormat($quiz->estimation_time) }}
                    {{ Str::lower(__('Minutes')) }}
                </div>
            </div>
            <div class="flex text-xs items-center gap-1">
                <span class="i-ph-list-checks-light"></span>
                <div class="font-light flex-1 truncate">
                    {{ $quiz->questionsTotal }}
                    {{ $quiz->questionsTotal > 1 ? __('Questions') : __('Question') }}
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('assessment.show', $quiz->id) }}" class="absolute inset-0" wire:navigate></a>
</div>
