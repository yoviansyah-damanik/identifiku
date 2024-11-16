<x-content>
    <ol
        class="flex flex-col justify-around overflow-hidden text-sm font-medium text-center text-gray-500 bg-white border border-gray-200 rounded-lg shadow lg:items-center lg:flex-row dark:text-gray-400 sm:text-base dark:bg-gray-800 dark:border-gray-700 rtl:space-x-reverse">
        @foreach ($steps as $item)
            <li @class([
                'flex items-center justify-center flex-1 p-4 cursor-not-allowed  border-r last:border-r-0',
                'bg-primary-500 text-primary-100' => $item['step'] == $step,
            ])>
                <div @class([
                    'flex items-center justify-center w-8 h-8 text-xs rounded-full me-2 shrink-0 bg-gray-500 text-gray-100',
                    '!bg-green-500 !text-green-100' => $step > $item['step'],
                    '!bg-secondary-500 !text-secondary-100' => $item['step'] == $step,
                ])>
                    @if ($item['step'] > $step)
                        {{ $item['step'] }}
                    @elseif($item['step'] == $step)
                        <span class="i-ph-person-simple-run"></span>
                    @else
                        <span class="i-ph-check"></span>
                    @endif
                </div>
                <div class="text-start">
                    <div @class([
                        'text-gray-500 font-bold',
                        'text-green-600 dark:text-green-500' => $step > $item['step'],
                        'text-secondary-600 dark:text-secondary-500' => $item['step'] == $step,
                    ])>
                        {{ $item['title'] }}
                    </div>
                    <div class="hidden text-sm font-light lg:block">
                        {{ $item['description'] }}
                    </div>
                </div>
            </li>
        @endforeach
    </ol>

    <div class="flex flex-col max-w-screen-xl gap-6 p-6 mx-auto bg-white rounded-lg shadow sm:p-8 lg:flex-row sm:gap-8">
        <div class="flex-1 space-y-3 sm:space-y-4">
            <x-form.input :loading="$isLoading" :label="__(':name Name', ['name' => __('Quiz')])" :placeholder="__('Entry :entry', ['entry' => __(':name Name', ['name' => __('Quiz')])])" block type="text" wire:model="quizName"
                :error="$errors->first('quizName')" required />
            <x-form.select :info="__('You cannot change this once saved')" :loading="$isLoading" :label="__(':type Type', ['type' => __('Quiz')])" block :items="$quizTypes"
                wire:model="quizType" :error="$errors->first('quizType')" required />
            <x-form.select-with-search :label="__('Quiz Category')" searchVar="quizCategorySearch" :items="$quizCategories"
                wire:model="quizCategorySearch" :error="$errors->first('quizCategory')" :buttonText="__('Choose a :item', ['item' => __('Quiz Category')])" />
            <x-form.select-with-search :label="__(':type Type', ['type' => __('Quiz Phase')])" searchVar="quizPhaseSearch" :items="$quizPhases"
                wire:model="quizPhaseSearch" :error="$errors->first('quizPhase')" :buttonText="__('Choose a :item', ['item' => __('Quiz Phase')])" />
            <x-form.input :loading="$isLoading" :label="__('Estimation Time') . ' (' . __('Minute') . ')'" :placeholder="__('Entry :entry', ['entry' => __('Estimation Time')]) . ' (' . __('Minute') . ')'" block type="number"
                wire:model="estimationTime" :error="$errors->first('estimationTime')" required />
        </div>
        <div class="flex-1 space-y-3 sm:space-y-4">
            <x-form.textarea-wysiwyg :loading="$isLoading" :label="__('Overview')" :placeholder="__('Entry :entry', ['entry' => __('Overview')])" block
                wire:model="overview" :error="$errors->first('overview')" required />
            <x-form.textarea-wysiwyg :loading="$isLoading" :label="__('Content Coverage')" :placeholder="__('Entry :entry', ['entry' => __('Content Coverage')])" block
                wire:model="contentCoverage" :error="$errors->first('contentCoverage')" required />
            <x-form.textarea-wysiwyg :loading="$isLoading" :label="__('Assessment Objectives')" :placeholder="__('Entry :entry', ['entry' => __('Assessment Objectives')])" block
                wire:model="assessmentObjectives" :error="$errors->first('assessmentObjectives')" required />
            <div class="text-end !mt-9">
                <x-button color="primary" wire:click="save">
                    {{ __('Save') }}
                </x-button>
            </div>
        </div>
    </div>
</x-content>
