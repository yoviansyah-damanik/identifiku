<?php

namespace App\View\Components;

use Closure;
use App\Models\Student;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class StudentItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Student $student
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.student-item');
    }
}
