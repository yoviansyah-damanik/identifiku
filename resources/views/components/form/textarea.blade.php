<div x-data='{
        id: $id("{{ $attributes->whereStartsWith('wire:model')->first() }}"),
        limit: {{ $limit }},
        content: $wire.{{ $attributes->whereStartsWith('wire:model')->first() }} ?? "",
        isMax: false,
        get count() {
            count = this.content.length
            if(count > this.limit){
                this.content = this.content.substring(0, this.limit)
                $wire.{{ $attributes->whereStartsWith('wire:model')->first() }} = this.content
                this.isMax = true
                return this.limit
            }
            this.isMax = false
            return count
        }
    }'
    :data-id="id">
    @if ($label)
        <label :for="id" class="{{ $labelClass }}">{{ $label }}</label>
    @endif
    <div class="relative">
        <textarea x-model="content" :id="id" class="{{ $baseClass }}"
            {{ $attributes->whereStartsWith('wire:model') }}
            {{ $attributes->merge(['placeholder' => $placeholder, 'rows' => $rows]) }} placeholder="" rows="4"
            wire:loading.attr='disabled' @required($required) @disabled($loading)></textarea>
        @if ($limit)
            <div class='absolute bottom-0 right-0 p-3 text-sm text-gray-700 pointer-events-none'
                :class="isMax ? 'text-red-700' : ''">
                <span x-text="count"></span>/<span x-text="limit"></span>
            </div>
        @endif

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
