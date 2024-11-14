<?php

namespace App\Livewire\Dashboard\Quiz\Content;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Helpers\GeneralHelper;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AddGroup extends Component
{
    use LivewireAlert;

    public string $name;
    public string $description;
    public string $typeId;

    public bool $isLoading = false;

    public function render()
    {
        return view('pages.dashboard.quiz.content.add-group');
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:40',
            'description' => 'required|string|max:80',
            'typeId' => 'required'
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
    public function setAddGroup(string $typeId)
    {
        $this->typeId = $typeId;
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
        $this->dispatch('addGroup', $this->typeId, ['name' => $this->name, 'description' => $this->description]);
        $this->dispatch('toggle-add-group-modal');
        $this->alert('success', __(':attribute added successfully.', ['attribute' => __(':group Group', ['group' => __('Quiz')])]));
        $this->reset();
    }
}
