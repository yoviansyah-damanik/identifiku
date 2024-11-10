<?php

namespace App\Livewire\Dashboard\Quiz;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Create extends Component
{
    public ?string $groupActive = null;
    public array $groups;

    public function render()
    {
        return view('pages.dashboard.quiz.create')
            ->title(__('Add :add', ['add' => __('Quiz')]));
    }

    public function addType(array $type) {}
    public function addGroup(int $typeId, array $group) {}
    public function addQuestion(int $groupId, array $question) {}
}
