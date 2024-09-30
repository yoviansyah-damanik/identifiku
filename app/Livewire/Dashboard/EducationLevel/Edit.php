<?php

namespace App\Livewire\Dashboard\EducationLevel;

use App\Models\EducationLevel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    use LivewireAlert;
    public bool $isLoading = false;

    public EducationLevel $educationLevel;
    public string $name;
    public string $description;

    #[On('setEditEducationLevel')]
    public function setEditEducationLevel(EducationLevel $educationLevel)
    {
        $this->educationLevel = $educationLevel;
        $this->name = $educationLevel->name;
        $this->description = $educationLevel->description;
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
            'name' => __(':name Name', ['name' => __('Education Level')]),
            'description' => __('Description')
        ];
    }

    public function render()
    {
        return view('pages.dashboard.education-level.edit');
    }

    public function save()
    {
        $this->validate();
        $this->isLoading = true;
        try {
            $this->educationLevel->update([
                'name' => $this->name,
                'description' => $this->description,
            ]);

            $this->dispatch('toggle-edit-education-level-modal');
            $this->dispatch('refreshEducationLevelData');
            $this->reset();

            $this->alert('success', __(':attribute updated successfully.', ['attribute' => __('Education Level')]));
            $this->isLoading = false;
        } catch (\Exception $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        }
    }
}
