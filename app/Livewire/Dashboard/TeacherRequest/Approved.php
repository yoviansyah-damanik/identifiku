<?php

namespace App\Livewire\Dashboard\TeacherRequest;

use App\Helpers\GeneralHelper;
use App\Jobs\Mailer;
use App\Models\User;
use App\Models\Teacher;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\TeacherRequest;
use App\Models\UserHasRelation;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Approved extends Component
{
    use LivewireAlert;
    public TeacherRequest $teacher;
    public bool $isLoading = true;

    public function render()
    {
        return view('pages.dashboard.teacher-request.approved');
    }

    #[On('setApprovedTeacherRequest')]
    public function setApprovedTeacherRequest(TeacherRequest $teacher)
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
            $newTeacherPayload = collect($this->teacher)->except('id', 'username', 'password', 'email', 'created_at', 'updated_at');
            $newUserPayload = collect($this->teacher)->only('username', 'password', 'email');

            $newTeacher = Teacher::create($newTeacherPayload->toArray());
            $newUser = User::create([...$newUserPayload->except('password')->toArray(), 'password' => bcrypt($newUserPayload['password'])]);

            UserHasRelation::create([
                'user_id' => $newUser->id,
                'modelable_id' => $newTeacher->id,
                'modelable_type' => Teacher::class
            ]);

            $this->teacher->delete();
            dispatch(new Mailer('teacher_registration_approved', $newUser['email'], $newTeacher->toArray()));
            DB::commit();
            $this->reset();
            $this->dispatch('refreshTeacherRequestData');
            $this->dispatch('toggle-approved-teacher-request-modal');
            $this->alert('success', __(':attribute approved successfully.', ['attribute' => __('Teacher Request')]));
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
