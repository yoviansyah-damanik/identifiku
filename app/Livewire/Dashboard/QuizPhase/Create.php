<?php

namespace App\Livewire\Dashboard\QuizPhase;

use Livewire\Component;
use App\Models\QuizPhase;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Create extends Component
{
    use LivewireAlert;
    public bool $isLoading = false;
    public string $name;
    public string $description;
    public array $grades;
    public array $gradeLevels;

    public function mount($gradeLevels)
    {
        $this->gradeLevels = $gradeLevels;
    }

    public function render()
    {
        return view('pages.dashboard.quiz-phase.create');
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:60',
            'description' => 'required|string|max:255',
            'grades' => 'required|array',
            'grades.*' => 'exists:grade_levels,id',
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => __(':name Name', ['name' => __('Quiz Phase')]),
            'description' => __('Description'),
            'grades' => __('Grade Level')
        ];
    }

    public function updated($attribute)
    {
        $this->validateOnly($attribute);
    }

    public function store()
    {
        $this->validate();
        $this->isLoading = true;
        DB::beginTransaction();
        try {
            QuizPhase::create([
                'name' => $this->name,
                'description' => $this->description,
            ])->details()->createMany(collect($this->grades)->map(fn($item) => ['grade_level_id' => $item])->toArray());

            DB::commit();
            $this->dispatch('toggle-create-quiz-phase-modal');
            $this->dispatch('refreshQuizPhaseData');
            $this->reset('name', 'description', 'grades');

            $this->alert('success', __(':attribute created successfully.', ['attribute' => __('Quiz Phase')]));
            $this->isLoading = false;
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

    public function refresh()
    {
        $this->reset('name', 'description', 'grades');
    }
}
