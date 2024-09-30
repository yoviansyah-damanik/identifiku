<div>
    <x-main.breadcrumb :breadcrumbs="[
        [
            'title' => __('Assessment'),
        ],
    ]" />

    <x-container>
        <div class="relative flex gap-5 items-start flex-col lg:flex-row">
            <div
                class="lg:sticky box-border lg:top-28 z-20 lg:w-72 flex-none w-full lg:space-y-3 flex gap-3 overflow-x-auto overflow-y-hidden snap-proximity snap-x lg:block">
                <x-form.input block class="flex-1 min-w-48 snap-start" type="search" :placeholder="__('Search by :1', [
                    '1' => __(':name Name', ['name' => __('Quiz')]),
                ])"
                    wire:model.live.debounce.750ms='search' />
                <x-form.select-with-search block class="snap-start" searchVar="quizCategorySearch" :items="$quizCategories"
                    wire:model="quizCategory" error="{{ $errors->first('quizCategory') }}" :withReset="true"
                    :buttonText="__('Choose a :item', ['item' => __('Quiz Category')])" />
                <x-form.select-with-search block class="snap-start" searchVar="quizPhaseSearch" :items="$quizPhases"
                    wire:model="quizPhase" error="{{ $errors->first('quizPhase') }}" :withReset="true"
                    :buttonText="__('Choose a :item', ['item' => __('Quiz Phase')])" />
            </div>
            <div class="flex-1 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-x-5 gap-y-7">
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
