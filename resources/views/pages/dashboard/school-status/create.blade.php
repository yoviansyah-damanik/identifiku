<div>
    <x-modal.body>
        <div class="mb-6 space-y-3 sm:space-y-4">
            <x-form.input :loading="$isLoading" :label="__(':name Name', ['name' => __('School Status')])" block :placeholder="__('Entry :entry', ['entry' => __(':name Name', ['name' => __('School Status')])])" type='text'
                error="{{ $errors->first('name') }}" wire:model.blur='name' required />
            <x-form.input :loading="$isLoading" :label="__('Description')" block :placeholder="__('Entry :entry', ['entry' => __('Description')])" type='text'
                error="{{ $errors->first('description') }}" wire:model.blur='description' required />
        </div>
    </x-modal.body>
    <x-modal.footer>
        <x-button wire:click="refresh" :loading="$isLoading">
            {{ __('Reset') }}
        </x-button>
        <x-button color="primary" wire:click='store' :loading="$isLoading">
            {{ __('Create') }}
        </x-button>
    </x-modal.footer>
</div>
