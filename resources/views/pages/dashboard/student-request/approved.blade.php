<div>
    <x-modal.body>
        @if (!$isLoading)
            <div>
                {{ __('Are you sure you want to approve the :attribute?', ['attribute' => __('Student')]) }}
            </div>
            <div class="space-y-1">
                <div class="flex gap-3">
                    <div class="w-48">NISN</div>
                    <div class="flex-1 font-semibold">{{ $student->nisn }}</div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">NIS</div>
                    <div class="flex-1 font-semibold">{{ $student->nis }}</div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">{{ __(':name Name', ['name' => __('Student')]) }}</div>
                    <div class="flex-1 font-semibold">{{ $student->name }}</div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">{{ __(':name Name', ['name' => __('School')]) }}</div>
                    <div class="flex-1 font-semibold">{{ $student->school->name }}</div>
                </div>
            </div>
        @else
            <x-loading />
        @endif
    </x-modal.body>
    <x-modal.footer>
        <x-button color="primary" wire:click='submit' :loading="$isLoading">
            {{ __('Approve') }}
        </x-button>
    </x-modal.footer>
</div>
