<form wire:submit='submit' class="w-full space-y-3 sm:space-y-4">
    <x-form.input :loading="$isLoading" :label="__('Email')" block :placeholder="__('Entry :entry', ['entry' => Str::lower(__('Email'))])" type='text'
        error="{{ $errors->first('username') }}" wire:model.blur='username' required />

    <x-button :loading="$isLoading" wire:target="submit, email" color="primary" type="submit" block radius="rounded-full"
        base="!mt-8 lg:!mt-10">
        {{ __('Forgot Password') }}
    </x-button>
</form>
