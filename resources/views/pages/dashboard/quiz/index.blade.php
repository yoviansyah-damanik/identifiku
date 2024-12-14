<x-content>
    <x-content.title :title="__('Quiz')" :description="__('Manage :manage.', ['manage' => __('Quiz')])" />

    <div class="box-border flex w-full gap-3 overflow-x-auto overflow-y-hidden snap-proximity snap-x">
        <x-button color="primary" icon="i-ph-plus" href="{{ route('dashboard.quiz.create') }}">
            {{ __('Add :add', ['add' => __('Quiz')]) }}
        </x-button>
        <x-form.select class="snap-start" :items="$statuses" wire:model.live='status' />
        <x-form.select-with-search class="snap-start" searchVar="quizCategorySearch" :items="$quizCategories"
            wire:model="quizCategorySearch" error="{{ $errors->first('quizCategory') }}" :withReset="true"
            :buttonText="__('Choose a :item', ['item' => __('Quiz Category')])" />
        <x-form.select-with-search class="snap-start" searchVar="quizPhaseSearch" :items="$quizPhases"
            wire:model="quizPhaseSearch" error="{{ $errors->first('quizPhase') }}" :withReset="true"
            :buttonText="__('Choose a :item', ['item' => __('Quiz Phase')])" />
        <x-form.input class="flex-1 min-w-48 snap-start" type="search" :placeholder="__('Search by :1', ['1' => __(':name Name', ['name' => __('Quiz')])])" block
            wire:model.live.debounce.750ms='search' />
    </div>

    <div class="grid flex-1 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-x-5 gap-y-7">
        @forelse ($quizzes as $quiz)
            <x-quiz-box2 :$quiz />
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
            <x-modal name="delete-quiz-modal" size="xl" :modalTitle="__('Delete :delete', ['delete' => __('Quiz')])">
                <livewire:dashboard.quiz.delete />
            </x-modal>
            <x-modal name="restore-quiz-modal" size="xl" :modalTitle="__('Restore :restore', ['restore' => __('Quiz')])">
                <livewire:dashboard.quiz.restore />
            </x-modal>
        </div>
    </template>
</x-content>
