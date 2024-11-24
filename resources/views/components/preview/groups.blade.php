<div class="w-full lg:max-w-[380px] 2xl:max-w-[450px]">
    <x-button base="mb-3" :href="request()->routeIs('dashboard.*')
        ? route('dashboard.quiz.show', $quiz)
        : route('assessment.show', $quiz)" color="primary" radius="rounded-full" :withBorderIcon="false" block
        icon="i-ph-arrow-left">
        {{ __('Back') }}
    </x-button>
    <div class="p-6 mb-4 rounded-lg shadow-md bg-primary-500 sm:p-8 dark:bg-slate-800">
        <div class="pb-3 mb-3 border-b">
            <div class="text-xl font-bold text-secondary-500">
                {{ $quiz->name }}
            </div>
            <div class="text-sm font-light text-white">
                {{ $quiz->description }}
            </div>
        </div>
        <div class="flex items-center gap-1 text-sm text-white">
            <span class="i-ph-line-segments-light"></span>
            <div class="flex-1 font-light truncate">
                {{ __($selectedQuizPhase) }}
            </div>
        </div>
        <div class="flex items-center gap-1 text-sm text-white">
            <span class="i-ph-stack-simple-light"></span>
            <div class="flex-1 font-light truncate">
                {{ __($selectedQuizCategory) }}
            </div>
        </div>
        <div class="flex items-center gap-1 text-sm text-white">
            <span class="i-ph-folder"></span>
            <div class="flex-1 font-light truncate">
                {{ __(Str::headline($quiz->type)) }}
            </div>
        </div>
        @if (auth()->user()->isAdmin)
            <div class="flex items-center gap-1 text-sm text-white">
                <span class="i-ph-folder"></span>
                <div class="flex-1 font-light truncate">
                    {{ __(Str::headline($quiz->assessmentRule->question_type)) }}
                </div>
            </div>
            <div class="flex items-center gap-1 text-sm text-white">
                <span class="i-ph-folder"></span>
                <div class="flex-1 font-light truncate">
                    {{ __(Str::headline($quiz->assessmentRule->typeName)) }}
                </div>
            </div>
        @endif
    </div>
    {{-- QUIZ GROUP --}}
    <div class="mb-4 overflow-hidden bg-white rounded-lg shadow-md">
        <ul x-data="{
            groupActive: '',
        }">
            @foreach ($quiz->groups as $group)
                <x-preview.group :$group />
            @endforeach
        </ul>
    </div>
    {{-- END QUIZ GROUP --}}
</div>
