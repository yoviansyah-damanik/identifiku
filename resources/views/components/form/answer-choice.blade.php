<div x-data='{ id: $id("{{ $attributes->whereStartsWith('wire:model')->first() }}") }'
    {{ $attributes->merge(['class']) }}>
    <div class="relative inline">
        <div @class([
            'flex border rounded-lg',
            'invalid:border-red-500 invalid:text-red-600 focus:invalid:border-red-500 focus:invalid:ring-red-500 border-red-500' => $error,
        ])>
            <label :for="id" class="{{ $labelClass }}">{{ $label }}</label>
            <input :id="id" class="{{ $baseClass }}" {{ $attributes->whereStartsWith('wire:model') }}
                {{ $attributes->merge(['placeholder' => $placeholder]) }} type="text" placeholder=""
                wire:loading.attr='disabled' @required($required) @disabled($loading) />
        </div>
        @if ($error)
            <div
                class="absolute right-0 z-10 px-3 py-1 text-xs text-center text-red-500 rounded-md bottom-full bg-red-50">
                {{ $error }}
            </div>
        @else
            @if ($info)
                <div
                    class="absolute right-0 z-10 px-3 py-1 text-xs text-center text-red-500 rounded-md bottom-full bg-red-50">
                    {{ $info }}
                </div>
            @endif
        @endif
    </div>
</div>
