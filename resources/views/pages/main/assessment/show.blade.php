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
        <div class="relative flex flex-col items-start gap-5 lg:flex-row">
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
                            <span class="i-ph-clock-countdown-light"></span>
                            <div class="flex-1 font-light truncate">
                                {{ GeneralHelper::numberFormat($quiz->estimation_time) }}
                                {{ Str::lower(__('Minutes')) }}
                            </div>
                        </div>
                        <div class="flex items-center gap-1">
                            <span class="i-ph-clock-light"></span>
                            <div class="flex-1 font-light truncate">
                                {{ $quiz->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <x-button color="primary-transparent" :withBorderIcon="false" radius="rounded-full" block
                            :href="route('assessment.preview', $quiz->id)" icon="i-ph-magnifying-glass-light">
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
            <div class="block">
                <h1 class="mb-5 text-2xl font-bold text-primary-500">{{ $quiz->name }}</h1>

                <div class="space-y-4 mb-7">
                    <div class="space-y-1">
                        <div class="text-lg font-semibold text-secondary-500">
                            {{ __('Content Coverage') }}
                        </div>
                        {{ $quiz->content_coverage }}
                    </div>
                    <div class="space-y-1">
                        <div class="text-lg font-semibold text-secondary-500">
                            {{ __('Assessment Objectives') }}
                        </div>
                        {{ $quiz->assessment_objectives }}
                    </div>
                    <div class="space-y-1">
                        <div class="text-lg font-semibold text-secondary-500">
                            {{ __('Question Composition') }}
                        </div>
                        {{ $quiz->question_composition }}

                        <table class="w-full max-w-96 text-start">
                            <tbody>
                                @foreach ($quiz->types as $idx => $type)
                                    <tr class="font-semibold">
                                        <td>
                                            {{ $idx + 1 }}
                                        </td>
                                        <td colspan=2>
                                            {{ $type->name }}
                                        </td>
                                    </tr>
                                    @foreach ($type->questionsRecap as $idx_ => $recap)
                                        <tr>
                                            <td>
                                                {{ $idx + 1 }}.{{ $idx_ + 1 }}
                                            </td>
                                            <td>
                                                {{ $recap['type'] }}
                                            </td>
                                            <td>
                                                {{ $recap['count'] }}
                                                {{ $recap['count'] > 1 ? __('Questions') : __('Question') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                                <tr class="font-semibold">
                                    <td colspan=2>
                                        {{ __('Questions Total') }}
                                    </td>
                                    <td>
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
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-x-5 gap-y-7">
                    @forelse ($randomquizzes as $quiz)
                        <x-quiz-box :$quiz />
                    @empty
                        <x-no-data />
                    @endforelse
                </div>
            </div>
        </div>
    </x-container>
</div>
