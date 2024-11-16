<div>
    <x-modal.body>
        <div class="mb-6 space-y-3 sm:space-y-4">
            <x-form.textarea-wysiwyg block :loading="$isLoading" :label="__('Indicator')" :placeholder="__('Entry :entry', ['entry' => __('Indicator')])" wire:model="indicator"
                :error="$errors->first('indicator')" required />
            @if ($detail?->main?->type == 'summative')
                <div class="flex gap-3 sm:gap-4">
                    <x-form.input class="flex-1" :loading="$isLoading" :label="__('Min')" block :placeholder="__('Min')"
                        type='number' :error="$errors->first('value_min')" wire:model.blur='value_min' required />
                    <x-form.input class="flex-1" :loading="$isLoading" :label="__('Max')" block :placeholder="__('Max')"
                        type='number' :error="$errors->first('value_max')" wire:model.blur='value_max' required />
                </div>
            @endif
        </div>
    </x-modal.body>
    <x-modal.footer>
        <x-button x-on:click="closeModal" :loading="$isLoading">
            {{ __('Close') }}
        </x-button>
        <x-button color="primary" wire:click='save' :loading="$isLoading">
            {{ __('Save') }}
        </x-button>
    </x-modal.footer>
</div>
