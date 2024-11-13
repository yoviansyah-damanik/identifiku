<form autocomplete="off" wire:submit.prevent='submit' class="w-full space-y-3 sm:space-y-4">
    <x-form.select-with-search :loading="$isLoading" block searchVar="schoolSearch" :items="$schools" wire:model="school"
        error="{{ $errors->first('school') }}" :label="__('Choose a :item', ['item' => __('School')])" :buttonText="__('Choose a :item', ['item' => __('School')])" />
    <x-form.input :loading="$isLoading" :label="__('Token')" block :placeholder="__('Entry :entry', ['entry' => Str::lower(__('Token'))])" type='text' wire:model='token'
        error="{{ $errors->first('token') }}" />
    <x-button :loading="$isLoading" wire:target="login,school,token" color="primary" type="submit" block
        radius="rounded-full" base="!mt-8 lg:!mt-10">
        {{ __('Save') }}
    </x-button>
</form>
