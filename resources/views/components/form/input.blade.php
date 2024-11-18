<div x-data='{ id: $id("{{ $attributes->whereStartsWith('wire:model')->first() }}"), type: "{{ $type }}", @if ($type == 'password') changeType() { this.type = this.type == "password" ? "text" : "password" } @endif }'
    {{ $attributes->merge(['class']) }}>
    @if ($label)
        <label :for="id" class="{{ $labelClass }}">{{ $label }}</label>
    @endif

    <div class="relative inline">
        <input :id="id" class="{{ $baseClass }}" {{ $attributes->whereStartsWith('wire:model') }}
            {{ $attributes->merge(['type' => $type, 'placeholder' => $placeholder]) }} :type="type"
            placeholder="" wire:loading.attr='disabled' @required($required) @disabled($loading) />
        @if ($type == 'password')
            <div class="absolute right-0 -translate-y-1/2 top-1/2">
                <x-button color="transparent" type="button"
                    base="min-h-0 min-w-0 p-4 aspect-square grid place-items-center" x-on:click='changeType'>
                    <span x-show="type == 'text'" class="i-solar-eye-line-duotone size-4"></span>
                    <span x-show="type == 'password'" class="i-solar-eye-closed-line-duotone size-4"></span>
                </x-button>
            </div>
        @endif
        @if ($type == 'search')
            <div class="absolute left-0 -translate-y-1/2 top-1/2 dark:text-white">
                <span class="m-3 i-solar-magnifer-line-duotone size-6"></span>
            </div>
        @endif

        @if ($error)
            <x-form.error-message :withLabel="$label ? true : false">
                {{ $error }}
            </x-form.error-message>
        @else
            @if ($info)
                <x-form.info-message :withLabel="$label ? true : false">
                    {{ $info }}
                </x-form.info-message>
            @endif
        @endif
    </div>
</div>
