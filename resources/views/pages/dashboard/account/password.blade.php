<form class="space-y-3 sm:space-y-4" wire:submit.prevent="submit">
    <x-form.input :loading="$isLoading" :label="__('Current Password')" block :placeholder="__('Entry :entry', ['entry' => Str::lower(__('Current Password'))])" type='password' wire:model='currentPassword'
        error="{{ $errors->first('currentPassword') }}" required />
    <x-form.input :loading="$isLoading" :label="__('New Password')" block :placeholder="__('Entry :entry', ['entry' => Str::lower(__('New Password'))])" type='password' wire:model='password'
        error="{{ $errors->first('password') }}" required />
    <x-form.input :loading="$isLoading" :label="__('Re-Password')" block :placeholder="__('Entry :entry', ['entry' => Str::lower(__('Re-Password'))])" type='password' wire:model='rePassword'
        error="{{ $errors->first('rePassword') }}" required />

    <div class="text-end">
        <x-button :loading="$isLoading" type="submit" color="primary" radius="rounded-full" base="!mt-8 lg:!mt-10">
            {{ __('Submit') }}
        </x-button>
    </div>
</form>
