<?php

namespace App\Livewire\Dashboard\Quiz\Step\Additional;

use App\Models\Quiz;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\QuestionGroup;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class EditGroup extends Component
{
    use LivewireAlert;
    public QuestionGroup $group;
    public Quiz $quiz;

    public string $name;
    public string $description;

    public bool $isLoading = false;

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }

    public function render()
    {
        return view('pages.dashboard.quiz.step.additional.edit-group');
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:40',
            'description' => 'required|string|max:80',
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => __(':name Name', ['name' => __('Group')]),
            'description' => __('Description')
        ];
    }

    #[On('setEditGroup')]
    public function setEditGroup(QuestionGroup $group)
    {
        $this->refresh();
        $this->group = $group;
        $this->name = $group->name;
        $this->description = $group->description;
        $this->isLoading = false;
    }

    #[On('clearModal')]
    public function refresh()
    {
        $this->reset('name', 'description', 'group');
        $this->isLoading = true;
    }

    public function save()
    {
        $this->validate();
        $this->isLoading = true;

        try {
            $this->group->update([
                'name' => $this->name,
                'description' => $this->description,
            ]);

            $this->dispatch('refreshQuizData');
            $this->dispatch('toggle-edit-group-modal');
            $this->alert('success', __(':attribute updated successfully.', ['attribute' => __(':group Group', ['group' => __('Question')])]));
            $this->refresh();
        } catch (\Exception $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        }
    }
}
