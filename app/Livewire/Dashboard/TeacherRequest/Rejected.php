<?php

namespace App\Livewire\Dashboard\TeacherRequest;

use App\Jobs\Mailer;
use App\Models\Teacher;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\TeacherRequest;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Rejected extends Component
{
    use LivewireAlert;
    public TeacherRequest $teacher;
    public bool $isLoading = true;

    public function render()
    {
        return view('pages.dashboard.teacher-request.rejected');
    }

    #[On('setRejectedTeacherRequest')]
    public function setRejectedTeacherRequest(TeacherRequest $teacher)
    {
        $this->teacher = $teacher;
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
            $this->teacher->delete();
            dispatch(new Mailer('teacher_registration_rejected', $this->teacher->email, $this->teacher->toArray()));
            DB::commit();
            $this->reset();
            $this->dispatch('refreshTeacherRequestData');
            $this->dispatch('toggle-rejected-teacher-request-modal');
            $this->alert('success', __(':attribute rejected successfully.', ['attribute' => __('Teacher Request')]));
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
