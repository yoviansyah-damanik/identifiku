<div>
    <x-modal.body>
        <div class="mb-6 space-y-3 sm:space-y-4">
            <x-form.input :loading="$isLoading" :label="__(':name Name', ['name' => __('Quiz Phase')])" block :placeholder="__('Entry :entry', ['entry' => __(':name Name', ['name' => __('Quiz Phase')])])" type='text'
                error="{{ $errors->first('name') }}" wire:model.blur='name' required />
            <x-form.input :loading="$isLoading" :label="__('Description')" block :placeholder="__('Entry :entry', ['entry' => __('Description')])" type='text'
                error="{{ $errors->first('description') }}" wire:model.blur='description' required />
            <x-form.checkbox :label="__('Grade Level')" error="{{ $errors->first('grades') }}" required wire:model="grades"
                :items="$gradeLevels" />
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
