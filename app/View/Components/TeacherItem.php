<?php

namespace App\View\Components;

use App\Models\Teacher;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TeacherItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Teacher $teacher
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.teacher-item');
    }
}
