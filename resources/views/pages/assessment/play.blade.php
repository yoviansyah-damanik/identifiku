<div class="lg:h-full">
    <div class="flex flex-col lg:h-full lg:flex-row">
        <div class="relative flex flex-col shadow lg:w-80 xl:w-96">
            <div class="flex lg:block">
                <x-button base="flex justify-center items-center gap-1 lg:w-full w-14" size="sm" :href="route('dashboard.student-class.show', [
                    'class' => $assessment->class,
                    'activeQuizUrl' => $assessment->quiz->slug,
                ])"
                    color="secondary" radius="rounded-none">
                    <span class="i-ph-arrow-left"></span>
                    <span class="hidden lg:block">
                        {{ __('Back') }}
                    </span>
                </x-button>
                <div class="flex-1 px-6 py-4 text-sm sm:px-8 lg:py-8 bg-gradient-to-br from-primary-500 to-primary-700">
                    <div class="flex">
                        <div class="font-semibold w-28 text-secondary-500">
                            {{ __(':name Name', ['name' => __('Class')]) }}
                        </div>
                        <div class="flex-1 text-secondary-50">
                            {{ $assessment->class->name }}
                        </div>
                    </div>
                    <div class="flex">
                        <div class="font-semibold w-28 text-secondary-500">
                            {{ __(':name Name', ['name' => __('Quiz')]) }}
                        </div>
                        <div class="flex-1 text-secondary-50">
                            {{ $assessment->quiz->name }}
                        </div>
                    </div>
                    <div class="flex">
                        <div class="font-semibold w-28 text-secondary-500">
                            {{ __(':type Type', ['type' => __('Quiz')]) }}
                        </div>
                        <div class="flex-1 text-secondary-50">
                            {{ __(Str::headline($assessment->quiz->type)) }}
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="flex flex-col flex-1 w-full px-6 py-4 space-y-3 bg-white shadow lg:shadow-none lg:relative lg:left-auto sm:px-8 lg:py-8 sm:space-y-4">
                <div class="flex-1 ">
                    <div
                        class="flex gap-8 overflow-auto lg:space-y-4 lg:overflow-clip lg:gap-0 lg:block snap-x lg:snap-none">
                        @foreach ($assessment->quiz->groups as $group)
                            <div class="space-y-3 snap-start lg:snap-none">
                                <div class="font-semibold text-primary-500 text-nowrap">
                                    {{ GeneralHelper::numberToRoman($group->order) }}.
                                    {{ $group->name }}
                                </div>
                                <div class="flex gap-1 lg:flex-wrap snap-x lg:snap-none">
                                    @foreach ($group->questions as $question)
                                        <x-button square base="snap-start lg:snap-none w-8" size="sm"
                                            color="primary-transparent">
                                            {{ $loop->iteration }}
                                        </x-button>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col justify-between gap-3 overflow-auto lg:flex-1 sm:gap-4">
            <div
                class="flex px-6 py-4 mb-3 text-base font-semibold lg:text-xl xl:text-2xl lg:py-8 bg-primary-50 text-primary-500">
                <div class="w-6 lg:w-12">
                    I.
                </div>
                <div class="flex-1">
                    Tes 123
                </div>
            </div>
            <div class="flex items-start flex-1 min-h-[min-content] px-6 py-4 pb-20 overflow-auto lg:py-8">
                <div class="w-full">
                    <div class="flex">
                        <div class="w-6 text-base font-semibold lg:text-xl xl:text-2xl lg:w-12">
                            1.
                        </div>
                        <div class="flex-1 text-base lg:text-lg xl:text-xl">
                            <div class="mb-3 font-semibold">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis, deserunt sunt?
                            </div>
                            <div class="md:[column-count:2] [column-gap:1.5rem]">
                                <div class="flex">
                                    <div class="w-14">
                                        A
                                    </div>
                                    <div class="flex-1 text-start">
                                        Tes
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="w-14">
                                        B
                                    </div>
                                    <div class="flex-1 text-start">
                                        Tes
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="w-14">
                                        C
                                    </div>
                                    <div class="flex-1 text-start">
                                        Tes
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="w-14">
                                        D
                                    </div>
                                    <div class="flex-1 text-start">
                                        Tes
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="fixed inset-x-0 bottom-0 flex items-stretch justify-end lg:p-8 lg:gap-3 lg:relative">
                <div class="flex items-stretch justify-center flex-1 lg:flex-none lg:gap-1">
                    <x-button base="lg:!rounded-full rounded-none" color="red" block icon="i-ph-arrow-left"
                        :withBorderIcon="false">
                        <span class="hidden lg:block">{{ __('Previous') }}</span>
                        <span class="block lg:hidden"></span>
                    </x-button>
                    <x-button base="lg:!rounded-full rounded-none" color="green" block icon="i-ph-arrow-right"
                        iconPosition="right" :withBorderIcon="false">
                        <span class="hidden lg:block">{{ __('Next') }}</span>
                        <span class="block lg:hidden"></span>
                    </x-button>
                </div>
                <x-button :loading="true" base="max-w-52 lg:max-w-64 lg:!rounded-full rounded-none" block
                    color="primary">
                    {{ __('Submit') }}
                </x-button>
            </div>
        </div>
    </div>
</div>
