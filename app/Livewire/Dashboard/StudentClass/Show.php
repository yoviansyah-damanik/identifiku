<?php

namespace App\Livewire\Dashboard\StudentClass;

use Livewire\Component;
use App\Models\StudentClass;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Show extends Component
{
    public StudentClass $class;

    public function mount(StudentClass $class)
    {
        $this->class = $class;
    }

    public function render()
    {
        return view('pages.dashboard.student-class.show');
    }
}
