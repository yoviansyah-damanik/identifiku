<div>
    <x-modal.body>
        @if (!$isLoading)
            <div>
                {{ __('Are you sure you will forget the password for the account below?') }}
            </div>
            <div class="space-y-1">
                @if (auth()->user()->isAdmin)
                    <div class="flex gap-3">
                        <div class="w-48">{{ __('Username') }}</div>
                        <div class="flex-1 font-semibold">{{ $user->username }}</div>
                    </div>
                    <div class="flex gap-3">
                        <div class="w-48">{{ __('Email') }}</div>
                        <div class="flex-1 font-semibold">{{ $user->email }}</div>
                    </div>
                @endif
                <div class="flex gap-3">
                    <div class="w-48">{{ __('Fullname') }}</div>
                    <div class="flex-1 font-semibold">{{ $user->{Str::lower($user->roleName)}->name }}</div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">{{ __(':name Name', ['name' => __('School')]) }}</div>
                    <div class="flex-1 font-semibold">{{ $user->getSchoolData->name }}</div>
                </div>
            </div>

            @if ($result)
                <hr class="my-3" />
                <div class="flex gap-3">
                    <div class="w-48">{{ __('New Password') }}</div>
                    <div class="flex-1 font-semibold">{{ $result['new_password'] }}</div>
                </div>
            @endif
        @else
            <x-loading />
        @endif
    </x-modal.body>
    <x-modal.footer>
        <x-button x-on:click="closeModal" :loading="$isLoading">
            {{ __('Close') }}
        </x-button>
        <x-button color="primary" wire:click='submit' :loading="$isLoading">
            {{ __('Submit') }}
        </x-button>
    </x-modal.footer>
</div>
