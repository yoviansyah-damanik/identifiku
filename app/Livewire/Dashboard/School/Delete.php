<?php

namespace App\Livewire\Dashboard\School;

use App\Models\School;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Delete extends Component
{
    use LivewireAlert;

    protected $listeners = ['setDeleteSchool', 'clearModal'];
    public bool $isLoading = true;
    public School $school;

    public function render()
    {
        return view('pages.dashboard.school.delete');
    }

    public function setDeleteSchool(School $school)
    {
        $this->school = $school
            ->loadCount('students');

        $this->isLoading = false;
    }

    public function clearModal()
    {
        $this->reset();
        $this->isLoading = true;
    }

    public function delete()
    {
        DB::beginTransaction();
        try {
            if ($this->school->students_count > 0) {
                $this->alert('warning', __('Cannot delete a school because there is more than 1 student enrolled.'));
                return;
            }

            if ($this->school->picture) {
                Storage::delete('public/' . $this->school->picture->path);
            }

            $this->school->mediables()->delete();
            $this->school->hasRelation()->delete();
            $this->school->user()->delete();
            $this->school->delete();

            DB::commit();
            $this->dispatch('refreshSchoolData');
            $this->dispatch('toggle-delete-school-modal');
            $this->alert('success', __(':attribute deleted successfully.', ['attribute' => __('School')]));
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
