<div>
    <x-modal.body>
        @if (!$isLoading)
            <div>
                {{ __('Are you sure you want to delete the :attribute?', ['attribute' => __('School')]) }}
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
                    <div class="w-48">{{ __('Number of :subject', ['subject' => __('Students')]) }}</div>
                    <div class="flex-1 font-semibold">
                        {{ GeneralHelper::numberFormat($school->students_count) .
                            ' ' .
                            ($school->students_count > 1 ? __('Students') : __('Student')) }}
                    </div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">{{ __('Username') }}</div>
                    <div class="flex-1 font-semibold">
                        {{ $school->user->username }}
                    </div>
                </div>
            </div>
        @else
            <x-loading />
        @endif
    </x-modal.body>
    <x-modal.footer>
        <x-button color="primary" wire:click='delete' :loading="$isLoading">
            {{ __('Delete') }}
        </x-button>
    </x-modal.footer>
</div>
