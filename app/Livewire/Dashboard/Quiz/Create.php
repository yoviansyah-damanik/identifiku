<?php

namespace App\Livewire\Dashboard\Quiz;

use App\Models\Quiz;
use Livewire\Component;
use App\Models\QuizPhase;
use App\Helpers\QuizHelper;
use App\Models\QuizCategory;
use App\Helpers\GeneralHelper;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
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
    public string $contentCoverage;
    public string $overview;
    public string $assessmentObjectives;

    public array $quizTypes;
    public string $quizType;

    public string $quizCategorySearch = '';
    public array $quizCategories;
    public string $quizCategory = '';

    public string $quizPhaseSearch = '';
    public array $quizPhases;
    public string $quizPhase = '';

    public bool $isLoading = false;

    public function mount()
    {
        $this->quizTypes = QuizHelper::getQuizType();
        $this->quizType = $this->quizTypes[0]['value'];

        $this->steps = QuizHelper::getQuizStep();
        $this->step = 1;

        $this->setQuizCategories();
        $this->setQuizPhases();

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

    public function setQuizCategories()
    {
        $this->quizCategories = QuizCategory::where('name', 'like', '%' . $this->quizCategorySearch . '%')
            ->limit(10)
            ->get()
            ->map(fn($quizCategory) => [
                'title' => $quizCategory->name,
                'value' => $quizCategory->id,
                'description' => $quizCategory->description,
            ])
            ->toArray();
    }

    public function setQuizPhases()
    {
        $this->quizPhases = QuizPhase::with('grades')
            ->where('name', 'like', '%' . $this->quizPhaseSearch . '%')
            ->limit(10)
            ->get()
            ->map(fn($quizPhase) => [
                'title' => $quizPhase->name,
                'value' => $quizPhase->id,
                'description' => $quizPhase->grades->pluck('name')->join(', '),
            ])
            ->toArray();
    }

    public function setSearchQuizCategory(QuizCategory $quizCategory)
    {
        $this->quizCategory = $quizCategory->id;
        $this->dispatch('setTitleQuizCategory', $quizCategory->name);
    }

    public function setSearchQuizCategorySearch($data)
    {
        $this->quizCategorySearch = $data;
        $this->setQuizCategories();
    }

    public function setValueQuizCategorySearch($data)
    {
        $this->quizCategory = $data;
        $this->resetValidation('quizCategory');
    }

    public function resetValueQuizCategorySearch()
    {
        $this->reset('quizCategory', 'quizCategorySearch');
    }

    public function setSearchQuizPhase(QuizPhase $quizPhase)
    {
        $this->quizPhase = $quizPhase->id;
        $this->dispatch('setTitleQuizPhase', $quizPhase->name);
    }

    public function setSearchQuizPhaseSearch($data)
    {
        $this->quizPhaseSearch = $data;
        $this->setQuizPhases();
    }

    public function setValueQuizPhaseSearch($data)
    {
        $this->quizPhase = $data;
        $this->resetValidation('quizPhase');
    }

    public function resetValueQuizPhaseSearch()
    {
        $this->reset('quizPhase', 'quizPhaseSearch');
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
            // 'questionType' => [
            //     'required',
            //     Rule::in(collect($this->questionTypes)->pluck('value')->toArray())
            // ],
            'estimationTime' => 'required|numeric|min:1',
            'contentCoverage' => 'required|string',
            'overview' => 'required|string',
            'assessmentObjectives' => 'required|string',
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
            // 'questionType' => __(':type Type', ['type' => __('Question')]),
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
