<?php

namespace App\View\Components;

use Closure;
use App\Models\Quiz;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class AvailableQuizBox extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Quiz $quiz,
        public bool $withBox = false
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.available-quiz-box');
    }
}
