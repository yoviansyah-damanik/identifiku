<?php

namespace App\Livewire\Dashboard\StudentRequest;

use App\Helpers\GeneralHelper;
use App\Jobs\Mailer;
use App\Models\User;
use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\StudentRequest;
use App\Models\UserHasRelation;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Approved extends Component
{
    use LivewireAlert;
    public StudentRequest $student;
    public bool $isLoading = true;

    public function render()
    {
        return view('pages.dashboard.student-request.approved');
    }

    #[On('setApprovedStudentRequest')]
    public function setApprovedStudentRequest(StudentRequest $student)
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
            $newStudentPayload = collect($this->student)->except('id', 'username', 'password', 'email', 'created_at', 'updated_at');
            $newUserPayload = collect($this->student)->only('username', 'password', 'email');

            $newStudent = Student::create([...$newStudentPayload->toArray(), 'token' => GeneralHelper::getRandomToken()]);
            $newUser = User::create([...$newUserPayload->except('password')->toArray(), 'password' => bcrypt($newUserPayload['password'])]);

            UserHasRelation::create([
                'user_id' => $newUser->id,
                'modelable_id' => $newStudent->id,
                'modelable_type' => Student::class
            ]);

            $this->student->delete();
            dispatch(new Mailer('student_registration_approved', $newUser['email'], $newStudent->toArray()));
            DB::commit();
            $this->reset();
            $this->dispatch('refreshStudentRequestData');
            $this->dispatch('toggle-approved-student-request-modal');
            $this->alert('success', __(':attribute approved successfully.', ['attribute' => __('Student Request')]));
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
