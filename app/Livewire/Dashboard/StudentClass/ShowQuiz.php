<?php

namespace App\Livewire\Dashboard\StudentClass;

use App\Models\Assessment;
use App\Models\Quiz;
use Livewire\Component;
use App\Models\StudentClass;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;

class ShowQuiz extends Component
{
    use LivewireAlert;

    public ?Quiz $activeQuiz = null;

    public string $activeQuizUrl = '';
    public $assessment;

    public StudentClass $class;
    public bool $isLoading = false;

    public function mount(StudentClass $class)
    {
        $this->class = $class;
        if ($this->activeQuizUrl)
            $this->setActiveQuiz($this->activeQuizUrl);
    }

    #[On('setActiveQuiz')]
    public function setActiveQuiz(Quiz|string $quiz)
    {
        if (is_string($quiz))
            $quiz = Quiz::whereSlug($quiz)->first();

        $this->isLoading = true;
        $this->activeQuiz = $quiz->load(['assessments', 'phase', 'category', 'phase.grades', 'picture', 'groups' => fn($q) => $q->withCount('questions')]);
        if ($this->activeQuiz)
            $this->assessment = $this->activeQuiz->assessments
                ->where('student_id', auth()->user()->student->id)
                ->where('student_class_id', $this->class->id)
                ->first();

        $this->isLoading = false;
    }

    #[On('setRefreshActiveQuiz')]
    public function refresh()
    {
        $this->reset('activeQuiz');
    }

    public function render()
    {
        return view('pages.dashboard.student-class.show-quiz', [
            'activeQuiz' => $this->activeQuiz
        ]);
    }

    public function play()
    {
        $this->isLoading = true;
        try {
            $assessment = Assessment::firstOrCreate([
                'student_id' => auth()->user()->student->id,
                'student_class_id' => $this->class->id,
                'quiz_id' => $this->activeQuiz->id,
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
