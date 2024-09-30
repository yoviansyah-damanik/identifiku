<form wire:submit='submit' class="w-full space-y-3 sm:space-y-4">
    <x-form.input :loading="$isLoading" :label="__('Username')" block :placeholder="__('Entry :entry', ['entry' => Str::lower(__('Username'))])" type='text'
        error="{{ $errors->first('username') }}" wire:model='username' required />
    <x-form.input :loading="$isLoading" :label="__('Password')" block :placeholder="__('Entry :entry', ['entry' => Str::lower(__('Password'))])" type='password' wire:model='password'
        error="{{ $errors->first('password') }}" required />

    <div class="flex items-start justify-between !mt-7">
        <x-form.toggle :loading="$isLoading" :label="__('Remember Me')" error="{{ $errors->first('rememberMe') }}"
            wire:model='rememberMe' />
        <div class="flex flex-col text-end">
            <x-href href="{{ route('forgot-password') }}">
                {{ __('Forgot Password') }}
            </x-href>
            <x-href href="{{ route('registration') }}">
                {{ __('Don\'t have an account yet?') }}
            </x-href>
        </div>
    </div>

    <x-button :loading="$isLoading" wire:target="submit, username, password" color="primary" type="submit" block
        radius="rounded-full" base="!mt-8 lg:!mt-10">
        {{ __('Login') }}
    </x-button>
</form>
