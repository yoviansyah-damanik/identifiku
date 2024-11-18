<?php

namespace App\Livewire\Dashboard\Quiz\Step\Additional;

use App\Models\Quiz;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\QuestionGroup;
use App\Helpers\GeneralHelper;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AddGroup extends Component
{
    use LivewireAlert;

    public string $name;
    public string $description;

    public Quiz $quiz;

    public array $types;
    public string $type;

    public bool $isLoading = false;

    public function render()
    {
        return view('pages.dashboard.quiz.step.additional.add-group');
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

    #[On('setAddGroup')]
    public function setAddGroup(Quiz $quiz)
    {
        $this->isLoading = true;
        $this->quiz = $quiz;
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
            QuestionGroup::create([
                'quiz_id' => $this->quiz->id,
                'name' => $this->name,
                'description' => $this->description,
                'order' => $this->quiz->groups->count() + 1
            ]);

            $this->dispatch('refreshQuizData');
            $this->dispatch('toggle-add-group-modal');
            $this->alert('success', __(':attribute added successfully.', ['attribute' => __(':group Group', ['group' => __('Quiz')])]));
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
        $this->reset('name', 'description');
    }
}
