<?php

namespace App\Livewire\Dashboard\EducationLevel;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\EducationLevel;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Delete extends Component
{
    use LivewireAlert;
    protected $listeners = ['clearModal'];

    public EducationLevel $educationLevel;
    public bool $isLoading = true;

    #[On('setDeleteEducationLevel')]
    public function setDeleteEducationLevel(EducationLevel $educationLevel)
    {
        $this->educationLevel = $educationLevel
            ->load(['grades' => fn($q) => $q->withCount('students')])
            ->loadCount('grades', 'schools');
        $this->isLoading = false;
    }

    public function render()
    {
        return view('pages.dashboard.education-level.delete');
    }

    public function clearModal()
    {
        $this->reset();
        $this->isLoading = true;
    }

    public function tes()
    {
        $this->isLoading = true;
        try {
            if ($this->educationLevel->grades_count > 0) {
                $this->alert('warning', __('Cannot delete data because there is still a :value :attribute associated with the data.', ['value' => $this->educationLevel->grades->count(), 'attribute' => $this->educationLevel->schools->count() > 1 ? __('Grade Level') : __('Grade Levels')]));
                $this->isLoading = false;
                return;
            }

            if ($this->educationLevel->schools_count > 0) {
                $this->alert('warning', __('Cannot delete data because there is still a :value :attribute associated with the data.', ['value' => $this->educationLevel->schools->count(), 'attribute' => $this->educationLevel->schools->count() > 1 ? __('School') : __('Schools')]));
                $this->isLoading = false;
                return;
            }
            $this->educationLevel->delete();

            $this->dispatch('toggle-delete-education-level-modal');
            $this->dispatch('refreshEducationLevelData');

            $this->alert('success', __(':attribute deleted successfully.', ['attribute' => __('Education Level')]));
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
