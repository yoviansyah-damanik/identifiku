<?php

namespace App\Livewire\Dashboard\Class;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\StudentClass;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Delete extends Component
{
    use LivewireAlert;

    public StudentClass $class;
    public bool $isLoading = true;

    public function render()
    {
        return view('pages.dashboard.class.delete');
    }

    #[On('setDeleteClass')]
    public function setDeleteClass(StudentClass $class)
    {
        $this->class = $class
            ->loadCount('students');
        $this->isLoading = false;
    }

    public function disband()
    {
        $this->isLoading = true;
        DB::beginTransaction();
        try {
            $this->class->quizzes()->delete();
            $this->class->studentHasClasses()->delete();
            $this->class->assessments()->delete();
            $this->class->delete();

            $this->dispatch('toggle-delete-class-modal');
            $this->dispatch('refreshClassData');

            DB::commit();
            $this->alert('success', __(':attribute deleted successfully.', ['attribute' => __('Class')]));
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

    #[On('clearModal')]
    public function refresh()
    {
        $this->reset();
        $this->isLoading = true;
    }
}
