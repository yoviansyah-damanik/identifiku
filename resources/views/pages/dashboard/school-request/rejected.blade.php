<div>
    <x-modal.body>
        @if (!$isLoading)
            <div>
                {{ __('Are you sure you want to reject the :attribute?', ['attribute' => __('School Request')]) }}
            </div>
            <div class="space-y-1" wire:ignore>
                <div class="flex gap-3">
                    <div class="w-48">NPSN</div>
                    <div class="flex-1 font-semibold">{{ $school->npsn }}</div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">NSS</div>
                    <div class="flex-1 font-semibold">{{ $school->nss }}</div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">NIS</div>
                    <div class="flex-1 font-semibold">{{ $school->nis }}</div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">{{ __(':name Name', ['name' => __('School')]) }}</div>
                    <div class="flex-1 font-semibold">{{ $school->name }}</div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">{{ __('Address') }}</div>
                    <div class="flex-1 font-semibold">{{ $school->fullAddress }}</div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">{{ __('Education Level') }}</div>
                    <div class="flex-1 font-semibold">{{ $school->educationLevel->name }}</div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">{{ __('School Status') }}</div>
                    <div class="flex-1 font-semibold">{{ $school->status->name }}</div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">{{ __('Username') }}</div>
                    <div class="flex-1 font-semibold">
                        {{ $school->username }}
                    </div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">{{ __('Email') }}</div>
                    <div class="flex-1 font-semibold">
                        {{ $school->email }}
                    </div>
                </div>
            </div>
        @else
            <x-loading />
        @endif
    </x-modal.body>
    <x-modal.footer>
        <x-button color="red" wire:click='submit' :loading="$isLoading">
            {{ __('Reject') }}
        </x-button>
    </x-modal.footer>
</div>
