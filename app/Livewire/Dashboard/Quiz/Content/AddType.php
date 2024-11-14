<?php

namespace App\Livewire\Dashboard\Quiz\Content;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Helpers\GeneralHelper;
use App\Models\QuestionType;
use App\Models\Quiz;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AddType extends Component
{
    use LivewireAlert;

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
        return view('pages.dashboard.quiz.content.add-type');
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

    #[On('setAddType')]
    public function setAddType()
    {
        $this->reset('name', 'description');
        $this->isLoading = false;

        if (!GeneralHelper::isProduction())
            $this->dev();
    }

    public function dev()
    {
        $this->name = fake()->name;
        $this->description = fake()->sentence();
    }

    public function add()
    {
        $this->validate();
        $this->isLoading = true;

        try {
            QuestionType::create([
                'quiz_id' => $this->quiz->id,
                'name' => $this->name,
                'description' => $this->description,
                'order' => $this->quiz->types->count() + 1
            ]);

            $this->dispatch('refreshQuizData');
            $this->dispatch('toggle-add-type-modal');
            $this->alert('success', __(':attribute added successfully.', ['attribute' => __(':type Type', ['type' => __('Quiz')])]));
        } catch (\Exception $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        }
    }
}
