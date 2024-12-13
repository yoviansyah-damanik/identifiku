<?php

namespace App\Livewire\Assessment\Step;

use App\Helpers\GeneralHelper;
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
    public array $multipleChoiceExample = [];
    public string $answerExample;

    public function mount(Assessment $assessment)
    {
        $this->assessment = $assessment
            ->load(
                'rule',
                'quiz',
                'quiz.assessmentRule'
            );
        $this->setMultipleChoiceExample();
    }

    public function setMultipleChoiceExample()
    {
        foreach ($this->assessment->rule->answers as $idx => $item) {
            $this->multipleChoiceExample[] = [
                'id' => 'choice-' . $idx,
                'answer' => __('Option :opt', ['opt' => GeneralHelper::numberToAlpha($idx + 1)])
            ];
        }
    }
    public function setAnswerExample($id)
    {
        $this->answerExample = $id;
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

    public function reorderMultipleChoiceCalculationExample($id, $position)
    {
        $arr = $this->multipleChoiceExample;

        $newItems = [];
        $currentIdx = collect($arr)->where('id', $id)
            ->keys()[0];
        $currentItem = $arr[$currentIdx];
        $newItems[$position] = $currentItem;

        if ($currentIdx < $position + 1) {
            $temp = collect($arr)->filter(fn($q, $idx) => $idx != $currentIdx && $idx <= $position)
                ->values();
            $temp2 = collect($arr)->filter(fn($q, $idx) => $idx != $currentIdx && $idx > $position);
            $newTemp = $temp->union($temp2);

            foreach ($newTemp as $idx => $x) {
                $newItems[$idx] = $x;
            }
        } else {
            $temp = collect($arr)->filter(fn($q, $idx) => $idx != $currentIdx && $idx >= $position);
            $temp2 = collect($arr)->filter(fn($q, $idx) => $idx != $currentIdx && $idx < $position)->values();
            $newTemp = $temp->union($temp2);
            foreach ($temp as $idx => $x) {
                $newItems[$idx + 1] = $x;
            }

            foreach ($temp2 as $idx => $x) {
                $newItems[$idx] = $x;
            }
        }
        $this->multipleChoiceExample = collect($newItems)->sortKeys()->toArray();
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
