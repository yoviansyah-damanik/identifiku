<div @class([
    'relative group',
    'bg-white rounded-lg shadow-lg' => $withBox,
])>
    <div
        class="relative aspect-[16/9] bg-primary-50 rounded-lg grid place-items-center overflow-hidden after:absolute after:bottom-0 after:inset-x-0 after:h-16 after:bg-gradient-to-t after:from-primary-500 after:to-transparent">
        <img src="{{ $quiz?->picture ?? Vite::image('default-quiz.webp') }}"
            class="w-full transition-all group-hover:scale-125" alt="{{ $quiz->name }} Picture" />
        <div class="absolute left-0 bottom-0 px-2 py-2 flex text-sm items-center gap-1 z-[1] text-white">
            <span class="i-ph-clock-thin"></span>
            <div class="font-light">
                {{ $quiz->created_at->diffForHumans() }}
            </div>
        </div>
    </div>
    <div class="px-1 py-5 lg:px-3 md:px-2 xl:px-5">
        <div
            class="text-lg leading-6 font-semibold text-primary-500 line-clamp-2 group-hover:text-secondary-500 h-[2lh]">
            {{ $quiz->name }}
        </div>
        <div class="my-3 border-b"></div>
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
        <div class="flex items-center gap-1 text-sm">
            <span class="i-ph-list"></span>
            <div class="flex-1 font-light truncate">
                {{ $quiz->assessmentRule->typeName }}
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
        <div class="my-3 border-b"></div>
        <div class="flex items-center justify-end gap-1">
            @haspermission('quiz show')
                <x-tooltip :title="__('Show')">
                    <x-button icon="i-ph-eye" color="cyan" size="sm"
                        href="{{ route('dashboard.quiz.show', $quiz->slug) }}" />
                </x-tooltip>
            @endhaspermission
            @haspermission('quiz add')
                <x-tooltip :title="__('Add')">
                    <x-button icon="i-ph-plus" x-on:click="$dispatch('toggle-add-quiz-modal')"
                        wire:click="$dispatch('setAddQuiz',{quiz:'{{ $quiz->slug }}'})" color="primary" size="sm" />
                </x-tooltip>
            @endhaspermission
        </div>
    </div>
</div>
