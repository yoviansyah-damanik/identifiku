<?php

namespace App\Livewire\Dashboard\StudentClass;

use App\Models\Assessment;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\StudentClass;
use App\Models\StudentHasClass;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class StudentExit extends Component
{
    use LivewireAlert;

    public StudentClass $class;
    public bool $isLoading = true;

    public function render()
    {
        return view('pages.dashboard.student-class.student-exit');
    }

    #[On('setExitClass')]
    public function setExitClass(StudentClass $class)
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
        if (!in_array($this->class->id, auth()->user()->student->hasClasses->pluck('student_class_id')->toArray())) {
            $this->alert('warning', __('You never made a class request for this class'));
            return;
        }

        if (!in_array($this->class->id, auth()->user()->student->hasClasses->pluck('student_class_id')->toArray())) {
            $this->alert('warning', __('You never made a class request for this class'));
            return;
        }

        DB::beginTransaction();
        try {
            StudentHasClass::where('student_id', auth()->user()->student->id)
                ->where('student_class_id', $this->class->id)
                ->delete();

            Assessment::where('student_id', auth()->user()->student->id)
                ->where('student_class_id', $this->class->id)
                ->delete();

            $this->dispatch('toggle-exit-class-modal');

            DB::commit();
            $this->dispatch('refreshClassData');
            $this->alert('success', __(':attribute exited successfully.', ['attribute' => __('You')]));
            $this->isLoading = true;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        }
    }
}
