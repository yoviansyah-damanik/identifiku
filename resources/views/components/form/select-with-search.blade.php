<div x-data="{
    id: $id('{{ $attributes->whereStartsWith('wire:model')->first() }}'),
    showDropdown: false,
    title: '{{ $buttonText }}',
    search: $wire.entangle('{{ $searchVar }}').live,
    setValue(id, title) {
        $wire.setValue{{ Str::of($attributes->whereStartsWith('wire:model')->first())->camel()->ucfirst() }}(id)
        this.title = title
        {{-- $wire.resetValidation('{{ $attributes->whereStartsWith('wire:model')->first() }}') --}}
    },
    setDefaultTitle() {
        this.title = '{{ $buttonText }}';
    },
    resetValue() {
        $wire.resetValue{{ Str::of($attributes->whereStartsWith('wire:model')->first())->camel()->ucfirst() }}()
        this.setDefaultTitle();
    }
}" x-init="$watch('search', (e) => $wire.setSearch{{ Str::of($searchVar)->camel()->ucfirst() }}(e));
@this.on('setTitle{{ Str::of($attributes->whereStartsWith('wire:model')->first())->camel()->ucfirst() }}', e => title = e);
@this.on('resetValue{{ Str::of($attributes->whereStartsWith('wire:model')->first())->camel()->ucfirst() }}', e => setDefaultTitle());" {{ $attributes }} {{-- @resetValue{{ Str::of($attributes->whereStartsWith('wire:model')->first())->camel()->ucfirst() }}.window = "title = '{{ __('Choose an :item', ['item' => __('Item')]) }}'"> --}}>
    @if ($label)
        <label :for="id" class="{{ $labelClass }}">{{ $label }}</label>
    @endif
    <div class="relative"
        x-ref="selectWithSearch{{ Str::of($attributes->whereStartsWith('wire:model')->first())->camel()->ucfirst() }}">
        <div @class([
            'flex gap-0' => $withReset,
        ])>
            <button type="button" @class([
                'block py-2 px-3 border w-full bg-white hover:bg-primary-50 transition-all min-w-48 text-nowrap',
                'rounded-s-full' => $withReset,
                'rounded-full' => !$withReset,
                '!bg-red-50 text-red-500' => $error,
            ]) x-on:click="showDropdown = !showDropdown"
                @disabled($loading) wire:loading.attr="disabled">
                <div x-text="title" class="line-clamp-1"></div>
            </button>
            @if ($withReset)
                <button @class([
                    'py-2 px-3 border text-white hover:bg-primary-50 transition-all bg-red-500 hover:bg-red-700 focus:outline-none ',
                    'rounded-e-full' => $withReset,
                    'rounded-full' => !$withReset,
                ]) x-on:click="resetValue()">
                    <span class="i-ph-x"></span>
                </button>
            @endif
        </div>
        <div class="z-dropdown px-3 mt-1 w-full max-w-[420px] bg-white border rounded-lg shadow-md"
            x-show="showDropdown" x-on:click.outside="showDropdown = false" x-transition
            x-anchor.no-style="$refs.selectWithSearch{{ Str::of($attributes->whereStartsWith('wire:model')->first())->camel()->ucfirst() }}"
            x-bind:style="{ position: 'fixed', top: $anchor.y + 'px', left: $anchor.x + 'px' }">
            <input type="search" class="block py-2.5 px-3 border rounded-full w-full mt-3"
                placeholder="{{ __('Search') }}..." x-model="search" />
            @if ($loading)
                <x-loading />
            @else
                <ul :id="id" class="h-40 overflow-x-hidden overflow-y-auto lg:h-64 snap-y snap-mandatory">
                    @forelse ($items as $item)
                        <li class="px-3 snap-start py-2.5 cursor-pointer hover:bg-primary-50 rounded-md relative"
                            x-on:click="showDropdown = false; setValue(`{{ $item['value'] }}`,`{{ $item['title'] }}`)">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    {{ $item['title'] }}
                                </div>
                                @if (!empty($item['badge']))
                                    <x-badge :type="$item['badge']['type']" size="sm">
                                        {{ $item['badge']['title'] }}
                                    </x-badge>
                                @endif
                            </div>
                            @if (!empty($item['description']))
                                <div @class(['text-xs font-light', 'pr-16' => !empty($item['badge'])])>
                                    {{ $item['description'] }}
                                </div>
                            @endif
                        </li>
                    @empty
                        <li class="px-3 py-2.5 text-center text-gray-500">
                            {{ __('No results found') }}
                        </li>
                    @endforelse
                </ul>
            @endif
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
