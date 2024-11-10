<?php

namespace App\Livewire\Dashboard\SchoolStatus;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\SchoolStatus;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Delete extends Component
{
    use LivewireAlert;

    public SchoolStatus $schoolStatus;
    public bool $isLoading = true;

    #[On('setDeleteSchoolStatus')]
    public function setDeleteSchoolStatus(SchoolStatus $schoolStatus)
    {
        $this->isLoading = true;
        $this->schoolStatus = $schoolStatus->load('schools')
            ->loadCount('schools');
        $this->isLoading = false;
    }

    public function render()
    {
        return view('pages.dashboard.school-status.delete');
    }

    public function delete()
    {
        $this->isLoading = true;
        try {
            if ($this->schoolStatus->schools->count() > 0) {
                $this->alert('warning', __('Cannot delete data because there is still a :value :attribute associated with the data.', ['value' => $this->schoolStatus->schools->count(), 'attribute' => $this->schoolStatus->schools->count() > 1 ? __('Schools') : __('School')]));
                $this->isLoading = false;
                return;
            }
            $this->schoolStatus->delete();

            $this->dispatch('toggle-delete-school-status-modal');
            $this->dispatch('refreshSchoolStatusData');

            $this->alert('success', __(':attribute deleted successfully.', ['attribute' => __('School Status')]));
            $this->isLoading = false;
            $this->reset();
        } catch (\Exception $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        }
    }

    #[On('clearModal')]
    public function clearModal()
    {
        $this->reset();
        $this->isLoading = true;
    }
}
