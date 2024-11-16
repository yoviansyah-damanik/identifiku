<?php

namespace App\Livewire\Dashboard\Quiz\Content;

use App\Models\Quiz;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\QuestionType;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class EditType extends Component
{
    use LivewireAlert;
    public QuestionType $type;
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
        return view('pages.dashboard.quiz.content.edit-type');
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
            'name' => __(':name Name', ['name' => __('Type')]),
            'description' => __('Description')
        ];
    }

    #[On('setEditType')]
    public function setEditType(QuestionType $type)
    {
        $this->refresh();

        $this->type = $type;
        $this->name = $type->name;
        $this->description = $type->description;
        $this->isLoading = false;
    }

    #[On('clearModal')]
    public function refresh()
    {
        $this->reset('name', 'description', 'type');
        $this->isLoading = true;
    }

    public function save()
    {
        $this->validate();
        $this->isLoading = true;

        try {
            $this->type->update([
                'name' => $this->name,
                'description' => $this->description,
            ]);

            $this->dispatch('refreshQuizData');
            $this->dispatch('toggle-edit-type-modal');
            $this->alert('success', __(':attribute updated successfully.', ['attribute' => __(':type Type', ['type' => __('Quiz')])]));
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
