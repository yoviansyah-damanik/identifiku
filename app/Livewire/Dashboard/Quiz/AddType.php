<?php

namespace App\Livewire\Dashboard\Quiz;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Helpers\GeneralHelper;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AddType extends Component
{
    use LivewireAlert;

    public string $name;
    public string $description;

    public bool $isLoading = false;

    public function render()
    {
        return view('pages.dashboard.quiz.add-type');
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
        $this->reset();
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
        $this->dispatch('addType', ['name' => $this->name, 'description' => $this->description]);
        $this->dispatch('toggle-add-type-modal');
        $this->alert('success', __(':attribute added successfully.', ['attribute' => __(':type Type', ['type' => __('Quiz')])]));
        $this->reset();
    }
}
