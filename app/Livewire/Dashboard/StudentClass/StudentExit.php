<?php

namespace App\Livewire\Dashboard\StudentClass;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\StudentHasClass;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class StudentExit extends Component
{
    use LivewireAlert;

    public StudentHasClass $class;
    public bool $isLoading = true;

    public function render()
    {
        return view('pages.dashboard.student-class.student-exit');
    }

    #[On('setExitClass')]
    public function setExitClass(StudentHasClass $class)
    {
        $this->isLoading = true;
        $this->class = $class;
        $this->isLoading = false;
    }

    public function clearModal()
    {
        $this->reset();
        $this->isLoading = true;
    }

    public function exit()
    {
        if (in_array($this->class->id, auth()->user()->student->hasClass->pluck('student_class_id')->toArray())) {
            $this->alert('warning', __('You have been in this class'));
            return;
        }

        if (!in_array($this->class->id, auth()->user()->student->classRequests->pluck('student_class_id')->toArray())) {
            $this->alert('warning', __('You never made a class request for this class'));
            return;
        }

        try {
            // ClassRequest::where('student_class_id', $this->class->id)
            //     ->delete();

            $this->dispatch('toggle-exit-class-modal');
            $this->dispatch('refreshClassData');
            $this->alert('success', __(':attribute exited successfully.', ['attribute' => __('You')]));
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
