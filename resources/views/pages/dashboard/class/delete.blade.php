<div>
    <x-modal.body>
        @if (!$isLoading)
            <div>
                {{ __('All students will be removed from class and all quizzes will be wiped.') }}
                {{ __('Are you sure you want to disband this class?') }}
            </div>
            <div class="space-y-1" wire:ignore>
                <div class="flex gap-3">
                    <div class="w-48">{{ __(':name Name', ['name' => __('Class')]) }}</div>
                    <div class="flex-1 font-semibold">{{ $class->name }}</div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">{{ __('Description') }}</div>
                    <div class="flex-1 font-semibold">{{ $class->description }}</div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">{{ __('Expired Date') }}</div>
                    <div class="flex-1 font-semibold">
                        {{ $class->expired_at ? $class->expired_at->translatedFormat('d M Y') . ' (' . $class->expired_at->diffForHumans() . ')' : '-' }}
                    </div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">{{ __('Status') }}</div>
                    <div class="flex-1 font-semibold">
                        <x-badge :type="$class->isStatusActive ? 'success' : 'error'">
                            {{ $class->isStatusActive ? __('Active') : __('Inactive') }}
                        </x-badge>
                    </div>
                </div>
                <div class="flex gap-3">
                    <div class="w-48">{{ __('Number of :subject', ['subject' => __('Students')]) }}</div>
                    <div class="flex-1 font-semibold">
                        {{ GeneralHelper::numberFormat($class->students_count) .
                            ' ' .
                            ($class->students_count > 1 ? __('Students') : __('Student')) }}
                    </div>
                </div>
            </div>
        @else
            <x-loading />
        @endif
    </x-modal.body>
    <x-modal.footer>
        <x-button color="primary" wire:click='disband' :loading="$isLoading">
            {{ __('Disband') }}
        </x-button>
    </x-modal.footer>
</div>
