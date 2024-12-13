<div>
    <x-modal.body>
        <div class="mb-6 space-y-3 sm:space-y-4">
            <x-form.input :info="__('May be left blank')" :loading="$isLoading" :label="__('Default')" block :placeholder="__('Default')" type='text'
                :error="$errors->first('default')" wire:model.blur='default' required />

            @if (in_array($rule?->type, ['calculation-2']))
                <x-form.input class="flex-1" :loading="$isLoading" :label="__('Score')" block :placeholder="__('Score')" type="number"
                    :error="$errors->first('score')" wire:model.blur='score' required />
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
