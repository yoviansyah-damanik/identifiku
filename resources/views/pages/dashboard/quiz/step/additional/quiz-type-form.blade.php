<div
    class="w-full lg:max-w-[360px] xl:max-w-[480px] 2xl:max-w-[560px] space-y-3 sm:space-y-4 bg-white rounded-lg shadow p-6 sm:p-8">
    <x-form.select :loading="$isLoading" wire:change="checkRules" :label="__(':type Type', ['type' => __('Question')])" block :items="$questionTypes"
        wire:model.live="questionType" :error="$errors->first('questionType')" required />
    <x-form.select :loading="$isLoading" :label="__(':type Type', ['type' => __('Assessment Rule')])" block :items="$assessmentRules" wire:model.live="assessmentRule"
        :error="$errors->first('assessmentRule')" required />
    @if (
        $questionType != 'dichotomous' &&
            $quiz->type != 'keirseyTemperamentSorter' &&
            !in_array($assessmentRule, ['multipleChoice']))
        <x-form.input :label="__('Number of :subject', ['subject' => __('Answer Options')])" type="number" block wire:model="max_answer" :error="$errors->first('max_answer')" required />
    @endif
    @if (
        $quiz->type != 'keirseyTemperamentSorter' &&
            in_array($assessmentRule, ['calculation-2', 'summative', 'calculation-2']))
        <x-form.input :label="__('Number of :subject', ['subject' => __('Indicators')])" type="number" block wire:model="max_indicator" :error="$errors->first('max_indicator')" required />
    @endif

    <div class="flex flex-col-reverse lg:flex-row items-end justify-between gap-3 !mt-7">
        @if ($quiz->assessmentRule)
            <div class="text-sm italic">
                *) {{ __('Changing the data above will delete all questions that have been created') }}
            </div>
        @endif
        <x-button color="primary" wire:click="save">{{ __('Save') }}</x-button>
    </div>
</div>
