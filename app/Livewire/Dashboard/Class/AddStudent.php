<?php

namespace App\Livewire\Dashboard\Class;

use App\Models\Student;
use Livewire\Component;
use App\Models\GradeLevel;
use Livewire\Attributes\On;
use App\Models\StudentClass;
use App\Models\StudentHasClass;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AddStudent extends Component
{
    use LivewireAlert;
    public bool $isLoading = true;

    public array $gradeLevels;
    public ?string $gradeLevel = null;
    public string $gradeLevelSearch  = '';

    public array $students;
    public string $student;
    public string $studentSearch  = '';

    public $class;

    public function render()
    {
        return view('pages.dashboard.class.add-student');
    }

    public function rules()
    {
        return [
            'student' => [
                'required',
                Rule::exists('students', 'id')
                    ->where(fn($q) => $q->where('school_id', $this->class->teacher->school->id)
                        ->when($this->gradeLevel != 'all', fn($r) => $r->where('grade_level_id', $this->gradeLevel)))
            ],
        ];
    }

    public function validationAttributes()
    {
        return [
            'gradeLevel' => __('Grade Level'),
            'student' => __('Student')
        ];
    }

    #[On('setAddStudent')]
    public function setInit(?StudentClass $class = null)
    {
        $this->reset('gradeLevel', 'student');

        if ($class)
            $this->class = $class;

        $this->setGradeLevels();
        $this->setStudents();
        $this->resetValueGradeLevel();
        $this->resetValueStudent();
        $this->isLoading = false;
    }

    public function setGradeLevels()
    {
        $this->gradeLevels = GradeLevel::where('name', 'like', '%' . $this->gradeLevelSearch  . '%')
            ->limit(10)
            ->get()
            ->map(fn($gradeLevel) => [
                'title' => $gradeLevel->name,
                'value' => $gradeLevel->id,
                'description' => $gradeLevel->fullAddress,
            ])
            ->toArray();

        array_unshift($this->gradeLevels, [
            'title' => __('All'),
            'value' => 'all',
            'description' => __('All Grade Levels'),
        ]);
    }

    public function setSearchGradeLevelSearch($data)
    {
        $this->gradeLevelSearch = $data;
        $this->setGradeLevels();
    }

    public function setValueGradeLevel($data)
    {
        $this->gradeLevel = $data;
        $this->resetValidation('gradeLevel');
        $this->setStudents();
        $this->resetValueStudent();
    }

    public function resetValueGradeLevel()
    {
        $this->reset('gradeLevel', 'gradeLevelSearch');
        $this->dispatch('resetValueGradeLevel');
    }

    public function setStudents()
    {
        if (!is_null($this->gradeLevel)) {
            $this->students = Student::where('name', 'like', '%' . $this->studentSearch  . '%')
                ->when($this->gradeLevel != 'all', fn($q) => $q->where('grade_level_id', $this->gradeLevel))
                ->where('school_id', $this->class->teacher->school->id)
                ->whereDoesntHave('hasClasses', fn($q) => $q->where('student_class_id', $this->class->id))
                ->limit(10)
                ->get()
                ->map(fn($student) => [
                    'title' => $student->name,
                    'value' => $student->id,
                    'description' => $student->fullAddress,
                ])
                ->toArray();
        } else {
            $this->students = [];
        }
    }

    public function setSearchStudentSearch($data)
    {
        $this->studentSearch = $data;
        $this->setStudents();
    }

    public function setValueStudent($data)
    {
        $this->student = $data;
        $this->resetValidation('student');
    }

    public function resetValueStudent()
    {
        $this->reset('student', 'studentSearch');
        $this->dispatch('resetValueStudent');
    }

    public function store()
    {
        $this->validate();
        $this->isLoading = true;
        try {
            $studentAdded = StudentHasClass::firstOrCreate([
                'student_id' => $this->student,
                'student_class_id' => $this->class->id
            ]);

            if (!$studentAdded->wasRecentlyCreated) {
                $this->alert('warning', __('Student have joined this class'));
                $this->isLoading = false;
                return;
            }

            $this->dispatch('toggle-add-student-modal');
            $this->dispatch('resetClassData');
            $this->setInit();

            $this->alert('success', __(':attribute added successfully.', ['attribute' => __('Student')]));
        } catch (\Exception $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        } catch (\Throwable $e) {
            $this->isLoading = false;
            $this->alert('error', $e->getMessage());
        }
    }
}
