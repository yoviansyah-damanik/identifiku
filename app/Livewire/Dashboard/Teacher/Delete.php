<?php

namespace App\Livewire\Dashboard\Teacher;

use App\Models\Teacher;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Delete extends Component
{
    use LivewireAlert;

    protected $listeners = ['setDeleteTeacher', 'clearModal'];
    public bool $isLoading = true;
    public ?Teacher $teacher = null;

    public function render()
    {
        return view('pages.dashboard.teacher.delete');
    }

    public function setDeleteTeacher(Teacher $teacher)
    {
        $this->teacher = $teacher;
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
            if ($this->teacher->picture) {
                Storage::delete('public/' . $this->teacher->picture->path);
            }

            $this->teacher->mediable()->delete();
            $this->teacher->hasRelation()->delete();
            $this->teacher->user()->delete();
            $this->teacher->delete();

            DB::commit();
            $this->dispatch('refreshTeacherData');
            $this->dispatch('toggle-delete-teacher-modal');
            $this->alert('success', __(':attribute deleted successfully.', ['attribute' => __('Teacher')]));
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
