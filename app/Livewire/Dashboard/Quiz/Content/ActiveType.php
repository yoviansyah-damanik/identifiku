<?php

namespace App\Livewire\Dashboard\Quiz\Content;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\QuestionType;

class ActiveType extends Component
{
    protected $listeners = ['refreshTypeData' => '$refresh'];
    public QuestionType $type;
    public function render()
    {
        return view('pages.dashboard.quiz.content.active-type');
    }

    #[On('setTypeActive')]
    public function setTypeActive(QuestionType $type)
    {
        $this->type = $type;
    }
}
