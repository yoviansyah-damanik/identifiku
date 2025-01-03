<x-content>
    <x-content.title :title="__('Available Quiz')" :description="__('Manage :manage.', ['manage' => __('Available Quiz')])" />

    <div class="box-border flex w-full gap-3 overflow-x-auto overflow-y-hidden snap-proximity snap-x">
        <x-form.select-with-search class="snap-start" searchVar="quizCategorySearch" :items="$quizCategories"
            wire:model="quizCategorySearch" error="{{ $errors->first('quizCategory') }}" :withReset="true"
            :buttonText="__('Choose a :item', ['item' => __('Quiz Category')])" />
        <x-form.select-with-search class="snap-start" searchVar="quizPhaseSearch" :items="$quizPhases"
            wire:model="quizPhaseSearch" error="{{ $errors->first('quizPhase') }}" :withReset="true" :buttonText="__('Choose a :item', ['item' => __('Quiz Phase')])" />
        <x-form.input class="flex-1 min-w-48 snap-start" type="search" :placeholder="__('Search by :1', ['1' => __(':name Name', ['name' => __('Quiz')])])" block
            wire:model.live.debounce.750ms='search' />
    </div>

    <div class="grid flex-1 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-x-5 gap-y-7">
        @forelse ($quizzes as $quiz)
            <x-available-quiz-box :$quiz withBox />
        @empty
            <div class="col-span-full">
                <x-no-data />
            </div>
        @endforelse

        @if ($quizzes->hasPages())
            <div class="px-8 py-3 bg-white col-span-full dark:bg-slate-800 min-h-14 mt-9">
                {{ $quizzes->links() }}
            </div>
        @endif
    </div>

    <template x-teleport="body">
        <div wire:ignore>
            @haspermission('quiz add')
                <x-modal name="add-quiz-modal" size="2xl" :modalTitle="__('Add :add', ['add' => __('Quiz')])">
                    <livewire:dashboard.quiz.add />
                </x-modal>
            @endhaspermission
        </div>
    </template>
</x-content>
