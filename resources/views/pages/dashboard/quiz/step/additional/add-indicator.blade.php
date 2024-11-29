<div>
    <x-modal.body>
        <div class="mb-6 space-y-3 sm:space-y-4">
            <x-form.input :loading="$isLoading" :label="__('Title')" block :placeholder="__('Title')" type='text' :error="$errors->first('title')"
                wire:model.blur='title' required />
            <x-form.textarea-wysiwyg block :loading="$isLoading" :label="__('Indicator')" :placeholder="__('Entry :entry', ['entry' => __('Indicator')])" wire:model="indicator"
                :error="$errors->first('indicator')" required />
            <x-form.textarea-wysiwyg block :loading="$isLoading" :label="__('Recommendation')" :placeholder="__('Entry :entry', ['entry' => __('Recommendation')])"
                wire:model="recommendation" :error="$errors->first('recommendation')" required />
            @if ($rule?->type == 'summative')
                <div class="flex gap-3 sm:gap-4">
                    <x-form.input class="flex-1" :loading="$isLoading" :label="__('Min')" block :placeholder="__('Min')"
                        type='number' :error="$errors->first('value_min')" wire:model.blur='value_min' required />
                    <x-form.input class="flex-1" :loading="$isLoading" :label="__('Max')" block :placeholder="__('Max')"
                        type='number' :error="$errors->first('value_max')" wire:model.blur='value_max' required />
                </div>
            @else
                <div class="flex-1">
                    <x-form.input :info="__('May be left blank')" :loading="$isLoading" :label="__('Default')" block :placeholder="__('Default')"
                        type='text' :error="$errors->first('default')" wire:model.blur='default' required />
                </div>
            @endif

            @if (in_array($rule?->type, ['calculation-2', 'summative']))
                <x-form.input class="flex-1" :loading="$isLoading" :label="__('Score')" block :placeholder="__('Score')"
                    :type="$rule?->type == 'summative' ? 'text' : 'number'" :error="$errors->first('score')" wire:model.blur='score' required />
            @endif
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
