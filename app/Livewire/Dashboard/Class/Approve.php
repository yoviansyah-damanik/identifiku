<?php

namespace App\Livewire\Dashboard\Class;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\ClassRequest;
use App\Models\StudentHasClass;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Approve extends Component
{
    use LivewireAlert;

    public ClassRequest $request;
    public bool $isLoading = true;

    public function render()
    {
        return view('pages.dashboard.class.approve');
    }

    #[On('setApproveClass')]
    public function setApproveClass(ClassRequest $request)
    {
        $this->isLoading = true;
        $this->request = $request;
        $this->isLoading = false;
    }

    public function clearModal()
    {
        $this->reset();
        $this->isLoading = true;
    }

    public function approve()
    {
        if (in_array($this->request->student_class_id, $this->request->student->hasClasses->pluck('student_class_id')->toArray())) {
            $this->alert('warning', __('You have been in this class'));
            return;
        }
        if (!in_array($this->request->student_class_id, $this->request->student->classRequests->pluck('student_class_id')->toArray())) {
            $this->alert('warning', __('You do not perform class requests against this class'));
            return;
        }

        DB::beginTransaction();
        try {
            StudentHasClass::create($this->request->only(['student_class_id', 'student_id']));
            $this->request->delete();

            $this->dispatch('toggle-approve-class-modal');
            $this->dispatch('refreshRequestData');
            $this->alert('success', __(':attribute approved successfully.', ['attribute' => __('Class Request')]));
            DB::commit();
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
