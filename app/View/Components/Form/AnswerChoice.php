<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AnswerChoice extends Component
{
    public string $baseClass;
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $label,
        public string $placeholder = '',
        public array $target = [],
        public bool $block = false,
        public bool $required = false,
        public bool $loading = false,
        public string $error = '',
        public string $base = '',
        public string $labelClass = '',
        public string $size = 'md',
        public string $color = 'primary',
        public string $info = '',
    ) {
        $this->baseClass = join(' ', [
            'flex-1 relative outline-none disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none',
            $block ? 'block w-full' : 'min-w-16',
            $this->colorVariant($color),
            $this->sizeVariant($size),
            $base
        ]);

        $this->labelClass = join(' ', [
            'w-14 rounded-s-lg grid place-items-center font-semibold bg-primary-50 text-primary-500 dark:text-slate-100',
            $labelClass
        ]);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.answer-choice');
    }

    public function sizeVariant($size)
    {
        $sizeVariants = [
            'md' => 'rounded-e-xl text-base py-2 px-5'
        ];
        return $sizeVariants[$size];
    }

    public function colorVariant($color)
    {
        $colorVariants = [
            'primary' => 'bg-white focus:border-primary-700 dark:focus:border-primary-500',
            'secondary' => 'bg-white focus:border-primary-700 dark:focus:border-primary-500',
            'red' => 'bg-white focus:border-red-700 dark:focus:border-red-500',
        ];

        return $colorVariants[$color];
    }
}
