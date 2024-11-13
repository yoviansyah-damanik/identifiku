<?php

namespace App\Livewire\Dashboard\Quiz;

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

#[Layout('layouts.dashboard')]
class Create extends Component
{
    public ?string $groupActive = null;
    public Collection $types;

    public array $quizTypes;
    public string $quizType;

    public string $quizName;
    public string $quizDescription;

    public array $steps;
    public int $step;

    public bool $isLoading = false;

    public array $quizCategories;
    public array $quizPhases;
    public string $quizCategory;
    public string $quizPhase;

    public ?QuizPhase $selectedQuizPhase;
    public ?QuizCategory $selectedQuizCategory;

    public function mount()
    {
        $this->types = new Collection();
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

        if (!GeneralHelper::isProduction())
            $this->dev();
    }

    public function dev()
    {
        $this->quizName = fake()->name;
        $this->quizDescription = fake()->sentence();

        foreach (range(0, 5) as $x)
            $this->addType([
                'name' => fake()->name,
                'description' => fake()->sentence()
            ]);
    }

    public function render()
    {
        if ($this->step == 2) {
            $this->selectedQuizPhase = QuizPhase::find($this->quizPhase);
            $this->selectedQuizCategory = QuizCategory::find($this->quizCategory);
        }

        return view('pages.dashboard.quiz.create')
            ->title(__('Add :add', ['add' => __('Quiz')]));
    }

    #[On('addType')]
    public function addType(array $type)
    {
        $this->types->push(['_id' => Str::random(8), ...$type, 'order' => $this->types->count()]);
    }

    #[On('addGroup')]
    public function addGroup(int $typeId, array $group) {}

    #[On('addQuestion')]
    public function addQuestion(int $groupId, array $question) {}

    public function setRules(int $step)
    {
        $step ??= $this->step;

        if ($step == 1) {
            $this->validate(
                [
                    'quizName' => 'required|string|max:60',
                    'quizDescription' => 'required|string|max:250',
                    'quizType' => [
                        'required',
                        Rule::in(collect($this->quizTypes)->pluck('value')->toArray())
                    ],
                ],
                [],
                [
                    'quizName' => __(':name Name', ['name' => __('Quiz')]),
                    'quizDescription' => __('Description'),
                    'quizType' => __(':type Type', ['type' => __('Quiz')])
                ]
            );
        }
    }

    public function setStep(int $step)
    {
        if ($step > $this->step) {
            foreach (range(1, $step) as $x)
                $this->setRules($x);
        }

        $this->step = $step;
    }

    public function registerQuiz()
    {
        $this->setRules(1);
        $this->step = 2;
    }

    public function reorderQuizType() {}

    public function saveTemp($id, $position)
    {
        $activeItem = $this->types->where('_id', $id)->first();

        $this->types = $this->types
            ->map(function ($item, $key) use ($id, $position, $activeItem) {
                if ($item['_id'] == $id)
                    return [...$item, 'order' => $position];

                return $item;
            })
            ->map(function ($item, $key) use ($id, $position, $activeItem) {
                if ($key >= $position && $item['_id'] != $id)
                    return [...$item, 'order' => $key + 1];

                return $item;
            })
            ->sortBy('order');

        // $this->types->where('_id', $id)->map(fn($item) => [...$item, 'order' => $position + 1]);
    }
}
