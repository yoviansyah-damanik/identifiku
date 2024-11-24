<div class="p-6 overflow-hidden bg-white rounded-lg sm:p-8">
    @if ($activeQuiz)
        <div class="relative flex flex-col items-start gap-5 lg:flex-row">
            <div class="flex-none w-full gap-5 md:flex lg:block lg:sticky lg:top-24 lg:w-96">
                <div
                    class="relative md:w-[23rem] lg:w-full flex items-center justify-center aspect-[16/9] bg-primary-50 rounded-lg overflow-hidden">
                    <img src="{{ $activeQuiz?->picture ?? Vite::image('default-quiz.webp') }}"
                        class="h-full transition-all max-w-fit group-hover:scale-125"
                        alt="{{ $activeQuiz->name }} Picture" />
                </div>
                <div>
                    <div class="my-5">
                        <div class="flex items-center gap-1">
                            <span class="i-ph-stack-simple-light"></span>
                            <div class="flex-1 font-light truncate">
                                {{ $activeQuiz->category->name }}
                            </div>
                        </div>
                        <div class="flex items-center gap-1">
                            <span class="i-ph-line-segments-light"></span>
                            <div class="flex-1 font-light truncate">
                                {{ $activeQuiz->phase->name }}
                                ({{ $activeQuiz->phase->grades->pluck('name')->join(', ') }})
                            </div>
                        </div>
                        <div class="flex items-center gap-1">
                            <span class="i-ph-clock-countdown-light"></span>
                            <div class="flex-1 font-light truncate">
                                {{ GeneralHelper::numberFormat($activeQuiz->estimation_time) }}
                                {{ Str::lower(__('Minutes')) }}
                            </div>
                        </div>
                        <div class="flex items-center gap-1">
                            <span class="i-ph-clock-user"></span>
                            <div class="flex-1 font-light truncate">
                                {{ $activeQuiz->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <x-button color="primary-transparent" :withBorderIcon="false" radius="rounded-full" block
                            :href="route('dashboard.quiz.preview', $activeQuiz)" icon="i-ph-magnifying-glass-light">
                            {{ __('See Questions') }}
                        </x-button>
                        <x-button block color="primary" radius="rounded-full" wire:click="play" :withBorderIcon="false"
                            icon="i-ph-activity">
                            {{ __('Conduct Assessment') }}
                        </x-button>
                        <div class="text-sm italic text-center text-red-500 leading-0">
                            {{ __('A device with a screen width of at least 1280px is recommended') }}
                        </div>
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
            <div class="w-full">
                <h1 class="mb-5 text-2xl font-bold text-primary-500">{{ $activeQuiz->name }}</h1>

                <div class="space-y-3 sm:space-y-4 mb-7">
                    <div>
                        <div class="text-lg font-semibold text-secondary-500">
                            {{ __('Overview') }}
                        </div>
                        {!! $activeQuiz->overview !!}
                    </div>
                    <div>
                        <div class="text-lg font-semibold text-secondary-500">
                            {!! __('Content Coverage') !!}
                        </div>
                        {{ $activeQuiz->content_coverage }}
                    </div>
                    <div>
                        <div class="text-lg font-semibold text-secondary-500">
                            {{ __('Assessment Objectives') }}
                        </div>
                        {!! $activeQuiz->assessment_objectives !!}
                    </div>
                    <div>
                        <div class="text-lg font-semibold text-secondary-500">
                            {{ __('Question Composition') }}
                        </div>

                        <table class="w-full max-w-[35rem] text-start">
                            <tbody>
                                @foreach ($activeQuiz->groups as $idx => $group)
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
                                        {{ $activeQuiz->questionsTotal }}
                                        {{ $activeQuiz->questionsTotal > 1 ? __('Questions') : __('Question') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        {{ __('Please select the assessment first') }}
    @endif
</div>
