<?php

namespace App\View\Components;

use App\Models\StudentRequest;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StudentRequestItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public StudentRequest $student
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.student-request-item');
    }
}
