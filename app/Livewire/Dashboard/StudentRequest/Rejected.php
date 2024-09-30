<?php

namespace App\Livewire\Dashboard\StudentRequest;

use App\Jobs\Mailer;
use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\StudentRequest;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Rejected extends Component
{
    use LivewireAlert;
    public StudentRequest $student;
    public bool $isLoading = true;

    public function render()
    {
        return view('pages.dashboard.student-request.rejected');
    }

    #[On('setRejectedStudentRequest')]
    public function setRejectedStudentRequest(StudentRequest $student)
    {
        $this->student = $student;
        $this->isLoading = false;
    }

    #[On('clearModal')]
    public function clearModal()
    {
        $this->reset();
        $this->isLoading = true;
    }

    public function submit()
    {
        $this->isLoading = true;
        DB::beginTransaction();
        try {
            $this->student->delete();
            dispatch(new Mailer('student_registration_rejected', $this->student->email, $this->student->toArray()));
            DB::commit();
            $this->reset();
            $this->dispatch('refreshStudentRequestData');
            $this->dispatch('toggle-rejected-student-request-modal');
            $this->alert('success', __(':attribute rejected successfully.', ['attribute' => __('Student Request')]));
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
