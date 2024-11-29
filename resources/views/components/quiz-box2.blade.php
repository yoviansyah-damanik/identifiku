<div class="relative self-start pb-3 bg-white rounded-lg shadow-md group">
    <div @class([
        'relative aspect-[16/9] bg-primary-50 rounded-lg grid place-items-center overflow-hidden after:absolute after:bottom-0 after:inset-x-0 after:h-16 after:bg-gradient-to-t after:from-primary-500 after:to-transparent',
        'grayscale' => !$quiz->is_active,
    ])>
        <img src="{{ $quiz?->picture ?? Vite::image('default-quiz.webp') }}"
            class="w-full transition-all group-hover:scale-125" alt="{{ $quiz->name }} Picture" />
        <div class="absolute left-0 bottom-0 px-2 py-2 flex text-sm items-center gap-1 z-[1] text-white">
            <span class="i-ph-clock-thin"></span>
            <div class="font-light">
                {{ $quiz->created_at->diffForHumans() }}
            </div>
        </div>
    </div>
    <div class="px-3 ">
        <div class="mt-3 text-lg font-semibold text-primary-500 line-clamp-2 group-hover:text-secondary-500">
            {{ $quiz->name }}
        </div>
        <div class="flex items-center gap-1 mt-1 text-sm">
            <span class="i-ph-stack-simple-light"></span>
            <div class="flex-1 font-light truncate">
                {{ $quiz->category->name }}
            </div>
        </div>
        <div class="flex items-center gap-1 text-sm">
            <span class="i-ph-line-segments-light"></span>
            <div class="flex-1 font-light truncate">
                {{ $quiz->phase->name }}
                ({{ $quiz->phase->grades->pluck('name')->join(', ') }})
            </div>
        </div>
        <div class="flex items-center gap-1 text-sm">
            <span class="i-ph-folder"></span>
            <div class="flex-1 font-light truncate">
                {{ __(Str::headline($quiz->type)) }}
            </div>
        </div>
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-1 text-sm">
                <span class="i-ph-clock-countdown-light"></span>
                <div class="flex-1 font-light truncate">
                    {{ GeneralHelper::getTime($quiz->estimation_time) }}
                </div>
            </div>
            <div class="flex items-center gap-1 text-sm">
                <span class="i-ph-list-checks-light"></span>
                <div class="flex-1 font-light truncate">
                    {{ $quiz->questionsTotal }}
                    {{ $quiz->questionsTotal > 1 ? __('Questions') : __('Question') }}
                </div>
            </div>
        </div>
        <div class="flex items-center justify-between mt-3">
            <x-badge :type="$quiz->is_active ? 'success' : 'error'" size="sm">
                {{ $quiz->is_active ? __('Active') : __('Inactive') }}
            </x-badge>
            <div>
                <x-tooltip :title="__('Show')">
                    <x-button icon="i-ph-eye" color="cyan" size="sm"
                        href="{{ route('dashboard.quiz.show', $quiz->slug) }}" />
                </x-tooltip>
                <x-tooltip :title="__('Edit')">
                    <x-button icon="i-ph-pen" color="yellow" size="sm"
                        href="{{ route('dashboard.quiz.edit', $quiz->id) }}" />
                </x-tooltip>
            </div>
        </div>
    </div>
</div>
