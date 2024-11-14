<?php

namespace App\Livewire\Dashboard\Quiz;

use App\Models\Quiz;
use App\Enums\QuizType;
use Livewire\Component;
use App\Models\QuizPhase;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use App\Models\QuizCategory;
use App\Helpers\GeneralHelper;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Illuminate\Support\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;

#[Layout('layouts.dashboard')]
class Create extends Component
{
    use LivewireAlert;

    public array $steps;
    public int $step;

    public string $quizName;
    public string $quizDescription;
    public string $estimationTime;
    public array $quizCategories;
    public array $quizPhases;
    public string $quizCategory;
    public string $quizPhase;
    public string $contentCoverage;
    public string $overview;
    public string $assessmentObjectives;
    public array $quizTypes;
    public string $quizType;

    public ?QuizPhase $selectedQuizPhase;
    public ?QuizCategory $selectedQuizCategory;

    public bool $isLoading = false;

    public function mount()
    {
        $this->quizTypes = collect(QuizType::names())
            ->map(fn($item) => [
                'value' => $item,
                'title' => __(Str::headline($item))
            ])->toArray();
        $this->quizType = $this->quizTypes[0]['value'];

        $this->steps = [
            [
                'step' => 1,
                'title' => __('Register a Quiz'),
                'description' => __('You are required to register for the quiz first.')
            ],
            [
                'step' => 2,
                'title' => __('Quiz Content'),
                'description' => __('Add :add', ['add' => __('Quiz Content')])
            ],
            [
                'step' => 3,
                'title' => __('Result Set'),
                'description' => __('Add :add', ['add' => __('Result Set')])
            ],
            [
                'step' => 4,
                'title' => __('Confirmation'),
                'description' => __('Quiz Confirmation')
            ]
        ];

        $this->step = 1;

        $this->quizCategories = QuizCategory::get()
            ->map(fn($quizCategory) => [
                'title' => $quizCategory->name,
                'value' => $quizCategory->id,
                'description' => $quizCategory->description,
            ])
            ->toArray();
        $this->quizCategory = $this->quizCategories[0]['value'];

        $this->quizPhases = QuizPhase::get()
            ->map(fn($quizPhase) => [
                'title' => $quizPhase->name,
                'value' => $quizPhase->id,
                'description' => $quizPhase->grades->pluck('name')->join(', '),
            ])
            ->toArray();
        $this->quizPhase = $this->quizPhases[0]['value'];

        if (!GeneralHelper::isProduction())
            $this->dev();
    }

    public function dev()
    {
        $this->quizName = fake()->name;
        $this->estimationTime = rand(60, 120);
        $this->quizDescription = fake()->sentence();
        $this->contentCoverage = fake()->sentence();
        $this->overview = fake()->sentence();
        $this->assessmentObjectives = fake()->sentence();
    }

    public function render()
    {
        return view('pages.dashboard.quiz.create')
            ->title(__('Add :add', ['add' => __('Quiz')]));
    }

    public function rules()
    {
        return [
            'quizName' => 'required|string|max:60',
            'quizType' => [
                'required',
                Rule::in(collect($this->quizTypes)->pluck('value')->toArray())
            ],
            'quizPhase' => [
                'required',
                Rule::in(collect($this->quizPhases)->pluck('value')->toArray())
            ],
            'quizCategory' => [
                'required',
                Rule::in(collect($this->quizCategories)->pluck('value')->toArray())
            ],
            'estimationTime' => 'required|numeric|min:1',
            'contentCoverage' => 'required|string|max:250',
            'overview' => 'required|string|max:250',
            'assessmentObjectives' => 'required|string|max:250',
        ];
    }

    public function validationAttributes()
    {
        return  [
            'quizName' => __(':name Name', ['name' => __('Quiz')]),
            'quizType' => __(':type Type', ['type' => __('Quiz')]),
            'quizCategory' => __('Quiz Category'),
            'quizPhase' => __('Quiz Phase'),
            'estimationTime' => __('Estimation Time'),
            'contentCoverage' => __('Content Coverage'),
            'overview' => __('Overview'),
            'assessmentObjectives' => __('Assessment Objectives'),
        ];
    }

    public function save()
    {
        $this->validate();
        try {
            $newQuiz = Quiz::create([
                'name' => $this->quizName,
                'type' => $this->quizType,
                'quiz_category_id' => $this->quizCategory,
                'quiz_phase_id' => $this->quizPhase,
                'estimation_time' => $this->estimationTime,
                'content_coverage' => $this->contentCoverage,
                'overview' => $this->overview,
                'assessment_objectives' => $this->assessmentObjectives,
                'user_id' => auth()->user()->id,
                'status' => 'draft'
            ]);

            $this->redirectRoute('dashboard.quiz.edit', $newQuiz->id, navigate: true);
        } catch (\Exception $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        }
    }
}
