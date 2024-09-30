<a {{ $attributes->class([
    'underline cursor-pointer decoration-dotted underline-offset-4 text-inherit',
    'flex items-center gap-3' => $icon,
]) }}
    @if ($withNavigated) wire:navigate @endif>
    @if ($icon)
        <span class="{{ $icon }}"></span>
    @endif
    {{ $slot }}
</a>
