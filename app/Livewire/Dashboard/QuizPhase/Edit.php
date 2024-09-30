<?php

namespace App\Livewire\Dashboard\QuizPhase;

use Livewire\Component;
use App\Models\QuizPhase;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Edit extends Component
{
    use LivewireAlert;
    public bool $isLoading = false;

    public QuizPhase $quizPhase;
    public string $name;
    public string $description;

    public array $grades;
    public array $gradeLevels;

    public function mount($gradeLevels)
    {
        $this->gradeLevels = $gradeLevels;
    }

    #[On('setEditQuizPhase')]
    public function setEditQuizPhase(QuizPhase $quizPhase)
    {
        $this->quizPhase = $quizPhase;
        $this->name = $quizPhase->name;
        $this->description = $quizPhase->description;
        $this->grades = $quizPhase->grades->pluck('id')->toArray();
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

    public function render()
    {
        return view('pages.dashboard.quiz-phase.edit');
    }

    public function save()
    {
        $this->validate();
        $this->isLoading = true;
        DB::beginTransaction();
        try {
            $this->quizPhase->update([
                'name' => $this->name,
                'description' => $this->description,
            ]);

            $this->quizPhase->details()->delete();
            $this->quizPhase->details()->createMany(collect($this->grades)->map(fn($item) => ['grade_level_id' => $item])->toArray());

            DB::commit();
            $this->dispatch('toggle-edit-quiz-phase-modal');
            $this->dispatch('refreshQuizPhaseData');
            $this->reset('name', 'description', 'grades');

            $this->alert('success', __(':attribute updated successfully.', ['attribute' => __('Quiz Phase')]));
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
}
