<div>
    <x-main.breadcrumb :breadcrumbs="[
        [
            'title' => __('Assessment'),
            'url' => route('assessment'),
        ],
        [
            'title' => $quiz->name,
        ],
    ]" />

    <x-container>
        <div class="relative flex flex-col gap-5 lg:flex-row">
            {{-- QUIZ INFORMATION --}}
            <div class="flex-none w-full gap-5 md:flex lg:block lg:sticky lg:top-24 lg:w-96">
                <div
                    class="relative md:w-[23rem] lg:w-full flex items-center justify-center aspect-[16/9] bg-primary-50 rounded-lg overflow-hidden">
                    <img src="{{ $quiz?->picture ?? Vite::image('default-quiz.webp') }}"
                        class="h-full transition-all max-w-fit group-hover:scale-125" alt="{{ $quiz->name }} Picture" />
                </div>
                <div>
                    <div class="my-5">
                        <div class="flex items-center gap-1">
                            <span class="i-ph-stack-simple-light"></span>
                            <div class="flex-1 font-light truncate">
                                {{ $quiz->category->name }}
                            </div>
                        </div>
                        <div class="flex items-center gap-1">
                            <span class="i-ph-line-segments-light"></span>
                            <div class="flex-1 font-light truncate">
                                {{ $quiz->phase->name }} ({{ $quiz->phase->grades->pluck('name')->join(', ') }})
                            </div>
                        </div>
                        <div class="flex items-center gap-1">
                            <span class="i-ph-folder"></span>
                            <div class="flex-1 font-light truncate">
                                {{ __(Str::headline($quiz->type)) }}
                            </div>
                        </div>
                        @if (auth()->check() && auth()->user()->isAdmin)
                            <div class="flex items-center gap-1">
                                <span class="i-ph-folder"></span>
                                <div class="flex-1 font-light truncate">
                                    {{ __(Str::headline($quiz->assessmentRule->question_type)) }}
                                </div>
                            </div>
                            <div class="flex items-center gap-1">
                                <span class="i-ph-list"></span>
                                <div class="flex-1 font-light truncate">
                                    {{ $quiz->assessmentRule->typeName }}
                                </div>
                            </div>
                        @endif
                        <div class="flex items-center gap-1">
                            <span class="i-ph-clock-countdown-light"></span>
                            <div class="flex-1 font-light truncate">
                                {{ GeneralHelper::getTime($quiz->estimation_time) }}
                            </div>
                        </div>
                        {{-- <div class="flex items-center gap-1">
                            <span class="i-ph-clock-user"></span>
                            <div class="flex-1 font-light truncate">
                                {{ $quiz->created_at->diffForHumans() }}
                            </div>
                        </div> --}}
                    </div>
                    <div class="space-y-3">
                        <x-button color="primary-transparent" :withBorderIcon="false" radius="rounded-full" block
                            :href="route('assessment.preview', $quiz)" icon="i-ph-magnifying-glass-light">
                            {{ __('See Questions') }}
                        </x-button>
                        {{-- @if (auth()->check())
                            @if (auth()->user()->roleName == 'Student')
                                <x-button block color="primary" radius="rounded-full" icon="i-ph-activity">
                                    {{ __('Conduct Assessment') }}
                                </x-button>
                            @else
                                <x-badge type="error">
                                    {{ __('Student Only') }}
                                </x-badge>
                            @endif
                        @else
                            <div class="text-center">
                                {{ __('You can take this assessment after you log in.') }}
                                <x-href href="{{ route('login') }}">{{ __('Click here') }}</x-href>.
                            </div>
                        @endif --}}
                    </div>
                </div>
            </div>
            <div class="w-full my-5 border-b lg:hidden"></div>
            {{-- QUIZ EXPLANATION --}}
            <div class="w-full">
                <h1 class="mb-5 text-2xl font-bold text-center lg:text-start text-primary-500">{{ $quiz->name }}</h1>

                <div class="space-y-3 sm:space-y-4 mb-7">
                    <div>
                        <div class="text-lg font-semibold text-secondary-500">
                            {{ __('Overview') }}
                        </div>
                        <div class="trix-zone">
                            {!! $quiz->overview !!}
                        </div>
                    </div>
                    <div>
                        <div class="text-lg font-semibold text-secondary-500">
                            {!! __('Content Coverage') !!}
                        </div>
                        <div class="trix-zone">
                            {!! $quiz->content_coverage !!}
                        </div>
                    </div>
                    <div>
                        <div class="text-lg font-semibold text-secondary-500">
                            {{ __('Assessment Objectives') }}
                        </div>
                        <div class="trix-zone">
                            {!! $quiz->assessment_objectives !!}
                        </div>
                    </div>
                    <div>
                        <div class="text-lg font-semibold text-secondary-500">
                            {{ __('Question Composition') }}
                        </div>

                        <table class="w-full max-w-[35rem] text-start">
                            <tbody>
                                @foreach ($quiz->groups as $idx => $group)
                                    <tr>
                                        <td class="w-12 px-3 py-1">
                                            {{ $idx + 1 }}
                                        </td>
                                        <td class="px-3 py-1">
                                            {{ $group->name }}
                                        </td>
                                        <td class="px-3 py-1">
                                            {{ GeneralHelper::numberFormat($group->questions_count) }}
                                            {{ $group->questions_count > 1 ? __('Questions') : __('Question') }}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr class="font-semibold">
                                    <td colspan=2 class="px-3 py-1">
                                        {{ __('Questions Total') }}
                                    </td>
                                    <td class="px-3 py-1">
                                        {{ $quiz->questionsTotal }}
                                        {{ $quiz->questionsTotal > 1 ? __('Questions') : __('Question') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mb-1 text-lg font-semibold text-secondary-500">
                    {{ __('Assessment Recommendation') }}
                </div>
                <div class="grid grid-cols-2 xl:grid-cols-3 gap-x-5 gap-y-7">
                    @forelse ($randomquizzes as $quiz)
                        <div class="">
                            <x-quiz-box :$quiz />
                        </div>
                    @empty
                        <div class="col-span-full">
                            <x-no-data />
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </x-container>
</div>
