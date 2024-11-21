<?php

namespace App\Livewire\Dashboard\Quiz\Step;

use App\Models\Quiz;
use App\Enums\QuizType;
use Livewire\Component;
use App\Models\QuizPhase;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use App\Models\QuizCategory;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class StepOne extends Component
{
    use LivewireAlert;

    public Quiz $quiz;

    public string $quizName;
    public string $quizDescription;
    public string $estimationTime;
    public string $contentCoverage;
    public string $overview;
    public string $assessmentObjectives;

    public string $quizCategorySearch = '';
    public array $quizCategories;
    public string $quizCategory = '';

    public string $quizPhaseSearch = '';
    public array $quizPhases;
    public string $quizPhase = '';

    public array $quizTypes;
    public string $quizType;

    public string $initQuizCategory;
    public string $initQuizPhase;

    public bool $isLoading = false;

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;
        $this->quizName = $quiz->name;
        $this->estimationTime = $quiz->estimation_time;
        $this->contentCoverage = $quiz->content_coverage;
        $this->overview = $quiz->overview;
        $this->assessmentObjectives = $quiz->assessment_objectives;

        $this->quizTypes = collect(QuizType::names())
            ->map(fn($item) => [
                'value' => $item,
                'title' => __(Str::headline($item))
            ])->toArray();

        $this->setQuizCategories();
        $this->setQuizPhases();

        $this->quizCategory = $quiz->quiz_category_id;
        $this->quizPhase = $quiz->quiz_phase_id;
        $this->quizType = $quiz->type;

        $this->initQuizCategory = QuizCategory::where('id', $this->quizCategory)->first()->name;
        $this->initQuizPhase = QuizPhase::where('id', $this->quizPhase)->first()->name;
    }

    public function render()
    {
        return view('pages.dashboard.quiz.step.step-one');
    }

    public function placeholder()
    {
        return <<<'HTML'
        <div class="text-center">
            <!-- Loading spinner... -->
            <x-loading/>
        </div>
        HTML;
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
            // 'quizType' => [
            //     'required',
            //     Rule::in(collect($this->quizTypes)->pluck('value')->toArray())
            // ],
            'quizPhase' => [
                'required',
                Rule::in(collect($this->quizPhases)->pluck('value')->toArray())
            ],
            'quizCategory' => [
                'required',
                Rule::in(collect($this->quizCategories)->pluck('value')->toArray())
            ],
            'estimationTime' => 'required|numeric|min:1',
            'contentCoverage' => 'required|string',
            'overview' => 'required|string',
            'assessmentObjectives' => 'required|string',
        ];
    }

    public function validationAttributes()
    {
        return [
            'quizName' => __(':name Name', ['name' => __('Quiz')]),
            // 'quizType' => __(':type Type', ['type' => __('Quiz')]),
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
            $this->quiz->update([
                'name' => $this->quizName,
                // 'type' => $this->quizType,
                'quiz_category_id' => $this->quizCategory,
                'quiz_phase_id' => $this->quizPhase,
                'estimation_time' => $this->estimationTime,
                'content_coverage' => $this->contentCoverage,
                'overview' => $this->overview,
                'assessment_objectives' => $this->assessmentObjectives,
                'user_id' => auth()->user()->id,
            ]);

            $this->alert('success', __(':attribute updated successfully.', ['attribute' => __('Quiz')]));
            $this->dispatch('setStep', step: 2);
        } catch (\Exception $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        }
    }
}
