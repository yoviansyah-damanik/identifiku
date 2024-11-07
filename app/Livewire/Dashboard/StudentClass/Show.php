<?php

namespace App\Livewire\Dashboard\StudentClass;

use Livewire\Component;
use App\Models\StudentHasClass;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Show extends Component
{
    public StudentHasClass $class;

    public function mount(StudentHasClass $class)
    {
        $this->class = $class;
    }

    public function render()
    {
        return view('pages.dashboard.student-class.show');
    }
}
