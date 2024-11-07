<div>
    <x-modal.body>
        <div class="mb-6 space-y-3 sm:space-y-4">
            <x-form.input :loading="$isLoading" :label="__(':name Name', ['name' => __('Class')])" block :placeholder="__('Entry :entry', ['entry' => __(':name Name', ['name' => __('Class')])])" type='text'
                error="{{ $errors->first('name') }}" wire:model.blur='name' required />
            <x-form.input :loading="$isLoading" :label="__('Description')" block :placeholder="__('Entry :entry', ['entry' => __('Description')])" type='text'
                error="{{ $errors->first('description') }}" wire:model.blur='description' required />
            <x-form.input x-ref="dateInput" :min="now()->format('Y-m-d')" :loading="$isLoading" :label="__('Expired Date')" block :placeholder="__('Entry :entry', ['entry' => __('Expired Date')])"
                type='date' error="{{ $errors->first('expiredAt') }}" :info="__('Clear if no time specified')" wire:model.blur='expiredAt'
                required />
        </div>
    </x-modal.body>
    <x-modal.footer>
        <x-button x-on:click="closeModal" :loading="$isLoading">
            {{ __('Close') }}
        </x-button>
        <x-button color="primary" wire:click='save' :loading="$isLoading">
            {{ __('Update') }}
        </x-button>
    </x-modal.footer>
</div>
