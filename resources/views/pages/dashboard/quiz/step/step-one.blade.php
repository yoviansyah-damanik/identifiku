<div class="flex flex-col max-w-screen-xl gap-6 p-6 mx-auto bg-white rounded-lg shadow sm:p-8 lg:flex-row sm:gap-8">
    <div class="flex-1 space-y-3 sm:space-y-4">
        <x-form.input :loading="$isLoading" :label="__(':name Name', ['name' => __('Quiz')])" :placeholder="__('Entry :entry', ['entry' => __(':name Name', ['name' => __('Quiz')])])" block type="text" wire:model="quizName"
            :error="$errors->first('quizName')" required />
        <x-form.select :info="__('You cannot change this once saved')" :loading="$isLoading" :label="__(':type Type', ['type' => __('Quiz')])" block :items="$quizTypes"
            wire:model="quizType" :error="$errors->first('quizType')" required />
        <x-form.select-with-search :buttonText="$initQuizCategory" :label="__('Quiz Category')" searchVar="quizCategorySearch" :items="$quizCategories"
            wire:model="quizCategorySearch" :error="$errors->first('quizCategory')" />
        <x-form.select-with-search :buttonText="$initQuizPhase" :label="__(':type Type', ['type' => __('Quiz Phase')])" searchVar="quizPhaseSearch" :items="$quizPhases"
            wire:model="quizPhaseSearch" :error="$errors->first('quizPhase')" />
        <x-form.input :loading="$isLoading" :label="__('Estimation Time') . ' (' . __('Minute') . ')'" :placeholder="__('Entry :entry', ['entry' => __('Estimation Time')]) . ' (' . __('Minute') . ')'" block type="number"
            wire:model="estimationTime" :error="$errors->first('estimationTime')" required />
    </div>
    <div class="flex-1 space-y-3 sm:space-y-4">
        <x-form.textarea-wysiwyg :loading="$isLoading" :label="__('Overview')" :placeholder="__('Entry :entry', ['entry' => __('Overview')])" block wire:model="overview"
            :error="$errors->first('overview')" required />
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
