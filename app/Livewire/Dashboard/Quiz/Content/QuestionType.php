<?php

namespace App\Livewire\Dashboard\Quiz\Content;

use Livewire\Component;
use App\Models\QuestionType as QuestionTypeModel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Reactive;

class QuestionType extends Component
{
    use LivewireAlert;

    #[Reactive]
    public QuestionTypeModel $type;

    public function mount(QuestionTypeModel $type)
    {
        $this->type = $type;
    }

    public function render()
    {
        return view('pages.dashboard.quiz.content.question-type');
    }
}
