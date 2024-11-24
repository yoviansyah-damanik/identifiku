<div>
    <x-modal.body>
        <div class="mb-6 space-y-3 sm:space-y-4">
            <div class="flex flex-col gap-1">
                <div class="font-semibold">
                    {{ __(':name Name', ['name' => __('Quiz')]) }}
                </div>
                {{ $quiz?->name }}
            </div>
            <x-form.select-with-search :loading="$isLoading" block searchVar="studentClassSearch" :items="$studentClasses"
                wire:model="studentClass" error="{{ $errors->first('studentClass') }}" :label="__('Choose a :item', ['item' => __('Class')])"
                :buttonText="__('Choose a :item', ['item' => __('Class')])" />
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
