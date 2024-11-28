<?php

namespace App\Livewire\Assessment\Step;

use App\Models\Assessment;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Isolate;
use Livewire\Component;

#[Isolate]
class StepOne extends Component
{
    use LivewireAlert;
    public Assessment $assessment;

    public int $step = 1;

    public function mount(Assessment $assessment)
    {
        $this->assessment = $assessment
            ->load(
                'quiz',
                'quiz.assessmentRule'
            );
    }

    public function render()
    {
        return view('pages.assessment.step.step-one');
    }

    public function setStep($step)
    {
        $this->step = $step;
    }

    public function next()
    {
        $this->step++;
    }

    public function prev()
    {
        $this->step--;
    }

    public function start()
    {
        try {
            $this->assessment->update([
                'started_on' => now()->addSecond(5)
            ]);

            $this->dispatch('setStep', step: 2);
        } catch (\Exception $e) {
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            $this->alert('error', $e->getMessage());
        }
    }
}
