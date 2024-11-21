<div
    {{ $attributes->class([
        'relative w-full p-6 sm:p-8 shadow border-l-8 bg-white',
        'border-primary-500' => $color == 'primary',
        'border-secondary-500' => $color == 'secondary',
        'border-green-500' => $color == 'green',
        'border-red-500' => $color == 'red',
        'border-cyan-500' => $color == 'cyan',
    ]) }}>
    <div @class([
        'font-semibold',
        'text-primary-500' => $color == 'primary',
        'text-secondary-500' => $color == 'secondary',
        'text-green-500' => $color == 'green',
        'text-red-500' => $color == 'red',
        'text-cyan-500' => $color == 'cyan',
    ])>
        {{ $title }}
    </div>
    <div @class([
        'mb-1 text-sm font-light truncate',
        'text-primary-500' => $color == 'primary',
        'text-secondary-500' => $color == 'secondary',
        'text-green-500' => $color == 'green',
        'text-red-500' => $color == 'red',
        'text-cyan-500' => $color == 'cyan',
    ])>
        {{ $description }}
    </div>
    <div @class([
        'text-4xl font-extrabold',
        'text-primary-500' => $color == 'primary',
        'text-secondary-500' => $color == 'secondary',
        'text-green-500' => $color == 'green',
        'text-red-500' => $color == 'red',
        'text-cyan-500' => $color == 'cyan',
    ])>
        {{ GeneralHelper::numberFormat($count) }}
    </div>
    @if ($icon)
        <div class="absolute -translate-y-1/2 right-3 top-1/2">
            <span @class([
                'text-[4.5rem]',
                'text-gray-100' => $color == 'default',
                'text-primary-100' => $color == 'primary',
                'text-secondary-100' => $color == 'secondary',
                'text-green-100' => $color == 'green',
                'text-red-100' => $color == 'red',
                'text-cyan-100' => $color == 'cyan',
                $icon,
            ])></span>
        </div>
    @endif
</div>
