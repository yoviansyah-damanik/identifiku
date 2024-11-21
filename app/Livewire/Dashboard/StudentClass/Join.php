<?php

namespace App\Livewire\Dashboard\StudentClass;

use App\Models\ClassRequest;
use Livewire\Component;
use App\Models\StudentClass;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;

class Join extends Component
{
    use LivewireAlert;

    public StudentClass $class;
    public bool $isLoading = true;

    public function render()
    {
        return view('pages.dashboard.student-class.join');
    }

    #[On('setJoinClass')]
    public function setJoinClass(StudentClass $class)
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

    public function join()
    {
        $this->authorize('join', $this->class);

        if (in_array($this->class->id, auth()->user()->student->hasClasses->pluck('id')->toArray())) {
            $this->alert('warning', __('You have been in this class'));
            return;
        }
        if (in_array($this->class->id, auth()->user()->student->classRequests->pluck('student_class_id')->toArray())) {
            $this->alert('warning', __('You have submitted a class request, please wait for confirmation from the Teacher'));
            return;
        }

        try {
            ClassRequest::create([
                'student_id' => auth()->user()->student->id,
                'student_class_id' => $this->class->id
            ]);
            $this->dispatch('toggle-join-class-modal');
            $this->dispatch('refreshAvailableData');
            $this->alert('success', __(':attribute submitted successfully.', ['attribute' => __('Class Request')]));
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
