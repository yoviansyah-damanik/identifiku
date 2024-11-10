<div>
    <x-modal.body>
        <x-form.select-with-search :loading="$isLoading" block searchVar="gradeLevelSearch" :items="$gradeLevels"
            wire:model="gradeLevel" error="{{ $errors->first('gradeLevel') }}" :label="__('Choose a :item', ['item' => __('Grade Level')])" :buttonText="__('Choose a :item', ['item' => __('Grade Level')])" />
        <x-form.select-with-search :loading="$isLoading" block searchVar="studentSearch" :items="$students"
            wire:model="student" error="{{ $errors->first('student') }}" :label="__('Choose a :item', ['item' => __('Student')])" :buttonText="__('Choose a :item', ['item' => __('Student')])" />
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
