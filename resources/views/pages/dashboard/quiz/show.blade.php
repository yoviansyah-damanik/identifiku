<x-content>
    <div class="relative flex flex-col justify-start gap-5 p-6 bg-white rounded-lg lg:flex-row">
        <div class="flex-none w-full gap-5 md:flex lg:block lg:sticky lg:top-24 lg:w-96">
            <div
                class="relative md:w-[23rem] lg:w-full aspect-[16/9] bg-primary-50 rounded-lg grid place-items-center overflow-hidden">
                <img src="{{ $quiz?->picture ?? Vite::image('default-quiz.webp') }}"
                    class="w-full transition-all group-hover:scale-125" alt="{{ $quiz->name }} Picture" />
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
                    <div class="flex items-center gap-1">
                        <span class="i-ph-list"></span>
                        <div class="flex-1 font-light truncate">
                            {{ $quiz->assessmentRule->typeName }}
                        </div>
                    </div>
                    <div class="flex items-center gap-1">
                        <span class="i-ph-clock-countdown-light"></span>
                        <div class="flex-1 font-light truncate">
                            {{ GeneralHelper::getTime($quiz->estimation_time) }}
                        </div>
                    </div>
                    @if (auth()->user()->isAdmin)
                        <div class="flex items-center gap-1">
                            <span class="i-ph-clock-user"></span>
                            <div class="flex-1 font-light truncate">
                                {{ $quiz->created_at->diffForHumans() }}
                            </div>
                        </div>
                    @endif
                </div>
                <div class="space-y-3">
                    <x-button color="primary-transparent" :withBorderIcon="false" radius="rounded-full" block
                        :href="route('dashboard.quiz.preview', $quiz)" icon="i-ph-magnifying-glass-light">
                        {{ __('See Questions') }}
                    </x-button>
                    @haspermission('quiz edit')
                        <x-button color="yellow" radius="rounded-full" block :href="route('dashboard.quiz.edit', $quiz)">
                            {{ __('Edit') }}
                        </x-button>
                    @endhaspermission
                </div>
            </div>
        </div>
        <div class="w-full my-5 border-b lg:hidden"></div>
        <div class="flex-1">
            <h1 class="mb-5 text-2xl font-bold text-primary-500">{{ $quiz->name }}</h1>

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
        </div>
    </div>
</x-content>
