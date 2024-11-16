<?php

namespace App\Livewire\Dashboard\Quiz\Step\Additional;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use App\Enums\QuestionTypes;
use App\Models\QuestionType;
use App\Helpers\GeneralHelper;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AddGroup extends Component
{
    use LivewireAlert;

    public string $name;
    public string $description;

    public QuestionType $questionType;

    public array $types;
    public string $type;

    public bool $isLoading = false;

    public function mount()
    {
        $this->types = collect(QuestionTypes::names())
            ->map(fn($item) => [
                'value' => $item,
                'title' => __(Str::headline($item))
            ])->toArray();
        $this->type = $this->types[0]['value'];
    }

    public function render()
    {
        return view('pages.dashboard.quiz.step.additional.add-group');
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:40',
            'description' => 'required|string|max:80',
            'type' => [
                'required',
                Rule::in(collect($this->types)->pluck('value')->toArray())
            ]
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
    public function setAddGroup(QuestionType $questionType)
    {
        $this->isLoading = true;
        $this->questionType = $questionType;
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
                'question_type_id' => $this->questionType->id,
                'name' => $this->name,
                'description' => $this->description,
                'type' => $this->type,
                'order' => $this->questionType->groups->count()
            ]);
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
        $this->type = $this->types[0]['value'];
    }
}
