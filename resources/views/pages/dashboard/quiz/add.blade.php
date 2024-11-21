<div>
    <x-modal.body>
        <div class="mb-6 space-y-3 sm:space-y-4">
            <x-form.select-with-search :loading="$isLoading" block searchVar="studentClassSearch" :items="$studentClasses"
                wire:model="studentClass" error="{{ $errors->first('studentClass') }}" :label="__('Choose a :item', ['item' => __('Class')])"
                :buttonText="__('Choose a :item', ['item' => __('Class')])" />
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
