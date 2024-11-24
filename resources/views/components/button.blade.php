@if ($href)
    <a type="button" href="{{ $href }}" class="{{ $baseClass }}" {{ $attributes }}
        @disabled($loading || $disabled) wire:loading.attr='disabled' @if ($withNavigated) wire:navigate @endif>
        @if ($icon)
            <div @class([
                'flex items-center gap-3',
                'justify-center' => $block,
                'flex-row-reverse' => $iconPosition == 'right',
            ])>
                <div @class([
                    'grid border-inherit place-items-center',
                    'border-e pe-2' =>
                        !$slot->isEmpty() && $iconPosition == 'left' && $withBorderIcon,
                    'border-s ps-2' =>
                        !$slot->isEmpty() && $iconPosition == 'right' && $withBorderIcon,
                ])>
                    <span class="{{ $iconClass }}"></span>
                </div>
                @if (!$slot->isEmpty())
                    <div @class([
                        'flex-1' => !$block,
                    ])>
                        {{ $slot }}
                    </div>
                @endif
            </div>
        @else
            {{ $slot }}
        @endif
    </a>
@else
    <button class="{{ $baseClass }}" {{ $attributes }} @disabled($loading || $disabled) wire:loading.attr='disabled'>
        @if ($icon)
            <div @class([
                'flex items-center gap-3',
                'justify-center' => $block,
                'flex-row-reverse' => $iconPosition == 'right',
            ])>
                <div @class([
                    'grid border-inherit place-items-center',
                    'border-e pe-2' =>
                        !$slot->isEmpty() && $iconPosition == 'left' && $withBorderIcon,
                    'border-s ps-2' =>
                        !$slot->isEmpty() && $iconPosition == 'right' && $withBorderIcon,
                ])>
                    <span class="{{ $iconClass }}"></span>
                </div>
                @if (!$slot->isEmpty())
                    <div @class([
                        'flex-1' => !$block,
                    ])>
                        {{ $slot }}
                    </div>
                @endif
            </div>
        @else
            {{ $slot }}
        @endif
    </button>
@endif
