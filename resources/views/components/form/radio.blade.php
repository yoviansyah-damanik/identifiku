<div x-data="{ id: $id('{{ $attributes->whereStartsWith('wire:model')->first() }}') }">
    @if ($label)
        <label class="{{ $labelClass }}">{{ $label }}</label>
    @endif
    <div :id="id" class="relative">
        @foreach ($items as $idx => $item)
            <label class="{{ $wrapClass }}"
                for="{{ $attributes->whereStartsWith('wire:model')->first() . '-item-' . $idx + 1 }}">
                <input id="{{ $attributes->whereStartsWith('wire:model')->first() . '-item-' . $idx + 1 }}"
                    {{ $attributes->whereStartsWith('wire:model') }}
                    name="{{ $attributes->whereStartsWith('wire:model')->first() }}" type="radio"
                    class="{{ $baseClass }}" wire:loading.attr='disabled' @required($required)
                    @disabled($loading) value="{{ $item['value'] }}" />
                @if ($translated)
                    {{ __($item['label']) }}
                @else
                    {{ $item['label'] }}
                @endif
            </label>
        @endforeach
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
