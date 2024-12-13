<div>
    <x-modal.body>
        <div class="mb-6 space-y-3 sm:space-y-4">
            @if (in_array($quiz->assessmentRule->type, ['calculation-2']))
                <x-form.toggle label="+" label2="-" wire:model="isPlus" :isChecked="$isPlus" />
            @endif
            <x-form.input :loading="$isLoading" :label="__('Question')" block :placeholder="__('Entry :entry', ['entry' => __('Question')])" type='text' :error="$errors->first('question')"
                wire:model='question' required />
            @foreach ($quiz->assessmentRule->answers as $idx => $question)
                <div @class([
                    'flex gap-3',
                    'flex-col lg:flex-row lg:items-center' => in_array(
                        $quiz->assessmentRule->type,
                        ['summative']),
                ])>
                    <x-form.answer-choice class="flex-1" :loading="$isLoading" :label="$question->answer" block :placeholder="__('Entry :entry', ['entry' => __('Answer')])"
                        :error="$errors->first('ans wers.' . $idx . '.text')" wire:model='answers.{{ $idx }}.text' required />
                    @if (in_array($quiz->assessmentRule->type, ['calculation-2']))
                        <x-form.input class="w-32" base="text-center" :loading="$isLoading" block :placeholder="__('Score')"
                            type='text' :error="$errors->first('answers.' . $idx . '.score')" wire:model='answers.{{ $idx }}.score' required />
                    @endif
                    @if (in_array($quiz->assessmentRule->type, ['summative']))
                        <x-form.toggle wire:change="checkCorrectAnswer({{ $idx }})" :label="__('Correct Answer')"
                            :loading="$isLoading" :error="$errors->first('answers.' . $idx . '.is_correct')" wire:model='answers.{{ $idx }}.is_correct'
                            required />
                    @endif
                </div>
            @endforeach
        </div>
    </x-modal.body>
    <x-modal.footer>
        <x-button wire:click="refresh" :loading="$isLoading">
            {{ __('Reset') }}
        </x-button>
        <x-button color="primary" wire:click='add' :loading="$isLoading">
            {{ __('Add') }}
        </x-button>
    </x-modal.footer>
</div>
