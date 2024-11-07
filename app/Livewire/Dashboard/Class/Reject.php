<?php

namespace App\Livewire\Dashboard\Class;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\ClassRequest;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Reject extends Component
{
    use LivewireAlert;

    public ClassRequest $request;
    public bool $isLoading = true;

    public function render()
    {
        return view('pages.dashboard.class.reject');
    }

    #[On('setRejectClass')]
    public function setRejectClass(ClassRequest $request)
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

    public function reject()
    {
        try {
            $this->request->delete();

            $this->dispatch('toggle-reject-class-modal');
            $this->dispatch('refreshRequestData');
            $this->alert('success', __(':attribute rejected successfully.', ['attribute' => __('Class Request')]));
            $this->isLoading = true;
        } catch (\Exception $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        }
    }
}
