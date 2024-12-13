<div class="grid grid-cols-[1fr_auto] break-inside-avoid-column m-0 mb-2">
    <div>
        <div class="font-semibold">
            {{ $title }}
        </div>
        @if ($slot->isEmpty())
            {{ $value }}
        @else
            {{ $slot }}
        @endif
    </div>
</div>
