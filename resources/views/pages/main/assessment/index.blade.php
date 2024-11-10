<div>
    <x-main.breadcrumb :breadcrumbs="[
        [
            'title' => __('Assessment'),
        ],
    ]" />

    <x-container>
        <div class="relative flex flex-col items-start gap-5 lg:flex-row">
            <div
                class="box-border z-20 flex flex-none w-full gap-3 overflow-x-auto overflow-y-hidden lg:sticky lg:top-28 lg:w-72 lg:space-y-3 snap-proximity snap-x lg:block">
                <x-form.input block class="flex-1 min-w-48 snap-start" type="search" :placeholder="__('Search by :1', [
                    '1' => __(':name Name', ['name' => __('Quiz')]),
                ])"
                    wire:model.live.debounce.750ms='search' />
                <x-form.select-with-search class="snap-start" searchVar="quizCategorySearch" :items="$quizCategories"
                    wire:model="quizCategorySearch" error="{{ $errors->first('quizCategory') }}" :withReset="true"
                    :buttonText="__('Choose a :item', ['item' => __('Quiz Category')])" />
                <x-form.select-with-search class="snap-start" searchVar="quizPhaseSearch" :items="$quizPhases"
                    wire:model="quizPhaseSearch" error="{{ $errors->first('quizPhase') }}" :withReset="true"
                    :buttonText="__('Choose a :item', ['item' => __('Quiz Phase')])" />
            </div>
            <div class="grid flex-1 grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-x-5 gap-y-7">
                @forelse ($quizzes as $quiz)
                    <x-quiz-box :$quiz />
                @empty
                    <div class="col-span-full">
                        <x-no-data />
                    </div>
                @endforelse
                <div class="mt-7 col-span-full">
                    {{ $quizzes->links() }}
                </div>
            </div>
        </div>
    </x-container>
</div>
