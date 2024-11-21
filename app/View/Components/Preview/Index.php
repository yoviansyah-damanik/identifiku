<?php

namespace App\View\Components\Preview;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Index extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $quiz,
        public $selectedQuizPhase,
        public $selectedQuizCategory,
        public $activeGroup,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.preview.index');
    }
}
