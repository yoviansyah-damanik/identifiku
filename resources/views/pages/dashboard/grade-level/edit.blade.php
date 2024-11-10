<div>
    <x-modal.body>
        <div class="mb-6 space-y-3 sm:space-y-4">
            <x-form.input :loading="$isLoading" :label="__(':name Name', ['name' => __('Grade Level')])" block :placeholder="__('Entry :entry', ['entry' => __(':name Name', ['name' => __('Grade Level')])])" type='text'
                error="{{ $errors->first('name') }}" wire:model.blur='name' required />
            <x-form.input :loading="$isLoading" :label="__('Description')" block :placeholder="__('Entry :entry', ['entry' => __('Description')])" type='text'
                error="{{ $errors->first('description') }}" wire:model.blur='description' required />
            <x-form.select-with-search :loading="$isLoading" block searchVar="educationLevelSearch" :items="$educationLevels"
                wire:model="educationLevel" error="{{ $errors->first('educationLevel') }}" :label="__('Choose a :item', ['item' => __('Education Level')])" />
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
