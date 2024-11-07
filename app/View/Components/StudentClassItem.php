<?php

namespace App\View\Components;

use App\Models\StudentHasClass;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StudentClassItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public StudentHasClass $class
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.student-class-item');
    }
}
