<?php

namespace App\Livewire\Dashboard\SchoolStatus;

use App\Models\SchoolStatus;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    use LivewireAlert;
    public bool $isLoading = false;

    public SchoolStatus $schoolStatus;
    public string $name;
    public string $description;

    #[On('setEditSchoolStatus')]
    public function setEditSchoolStatus(SchoolStatus $schoolStatus)
    {
        $this->isLoading = true;
        $this->schoolStatus = $schoolStatus;
        $this->name = $schoolStatus->name;
        $this->description = $schoolStatus->description;
        $this->isLoading = false;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:60',
            'description' => 'required|string|max:255'
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => __(':name Name', ['name' => __('School Status')]),
            'description' => __('Description')
        ];
    }

    public function render()
    {
        return view('pages.dashboard.school-status.edit');
    }

    public function save()
    {
        $this->validate();
        $this->isLoading = true;
        try {
            $this->schoolStatus->update([
                'name' => $this->name,
                'description' => $this->description,
            ]);

            $this->dispatch('toggle-edit-school-status-modal');
            $this->dispatch('refreshSchoolStatusData');
            $this->reset();

            $this->alert('success', __(':attribute updated successfully.', ['attribute' => __('School Status')]));
            $this->isLoading = false;
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
