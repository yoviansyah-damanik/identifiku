<div x-data='{
    id: $id("{{ Str::of($attributes->whereStartsWith('wire:model')->first())->explode('.')[0] }}"),
    content: $wire.{{ $attributes->whereStartsWith('wire:model')->first() }} ?? "",
    get result() {
        $wire.{{ $attributes->whereStartsWith('wire:model')->first() }} = this.content;
        return content;
    }
}'
    x-on:clear-textarea.window = "content = ''"
    x-on:set-{{ $attributes->whereStartsWith('wire:model')->first() }}-textarea-value.window = "content = $event.detail[0]">
    @if ($label)
        <label :for="id" class="{{ $labelClass }}">{{ $label }}</label>
    @endif
    <div class="relative">
        <div wire:ignore>
            <trix-editor
                x-on:trix-change="$wire.{{ $attributes->whereStartsWith('wire:model')->first() }} = $event.target.value"
                class="{{ $baseClass }}" {{ $attributes->whereStartsWith('wire:model') }} wire:loading.attr='disabled'
                @required($required) @disabled($loading)></trix-editor>
        </div>
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
