<x-content>
    <ol @class([
        'flex flex-col justify-around overflow-hidden text-sm font-medium text-center text-gray-500 bg-white border border-gray-200 rounded-lg shadow lg:items-stretch lg:flex-row dark:text-gray-400 sm:text-base dark:bg-gray-800 dark:border-gray-700 rtl:space-x-reverse',
    ])>
        @foreach ($steps as $item)
            <li wire:click="setStep({{ $item['step'] }})" @class([
                'flex items-center justify-center flex-1 p-4 cursor-pointer select-none border-r last:border-r-0',
                'bg-primary-500 text-primary-100 !cursor-not-allowed pointer-events-none' =>
                    $item['step'] == $current,
            ])>
                <div @class([
                    'flex items-center justify-center w-8 h-8 text-xs rounded-full me-2 shrink-0 bg-gray-500 text-gray-100',
                    '!bg-green-500 !text-green-100' => $current > $item['step'],
                    '!bg-secondary-500 !text-secondary-100' => $item['step'] == $current,
                ])>
                    @if ($item['step'] > $current)
                        {{ $item['step'] }}
                    @elseif($item['step'] == $current)
                        <span class="i-ph-person-simple-run"></span>
                    @else
                        <span class="i-ph-check"></span>
                    @endif
                </div>
                <div class="text-start">
                    <div @class([
                        'text-gray-500 font-bold',
                        'text-green-600 dark:text-green-500' => $current > $item['step'],
                        'text-secondary-600 dark:text-secondary-500' => $item['step'] == $current,
                    ])>
                        {{ $item['title'] }}
                    </div>
                    <div class="hidden text-sm font-light lg:block">
                        {{ $item['description'] }}
                    </div>
                </div>
            </li>
        @endforeach
    </ol>

    <livewire:is :component="'dashboard.quiz.step.step-' . GeneralHelper::numberToWord($current)" :key="$current" :$quiz />

    <div class="flex justify-end pt-3 border-t sm:pt-4">
        <x-button color="primary" icon="i-ph-question-fill" x-on:click="$dispatch('toggle-help-modal')" :withBorderIcon="false">
            {{ __('Help') }}
        </x-button>
    </div>
    <div wire:ignore>
        <x-modal name="help-modal" size="4xl" :modalTitle="__('Help')">
            <x-modal.body>
                <x-question-type-explanation />
                <x-assessment-rule />
            </x-modal.body>
        </x-modal>
    </div>
</x-content>

@push('scripts')
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/sort@3.x.x/dist/cdn.min.js"></script>
@endpush
