<div>
    <x-modal.body>
        <div class="mb-6 space-y-3 sm:space-y-4">
            <x-form.input :loading="$isLoading" :label="__(':name Name', ['name' => __('Group')])" block :placeholder="__('Entry :entry', ['entry' => __(':name Name', ['name' => __('Group')])])" type='text'
                error="{{ $errors->first('name') }}" wire:model.blur='name' required />
            <x-form.input :loading="$isLoading" :label="__('Description')" block :placeholder="__('Description')" type='text'
                error="{{ $errors->first('description') }}" wire:model.blur='description' required />
            <x-form.select :loading="$isLoading" :label="__('Type')" block :items="$types" wire:model="type"
                :error="$errors->first('type')" required />
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
