<?php

namespace App\Livewire\Dashboard\QuizCategory;

use App\Models\QuizCategory;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    use LivewireAlert;
    public bool $isLoading = false;

    public QuizCategory $quizCategory;
    public string $name;
    public string $description;

    #[On('setEditQuizCategory')]
    public function setEditQuizCategory(QuizCategory $quizCategory)
    {
        $this->quizCategory = $quizCategory;
        $this->name = $quizCategory->name;
        $this->description = $quizCategory->description;
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
            'name' => __(':name Name', ['name' => __('Quiz Category')]),
            'description' => __('Description')
        ];
    }

    public function render()
    {
        return view('pages.dashboard.quiz-category.edit');
    }

    public function save()
    {
        $this->validate();
        $this->isLoading = true;
        try {
            $this->quizCategory->update([
                'name' => $this->name,
                'description' => $this->description,
            ]);

            $this->dispatch('toggle-edit-quiz-category-modal');
            $this->dispatch('refreshQuizCategoryData');
            $this->reset();

            $this->alert('success', __(':attribute updated successfully.', ['attribute' => __('Quiz Category')]));
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
