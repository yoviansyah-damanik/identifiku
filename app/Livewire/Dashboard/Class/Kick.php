<?php

namespace App\Livewire\Dashboard\Class;

use App\Models\Student;
use App\Models\StudentClass;
use App\Models\StudentHasClass;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class Kick extends Component
{
    use LivewireAlert;

    public StudentClass $class;
    public Student $student;

    public bool $isLoading = true;

    public function render()
    {
        return view('pages.dashboard.class.kick');
    }

    #[On('setKickStudent')]
    public function setKickStudent(StudentClass $class, Student $student)
    {
        $this->isLoading = true;
        $this->class = $class;
        $this->student = $student;
        $this->isLoading = false;
    }

    public function clearModal()
    {
        $this->reset();
        $this->isLoading = true;
    }

    public function kick()
    {
        try {
            StudentHasClass::where('student_class_id', $this->class->id)
                ->where('student_id', $this->student->id)
                ->delete();

            $this->dispatch('toggle-kick-class-modal');
            $this->dispatch('resetClassData');
            $this->alert('success', __(':attribute get outed successfully.', ['attribute' => __('Student')]));
            $this->isLoading = true;
        } catch (\Exception $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        }
    }
}
