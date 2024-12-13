<?php

namespace App\Livewire\Dashboard\Assessment;

use App\Models\Quiz;
use Livewire\Component;
use App\Models\Assessment;
use App\Models\StudentClass;
use Livewire\Attributes\Url;
use App\Helpers\GeneralHelper;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class History extends Component
{
    public array $perPageList;
    public int $perPage;

    #[Url]
    public string $search = '';

    public bool $isLoading = false;

    public array $statuses;

    #[Url]
    public string $status;

    public function mount()
    {
        $this->perPageList = GeneralHelper::getPerPageList();
        $this->perPage = $this->perPageList[0];

        $this->statuses = [
            [
                'value' => 'all',
                'title' => __('All')
            ],
            [
                'value' => 1,
                'title' => __('Process')
            ],
            [
                'value' => 2,
                'title' => __('Submitted')
            ],
            [
                'value' => 3,
                'title' => __('Done')
            ],
        ];

        if (empty($this->status))
            $this->status = $this->statuses[0]['value'];
    }

    public function render()
    {
        $assessments = Assessment::with([
            'quiz',
            'quiz.phase',
            'quiz.assessmentRule',
            'quiz.category',
            'quiz.phase.grades',
            'quiz.picture',
            'quiz.groups' => fn($q) => $q->withCount('questions'),
            'class'
        ])
            ->when($this->status != 'all', fn($q) => $q->where('status', $this->status))
            ->whereHas('quiz', fn($q) => $q->whereAny(['name'], 'like', "%$this->search%"))
            ->where('student_id', auth()->user()->student->id)
            ->orderBy('status', 'asc')
            ->paginate($this->perPage);

        return view('pages.dashboard.assessment.history', compact('assessments'))
            ->title(__('Assessment History'));
    }

    public function play(Quiz $quiz, StudentClass $class)
    {
        $this->isLoading = true;
        try {
            $assessment = Assessment::firstOrCreate([
                'student_id' => auth()->user()->student->id,
                'student_class_id' => $class->id,
                'quiz_id' => $quiz->id,
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
