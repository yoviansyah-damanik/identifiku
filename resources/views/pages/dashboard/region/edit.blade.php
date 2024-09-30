<div>
    <x-modal.body>
        <div class="mb-6 space-y-3 sm:space-y-4">
            <x-form.input :loading="$isLoading" :label="__('Code')" block :placeholder="__('Entry :entry', ['entry' => __('Code')])" type='text'
                error="{{ $errors->first('code') }}" wire:model.blur='code' required />
            <x-form.input :loading="$isLoading" :label="__(':name Name', ['name' => __('Region')])" block :placeholder="__('Entry :entry', ['entry' => __(':name Name', ['name' => __('Region')])])" type='text'
                error="{{ $errors->first('name') }}" wire:model.blur='name' required />
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
