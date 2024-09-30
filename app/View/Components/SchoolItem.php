<?php

namespace App\View\Components;

use App\Models\School;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SchoolItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public School $school
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.school-item');
    }
}
