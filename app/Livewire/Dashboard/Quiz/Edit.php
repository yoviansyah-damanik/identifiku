<?php

namespace App\Livewire\Dashboard\Quiz;

use App\Models\Quiz;
use App\Enums\QuizType;
use Livewire\Component;
use App\Models\QuizPhase;
use Illuminate\Support\Str;
use App\Models\QuestionType;
use App\Models\QuizCategory;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

#[Layout('layouts.dashboard')]
class Edit extends Component
{
    use LivewireAlert;

    protected $listeners = ['refreshQuizData' => '$refresh'];
    public Quiz $quiz;
    public ?string $groupActive = null;

    public array $quizTypes;
    public string $quizType;

    public array $steps;
    public int $step;

    public string $quizName;
    public string $quizDescription;
    public string $estimationTime;
    public string $contentCoverage;
    public string $overview;
    public string $assessmentObjectives;

    public bool $isLoading = false;

    public array $quizCategories;
    public array $quizPhases;
    public string $quizCategory;
    public string $quizPhase;

    public ?QuizPhase $selectedQuizPhase;
    public ?QuizCategory $selectedQuizCategory;

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz->load('types');
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

        $this->step = 2;

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
    }

    public function render()
    {
        if ($this->step == 2) {
            $this->selectedQuizPhase = QuizPhase::find($this->quizPhase);
            $this->selectedQuizCategory = QuizCategory::find($this->quizCategory);
        }

        return view('pages.dashboard.quiz.edit')
            ->title(__('Edit :edit', ['edit' => __('Quiz')]));
    }

    // #[On('addType')]
    // public function addType(array $type)
    // {
    //     $this->types->push(['_id' => Str::random(8), ...$type, 'order' => $this->types->count(), 'groups' => new Collection()]);
    // }

    // #[On('addGroup')]
    // public function addGroup(string $typeId, array $group)
    // {
    //     $this->types->map(
    //         function ($item) use ($typeId, $group) {
    //             if ($item['_id'] == $typeId)
    //                 return collect([
    //                     ...$item,
    //                     $item['groups']->push(
    //                         [
    //                             '_id' => Str::random(8),
    //                             ...$group,
    //                             'questions' => new Collection()
    //                         ]
    //                     )
    //                 ]);
    //             return $item;
    //         }
    //     );
    // }

    // #[On('addQuestion')]
    // public function addQuestion(string $groupId, array $question) {}

    public function setRule(int $step)
    {
        $step ??= $this->step;

        if ($step == 1) {
            $this->validate(
                [
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
                ],
                [],
                [
                    'quizName' => __(':name Name', ['name' => __('Quiz')]),
                    'quizType' => __(':type Type', ['type' => __('Quiz')]),
                    'quizCategory' => __('Quiz Category'),
                    'quizPhase' => __('Quiz Phase'),
                    'estimationTime' => __('Estimation Time'),
                    'contentCoverage' => __('Content Coverage'),
                    'overview' => __('Overview'),
                    'assessmentObjectives' => __('Assessment Objectives'),
                ]
            );
        }
    }

    public function setStep(int $step)
    {
        // if ($step > $this->step) {
        //     foreach (range(1, $step) as $x)
        //         $this->setRule($x);
        // }
        $this->step = $step;
    }


    public function saveQuiz()
    {
        $this->setRule(1);
        try {
            $this->quiz->update([
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

            $this->alert('success', __(':attribute updated successfully.', ['attribute' => __('Quiz')]));
            $this->step = 2;
        } catch (\Exception $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        }
    }

    public function saveTemp() {}

    public function reorderQuizType($id, $position)
    {
        $this->isLoading = true;
        DB::beginTransaction();
        try {
            $exist = QuestionType::where('id', $id)->first();

            if ($exist->order < $position + 1) {
                $exist->update(['order' => $position + 1]);
                QuestionType::whereNot('id', $id)
                    ->where('order', '<=', $position + 1)
                    ->orderBy('order', 'asc')
                    ->each(function ($item, $key) use ($position) {
                        $item->update(['order' => $key + 1]);
                    });
            } else {
                $exist->update(['order' => $position + 1]);
                QuestionType::whereNot('id', $id)
                    ->where('order', '>=', $position + 1)
                    ->orderBy('order', 'asc')
                    ->each(function ($item, $key) use ($position) {
                        $item->update(['order' => ($position + 1) + $key + 1]);
                    });
            }

            DB::commit();
            $this->quiz->refresh();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        }
    }

    public function reorderQuizGroup($id, $position)
    {
        $this->isLoading = true;
        DB::beginTransaction();
        try {
            $exist = QuestionType::where('id', $id)->first();

            if ($exist->order < $position + 1) {
                $exist->update(['order' => $position + 1]);
                QuestionType::whereNot('id', $id)
                    ->where('order', '<=', $position + 1)
                    ->orderBy('order', 'asc')
                    ->each(function ($item, $key) use ($position) {
                        $item->update(['order' => $key + 1]);
                    });
            } else {
                $exist->update(['order' => $position + 1]);
                QuestionType::whereNot('id', $id)
                    ->where('order', '>=', $position + 1)
                    ->orderBy('order', 'asc')
                    ->each(function ($item, $key) use ($position) {
                        $item->update(['order' => ($position + 1) + $key + 1]);
                    });
            }

            DB::commit();
            $this->quiz->refresh();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        }
    }
}
