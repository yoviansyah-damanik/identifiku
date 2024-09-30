<?php

namespace App\Livewire\Dashboard\Region;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Region;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Delete extends Component
{
    use LivewireAlert;
    protected $listeners = ['clearModal'];

    public Region $region;
    public bool $isLoading = true;

    #[On('setDeleteRegion')]
    public function setDeleteRegion(Region $region)
    {
        $this->region = $region;
        $this->isLoading = false;
    }

    public function render()
    {
        return view('pages.dashboard.region.delete');
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
            // if ($this->schools->count() > 0) {
            //     $this->alert('warning', __('Cannot delete data because there is still a :value :attribute associated with the data.', ['value' => $this->schools->count(), 'attribute' => $this->schools->count() > 1 ? __('Student') : __('Students')]));
            //     $this->isLoading = false;
            //     return;
            // }
            $this->region->delete();

            $this->dispatch('toggle-delete-region-modal');
            $this->dispatch('refreshRegionData');

            $this->alert('success', __(':attribute deleted successfully.', ['attribute' => __('Region')]));
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
