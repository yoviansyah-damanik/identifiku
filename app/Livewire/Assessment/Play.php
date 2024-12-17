<?php

namespace App\Livewire\Assessment;

use Livewire\Component;
use App\Models\Assessment;
use Livewire\Attributes\Isolate;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

#[Layout('layouts.assessment')]
#[Isolate]
class Play extends Component
{
    public Assessment $assessment;
    public int $current;

    public function mount(Assessment $assessment)
    {
        $this->authorize('play', $assessment);

        if ($assessment->started_on) {
            $this->current = 2;

            if (in_array($assessment->status, [2, 3]) || now() > $assessment->started_on->addMinutes($assessment->quiz->estimation_time)) {
                $this->current = 3;
            }
        } else {
            $this->current = 1;
        }

        $this->assessment = $assessment->load([
            'quiz',
            'quiz.groups',
            'quiz.groups.questions'
        ]);
    }

    public function render()
    {
        return view('pages.assessment.play')
            ->title(__('Assessment') . ' - ' . $this->assessment->quiz->name);
    }

    #[On('setStep')]
    public function setStep($step)
    {
        $this->current = $step;
    }
}
