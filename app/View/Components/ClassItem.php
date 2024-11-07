<?php

namespace App\View\Components;

use App\Models\StudentClass;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ClassItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public StudentClass $class
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.class-item');
    }
}
