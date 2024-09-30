<?php

namespace App\View\Components\Form;

use Closure;
use App\Helpers\CssHelper;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Radio extends Component
{
    public string $baseClass;
    /**
     * Create a new component instance.
     */
    public function __construct(
        public array $items,
        public bool $required = false,
        public bool $loading = false,
        public ?string $label = null,
        public ?string $labelClass = null,
        public ?string $base = null,
        public ?string $wrapClass = null,
        public bool $inline = false,
        public ?string $error = null,
        public ?string $info = null,
        public bool $translated = false
    ) {
        $this->wrapClass = join(' ', [
            'items-center gap-2 text-gray-700 dark:text-gray-100',
            $inline ? 'inline-flex mr-3 last:mr-0' : 'flex',
        ]);

        $this->baseClass = join(
            ' ',
            [
                'size-4',
                'aspect-square accent-primary-500 focus:accent-primary-900 transition duration-150 disabled:bg-slate-50 disabled:text-slate-100 disabled:border-slate-200 disabled:shadow-none',
                $base
            ]
        );

        $this->labelClass = join(' ', [
            'block mb-3 text-base font-medium text-slate-700 dark:text-slate-100',
            $required ? 'after:content-[\'*\'] after:ml-0.5 after:text-red-500' : '',
            $labelClass
        ]);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.radio');
    }
}
