<form class="space-y-3 sm:space-y-4" wire:submit.prevent="submit">
    <x-form.input :loading="$isLoading" :label="__('Username')" block :placeholder="__('Entry :entry', ['entry' => Str::lower(__('Username'))])" type='text' wire:model='username'
        error="{{ $errors->first('username') }}" required />
    <x-form.input :loading="$isLoading" :label="__('Email')" block :placeholder="__('Entry :entry', ['entry' => Str::lower(__('Email'))])" type='email' wire:model='email'
        error="{{ $errors->first('email') }}" required />

    <div class="text-end">
        <x-button :loading="$isLoading" type="submit" color="primary" radius="rounded-full" base="!mt-8 lg:!mt-10">
            {{ __('Save') }}
        </x-button>
    </div>
</form>
