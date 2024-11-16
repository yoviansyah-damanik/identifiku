<div x-data='{ id: $id("{{ $attributes->whereStartsWith('wire:model')->first() }}")}'
    {{ $attributes->merge(['class']) }}>
    @if ($label)
        <label :for="id" class="{{ $labelClass }}">{{ $label }}</label>
    @endif
    <div class="relative">
        <select :id="id" class="{{ $baseClass }}" {{ $attributes->whereStartsWith('wire:model') }}
            {{ $attributes }} wire:loading.attr='disabled' @required($required) @disabled($loading)>
            @foreach ($items as $item)
                <option value="{{ $item['value'] ?? $item }}">{{ $item['title'] ?? $item }}</option>
            @endforeach
        </select>
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
</div>
