<?php

namespace App\Livewire\Dashboard\GradeLevel;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\GradeLevel;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Delete extends Component
{
    use LivewireAlert;
    protected $listeners = ['clearModal'];
    public GradeLevel $gradeLevel;
    public bool $isLoading = true;

    #[On('setDeleteGradeLevel')]
    public function setDeleteGradeLevel(GradeLevel $gradeLevel)
    {
        $this->gradeLevel = $gradeLevel
            ->load(['educationLevel' => fn($q) => $q->withCount('schools')])
            ->loadCount('students');
        $this->isLoading = false;
    }

    public function render()
    {
        return view('pages.dashboard.grade-level.delete');
    }

    public function clearModal()
    {
        $this->reset();
        $this->isLoading = true;
    }

    public function delete()
    {
        $this->isLoading = true;
        try {
            if ($this->gradeLevel->students->count() > 0) {
                $this->alert('warning', __('Cannot delete data because there is still a :value :attribute associated with the data.', ['value' => $this->gradeLevel->students->count(), 'attribute' => __('Students')]));
                $this->isLoading = false;
                return;
            }

            $this->gradeLevel->delete();

            $this->dispatch('toggle-delete-grade-level-modal');
            $this->dispatch('refreshGradeLevelData');

            $this->alert('success', __(':attribute deleted successfully.', ['attribute' => __('Grade Level')]));
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
}
