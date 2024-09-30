<?php

namespace App\Livewire\Dashboard\SchoolRequest;

use App\Jobs\Mailer;
use App\Models\School;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\SchoolRequest;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Rejected extends Component
{
    use LivewireAlert;
    public SchoolRequest $school;
    public bool $isLoading = true;

    public function render()
    {
        return view('pages.dashboard.school-request.rejected');
    }

    #[On('setRejectedSchoolRequest')]
    public function setRejectedSchoolRequest(SchoolRequest $school)
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
            $this->school->delete();
            dispatch(new Mailer('school_registration_rejected', $this->school->email, $this->school->toArray()));
            DB::commit();
            $this->reset();
            $this->dispatch('refreshSchoolRequestData');
            $this->dispatch('toggle-rejected-school-request-modal');
            $this->alert('success', __(':attribute rejected successfully.', ['attribute' => __('School Request')]));
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
