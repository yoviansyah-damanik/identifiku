<?php

namespace App\Livewire\Dashboard\GradeLevel;

use Livewire\Component;
use App\Models\GradeLevel;
use Livewire\Attributes\On;
use App\Models\EducationLevel;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Edit extends Component
{
    use LivewireAlert;
    public bool $isLoading = false;

    public GradeLevel $gradeLevel;
    public string $name;
    public string $description;
    public string $educationLevelSearch = '';
    public string $educationLevel;
    public string $educationLevelName;

    #[On('setEditGradeLevel')]
    public function setEditGradeLevel(GradeLevel $gradeLevel)
    {
        $this->gradeLevel = $gradeLevel;
        $this->name = $gradeLevel->name;
        $this->description = $gradeLevel->description;
        $this->educationLevel = $gradeLevel->educationLevel->id;
        $this->educationLevelName = $gradeLevel->educationLevel->name;
        $this->dispatch('setTitleEducationLevel', $gradeLevel->educationLevel->name);
        $this->isLoading = false;
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

        return view('pages.dashboard.grade-level.edit', compact('educationLevels'));
    }

    public function save()
    {
        $this->validate();
        $this->isLoading = true;
        try {
            $this->gradeLevel->update([
                'name' => $this->name,
                'description' => $this->description,
                'education_level_id' => $this->educationLevel,
            ]);

            $this->dispatch('toggle-edit-grade-level-modal');
            $this->dispatch('refreshGradeLevelData');
            $this->reset();

            $this->alert('success', __(':attribute updated successfully.', ['attribute' => __('Grade Level')]));
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

    #[On('clearModal')]
    public function clearModal()
    {
        $this->resetValueEducationLevel();
        $this->reset();
        $this->isLoading = true;
    }
}
