<?php

namespace App\View\Components\Main;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CounterItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $title,
        public int $count,
        public string $description,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.main.counter-item');
    }
}
