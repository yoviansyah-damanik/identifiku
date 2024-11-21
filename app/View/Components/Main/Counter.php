<?php

namespace App\View\Components\Main;

use App\Models\Assessment;
use App\Models\Quiz;
use Closure;
use App\Models\School;
use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Counter extends Component
{
    public array $counters;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->counters = [
            [
                'title' => __('Schools'),
                'count' => School::count(),
                'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quas, beatae?'
            ],
            [
                'title' => __('Classes'),
                'count' => StudentClass::count(),
                'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quas, beatae?'
            ],
            [
                'title' => __('Students'),
                'count' => Student::count(),
                'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quas, beatae?'
            ],
            [
                'title' => __('Quizzes'),
                'count' => Quiz::published()->count(),
                'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quas, beatae?'
            ],
            [
                'title' => __('Assessment Completed'),
                'count' => Assessment::done()->count(),
                'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quas, beatae?'
            ]
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.main.counter');
    }
}
