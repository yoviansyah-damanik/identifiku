<?php

namespace App\Livewire\Dashboard\EducationLevel;

use App\Models\EducationLevel;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Create extends Component
{
    use LivewireAlert;
    public bool $isLoading = false;
    public string $name;
    public string $description;

    public function render()
    {
        return view('pages.dashboard.education-level.create');
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

    public function updated($attribute)
    {
        $this->validateOnly($attribute);
    }

    public function store()
    {
        $this->validate();
        $this->isLoading = true;
        try {
            EducationLevel::create([
                'name' => $this->name,
                'description' => $this->description,
            ]);

            $this->dispatch('toggle-create-education-level-modal');
            $this->dispatch('refreshEducationLevelData');
            $this->reset();

            $this->alert('success', __(':attribute created successfully.', ['attribute' => __('Education Level')]));
            $this->isLoading = false;
        } catch (\Exception $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        }
    }

    public function refresh()
    {
        $this->reset();
    }
}
