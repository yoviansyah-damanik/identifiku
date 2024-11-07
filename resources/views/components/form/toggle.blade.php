<div x-data='{ id: $id("{{ $attributes->whereStartsWith('wire:model')->first() }}") }'>
    <label @class([
        'inline-flex items-center',
        'cursor-no-drop' => $isLoading,
        'cursor-pointer' => !$isLoading,
    ]) :for="id">
        @if ($label2)
            <span class="text-sm font-medium text-gray-900 dark:text-gray-300 me-3">
                {{ $label2 }}
            </span>
        @endif
        <input type="checkbox" value="" class="sr-only peer" {{ $attributes->whereStartsWith('wire') }}
            @checked($isChecked) :id="id" @disabled($isLoading)>
        <div @class([
            "relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary-600",
            // " peer-focus:ring-primary-300 dark:peer-focus:ring-primary-800"=>!$isLoading,
            'peer-focus:ring-primary-100 dark:peer-focus:ring-primary-500 peer-checked:bg-primary-300' => $isLoading,
        ])>
        </div>
        <span class="text-sm font-medium text-gray-900 ms-3 dark:text-gray-300">
            {{ $label }}
        </span>
    </label>
    @if ($error)
        <x-form.error-message>
            {{ $error }}
        </x-form.error-message>
    @else
        @if ($info)
            <x-form.info-message>
                {{ $info }}
            </x-form.info-message>
        @endif
    @endif
</div>
