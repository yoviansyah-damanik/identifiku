<?php

namespace App\View\Components;

use App\Models\SchoolRequest;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SchoolRequestItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public SchoolRequest $school
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.school-request-item');
    }
}
