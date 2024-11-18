<div @class([
    'absolute right-0 px-3 py-1 text-xs text-center text-red-500 rounded-md whitespace-nowrap bottom-full bg-red-50',
    'mb-3' => $withLabel,
])>
    {{ $slot }}
</div>
