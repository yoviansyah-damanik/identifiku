<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Box extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $title,
        public ?string $description = null,
        public int $count,
        public string $color = 'default',
        public string $borderColor = 'default',
        public ?string $icon = null,
        public ?string $href = null,
    ) {
        if ($color == 'random') {
            $this->color = [
                'primary',
                'secondary',
                'green',
                'red',
                'cyan',
            ][rand(0, 4)];
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.box');
    }
}
