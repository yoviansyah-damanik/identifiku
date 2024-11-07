<?php

namespace App\View\Components;

use Closure;
use App\Models\StudentClass;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class AvailableClassItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public StudentClass $class
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.available-class-item');
    }
}
