<?php

namespace App\Livewire\Dashboard\Student;

use App\Models\Student;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Delete extends Component
{
    use LivewireAlert;

    protected $listeners = ['setDeleteStudent', 'clearModal'];
    public bool $isLoading = true;
    public ?Student $student = null;

    public function render()
    {
        return view('pages.dashboard.student.delete');
    }

    public function setDeleteStudent(Student $student)
    {
        $this->student = $student;
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
            if ($this->student->picture) {
                Storage::delete('public/' . $this->student->picture->path);
            }

            $this->student->mediable()->delete();
            $this->student->hasRelation()->delete();
            $this->student->user()->delete();
            $this->student->delete();

            DB::commit();
            $this->dispatch('refreshStudentData');
            $this->dispatch('toggle-delete-student-modal');
            $this->alert('success', __(':attribute deleted successfully.', ['attribute' => __('Student')]));
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
