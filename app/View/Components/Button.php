<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public string $baseClass,
        $bgClass;
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $color = 'default',
        public bool $block = false,
        public string $radius = 'rounded-md',
        public string $base = '',
        public array $target = [],
        public string $size = 'md',
        public string $href = '',
        public bool $loading = false,
        public bool $disabled = false,
        public ?string $icon = null,
        public ?string $iconClass = null,
        public string $iconPosition = 'left',
        public bool $withNavigated = true,
        public bool $withBorderIcon = true
    ) {
        $this->baseClass = join(' ', [
            'relative inline-block font-medium font-semibold transition duration-150 text-base text-nowrap',
            $this->sizeVariant($size),
            $block ? 'w-full text-center' : '',
            $this->bgClass = $this->colorVariant($color),
            $radius,
            $loading ? 'cursor-not-allowed' : 'cursor-pointer',
            $base
        ]);

        $this->iconClass = join(' ', [
            'size-4',
            $icon,
            $iconClass,
        ]);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button');
    }

    public static function colorVariant($color): string
    {
        $colorVariants = [
            'primary' => 'focus:outline-none text-white bg-primary-500 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900',
            'secondary' => 'focus:outline-none text-white bg-secondary-500 hover:bg-secondary-700 focus:ring-4 focus:ring-secondary-300 dark:focus:ring-secondary-900',
            'primary-outline' => 'focus:outline-primary-500 border border-primary-500 text-primary-500 hover:text-white bg-transparent hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900',
            'secondary-outline' => 'focus:outline-secondary-500 border border-secondary-500 text-secondary-500 hover:text-white bg-transparent hover:bg-secondary-700 focus:ring-4 focus:ring-secondary-300 dark:focus:ring-secondary-900',
            'green' => 'focus:outline-none text-white bg-green-500 hover:bg-green-700 focus:ring-4 focus:ring-green-300 dark:focus:ring-green-900',
            'red' => 'focus:outline-none text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900',
            'cyan' => 'focus:outline-none text-white bg-cyan-500 hover:bg-cyan-600 focus:ring-4 focus:ring-cyan-300 dark:focus:ring-cyan-900',
            'yellow' => 'focus:outline-none text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300 dark:focus:ring-yellow-900',
            'default' => 'text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700',
            'transparent' => 'bg-transparent dark:text-gray-500 dark:hover:text-primary-500 outline-none border-none',
            'primary-transparent' => 'bg-primary-50 hover:text-primary-500 hover:bg-primary-100 dark:text-gray-500 dark:hover:text-primary-500 outline-none border-none',
            'inactive' => 'bg-gray-100 border border-gray-200'
        ];

        return $colorVariants[$color];
    }

    public function sizeVariant($size)
    {
        $sizeVariants = [
            'sm' => 'text-sm py-1.5 px-2',
            'md' => 'py-2.5 px-5'
        ];
        return $sizeVariants[$size];
    }
}
