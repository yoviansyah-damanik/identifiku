<?php

namespace App\Livewire\Dashboard\Assessment;

use Livewire\Component;
use App\Models\Assessment;
use Livewire\Attributes\On;
use App\Models\ClassHasQuiz;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ShowQuiz extends Component
{
    use LivewireAlert;

    public ?ClassHasQuiz $activeAssessment = null;

    public $assessment;
    public string $activeAssessmentUrl = '';

    public bool $isLoading = false;

    #[On('setActiveAssessment')]
    public function setActiveAssessment(ClassHasQuiz $hasQuiz)
    {
        if (is_string($hasQuiz))
            $hasQuiz = ClassHasQuiz::whereSlug($hasQuiz)->first();

        $this->isLoading = true;
        $this->activeAssessment = $hasQuiz
            ->load(['quiz', 'class', 'quiz.assessments', 'quiz.phase', 'quiz.category', 'quiz.phase.grades', 'quiz.picture', 'quiz.groups' => fn($q) => $q->withCount('questions')]);
        if ($this->activeAssessment)
            $this->assessment = $this->activeAssessment->quiz->assessments
                ->where('student_id', auth()->user()->student->id)
                ->where('student_class_id', $this->activeAssessment->class->id)
                ->first();

        $this->isLoading = false;
    }

    #[On('setRefreshActiveAssessment')]
    public function refresh()
    {
        $this->reset('activeAssessment');
    }

    public function render()
    {
        return view('pages.dashboard.assessment.show-quiz', [
            'activeAssessment' => $this->activeAssessment
        ]);
    }

    public function play()
    {
        $this->isLoading = true;
        try {
            $assessment = Assessment::firstOrCreate([
                'student_id' => auth()->user()->student->id,
                'student_class_id' => $this->activeAssessment->class->id,
                'quiz_id' => $this->activeAssessment->quiz->id,
            ]);

            $this->authorize('create', $assessment);

            if ($assessment->wasRecentlyCreated || $assessment->isStillPlay) {
                return $this->redirectRoute('assessment.play', $assessment, navigate: false);
            }

            $this->alert('warning', __('You have already done this assessment'));
            $this->isLoading = false;
        } catch (\Exception $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        }
    }
}
