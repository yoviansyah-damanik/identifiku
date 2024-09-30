<x-content>
    <x-content.title :title="__('Quiz')" :description="__('Manage all quizzes.')" />

    <div class="box-border flex w-full gap-3 overflow-x-auto overflow-y-hidden snap-proximity snap-x">
        <x-button color="primary" icon="i-ph-plus" href="">
            {{ __('Add :add', ['add' => __('Quiz')]) }}
        </x-button>
        <x-form.select-with-search class="snap-start" searchVar="quizCategorySearch" :items="$quizCategories"
            wire:model="quizCategory" error="{{ $errors->first('quizCategory') }}" :withReset="true" :buttonText="__('Choose a :item', ['item' => __('Quiz Category')])" />
        <x-form.select-with-search class="snap-start" searchVar="quizPhaseSearch" :items="$quizPhases" wire:model="quizPhase"
            error="{{ $errors->first('quizPhase') }}" :withReset="true" :buttonText="__('Choose a :item', ['item' => __('Quiz Phase')])" />
        <x-form.input class="flex-1 min-w-48 snap-start" type="search" :placeholder="__('Search by :1', ['1' => __(':name Name', ['name' => __('Quiz')])])" block
            wire:model.live.debounce.750ms='search' />
    </div>

    <div class="flex-1 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-x-5 gap-y-7">
        @forelse ($quizzes as $quiz)
            <x-quiz-box :$quiz withBox />

        @empty
            <div class="col-span-full">
                <x-no-data />
            </div>
        @endforelse
        <div class="px-8 col-span-full py-3 bg-white dark:bg-slate-800 min-h-14 mt-9">
            {{ $quizzes->links() }}
        </div>
    </div>
</x-content>
