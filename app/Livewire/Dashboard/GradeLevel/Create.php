<?php

namespace App\Livewire\Dashboard\GradeLevel;

use Livewire\Component;
use App\Models\GradeLevel;
use App\Models\EducationLevel;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Create extends Component
{
    use LivewireAlert;
    public bool $isLoading = false;
    public string $name;
    public string $description;

    public string $educationLevelSearch = '';
    public string $educationLevel = '';

    public function render()
    {
        $educationLevels = EducationLevel::where('name', 'like', '%' . $this->educationLevelSearch . '%')
            ->limit(10)
            ->get()
            ->map(fn($educationLevel) => [
                'title' => $educationLevel->name,
                'value' => $educationLevel->id,
                'description' => $educationLevel->fullAddress,
            ])
            ->toArray();

        return view('pages.dashboard.grade-level.create', compact('educationLevels'));
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:60',
            'description' => 'required|string|max:255',
            'educationLevel' => 'required|exists:education_levels,id'
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => __(':name Name', ['name' => __('Grade Level')]),
            'description' => __('Description'),
            'educationLevel' => __('Education Level')
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
            GradeLevel::create([
                'name' => $this->name,
                'description' => $this->description,
                'education_level_id' => $this->educationLevel,
            ]);

            $this->dispatch('toggle-create-grade-level-modal');
            $this->dispatch('refreshGradeLevelData');
            $this->reset();

            $this->alert('success', __(':attribute created successfully.', ['attribute' => __('Grade Level')]));
            $this->isLoading = false;
        } catch (\Exception $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        }
    }

    public function setSearchSearchEducationLevel($data)
    {
        $this->educationLevelSearch = $data;
    }

    public function setValueEducationLevel($data)
    {
        $this->educationLevel = $data;
        $this->resetValidation('educationLevel');
    }

    public function resetValueEducationLevel()
    {
        $this->reset('educationLevel', 'educationLevelSearch');
    }

    public function refresh()
    {
        $this->resetValueEducationLevel();
        $this->dispatch('resetValueEducationLevel');
        $this->reset();
    }
}
