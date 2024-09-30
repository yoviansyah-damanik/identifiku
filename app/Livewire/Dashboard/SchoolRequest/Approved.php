<?php

namespace App\Livewire\Dashboard\SchoolRequest;

use App\Helpers\GeneralHelper;
use App\Jobs\Mailer;
use App\Models\User;
use App\Models\School;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use App\Models\SchoolRequest;
use App\Models\UserHasRelation;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Approved extends Component
{
    use LivewireAlert;
    public SchoolRequest $school;
    public bool $isLoading = true;

    public function render()
    {
        return view('pages.dashboard.school-request.approved');
    }

    #[On('setApprovedSchoolRequest')]
    public function setApprovedSchoolRequest(SchoolRequest $school)
    {
        $this->school = $school;
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
            $newSchoolPayload = collect($this->school)->except('id', 'username', 'password', 'email', 'created_at', 'updated_at');
            $newUserPayload = collect($this->school)->only('username', 'password', 'email');

            $newSchool = School::create([...$newSchoolPayload->toArray(), 'token' => GeneralHelper::getRandomToken()]);
            $newUser = User::create([...$newUserPayload->except('password')->toArray(), 'password' => bcrypt($newUserPayload['password'])]);

            UserHasRelation::create([
                'user_id' => $newUser->id,
                'modelable_id' => $newSchool->id,
                'modelable_type' => School::class
            ]);

            $this->school->delete();
            dispatch(new Mailer('school_registration_approved', $newUser['email'], $newSchool->toArray()));
            DB::commit();
            $this->reset();
            $this->dispatch('refreshSchoolRequestData');
            $this->dispatch('toggle-approved-school-request-modal');
            $this->alert('success', __(':attribute approved successfully.', ['attribute' => __('School Request')]));
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
