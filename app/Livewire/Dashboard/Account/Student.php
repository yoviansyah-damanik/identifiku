<?php

namespace App\Livewire\Dashboard\Account;

use Carbon\Carbon;
use App\Enums\Genders;
use Livewire\Component;
use App\Models\GradeLevel;
use App\Rules\PhoneNumber;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Isolate;

#[Isolate]
class Student extends Component
{
    use LivewireAlert;

    public string $nis;
    public string $nisn;
    public string $name;
    public string $dateOfBirth;
    public string $placeOfBirth;
    public string $address;
    public string $phoneNumber;
    public string $gender;

    public array $genders;
    public bool $isLoading = false;

    public int $maxNis = 8;
    public int $maxNisn = 8;

    public array $gradeLevels;
    public ?string $gradeLevel = null;
    public string $gradeLevelSearch  = '';

    public string $educationLevel;
    public array $gradeLevelList;

    public function mount()
    {
        $this->genders = collect(Genders::cases())
            ->map(fn($gender) => ['value' => $gender->name, 'label' => $gender->value])
            ->toArray();

        $student = auth()->user()->student;
        $this->nis = $student->nis;
        $this->nisn = $student->nisn;
        $this->name = $student->name;
        $this->dateOfBirth = $student->date_of_birth->format('Y-m-d');
        $this->placeOfBirth = $student->place_of_birth;
        $this->address = $student->address;
        $this->phoneNumber = $student->phone_number;
        $this->gender = $student->gender;
        $this->gradeLevel = $student->grade_level_id;

        $educationLevel = auth()->user()->getSchoolData->educationLevel;
        $this->educationLevel = $educationLevel->id;
        $this->gradeLevelList = $educationLevel->grades->pluck('id')->toArray();

        $this->setGradeLevels();
    }

    public function render()
    {
        return view('pages.dashboard.account.student');
    }

    public function setGradeLevels()
    {
        $this->gradeLevels = GradeLevel::where('name', 'like', '%' . $this->gradeLevelSearch  . '%')
            ->where('education_level_id', $this->educationLevel)
            ->limit(10)
            ->get()
            ->map(fn($gradeLevel) => [
                'title' => $gradeLevel->name,
                'value' => $gradeLevel->id,
                'description' => $gradeLevel->fullAddress,
            ])
            ->toArray();
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
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:60',
            'nis' => [
                'nullable',
                'string',
                'digits:' . $this->maxNis,
                'unique:student_requests,nis',
                Rule::unique('students', 'nis')->where(fn(Builder $query) => $query->where('school_id', auth()->user()->getSchoolData->id))->ignore(auth()->user()->student->id)
            ],
            'nisn' => 'required|string|digits:' . $this->maxNisn . '|unique:students,nisn,' . auth()->user()->student->id . '|unique:student_requests,nisn',
            'address' => 'required|string|max:255',
            'placeOfBirth' => 'required|string|max:40',
            'dateOfBirth' => 'required|date|beforeOrEqual:' . now()->addYears(-5)->format('Y-m-d'),
            'gender' => [
                'required',
                Rule::in(Genders::names())
            ],
            'phoneNumber' => ['required', new PhoneNumber],
            'gradeLevel' => [
                'required',
                Rule::in($this->gradeLevelList)
            ]
        ];
    }

    public function validationAttributes()
    {
        return [
            'nis' => 'NIS',
            'nisn' => 'NISN',
            'name' => __(':name Name', ['name' => __('Student')]),
            'placeOfBirth' => __('Place of Birth'),
            'dateOfBirth' => __('Date of Birth'),
            'gender' => __('Gender'),
            'phoneNumber' => __('Phone Number'),
            'address' => __('Address'),
            'gradeLevel' => __('Grade Level'),
        ];
    }

    public function submit()
    {
        $this->validate();
        $this->isLoading = true;
        try {
            auth()->user()->student->update([
                'name' => $this->name,
                'address' => $this->address,
                'place_of_birth' => $this->placeOfBirth,
                'date_of_birth' => \Carbon\Carbon::parse($this->dateOfBirth)->format('Y-m-d'),
                'gender' => $this->gender,
                'phone_number' => $this->phoneNumber,
            ]);
            $this->isLoading = false;
            $this->alert('success', __(':attribute updated successfully.', ['attribute' => __('Account')]));
        } catch (\Exception $e) {
            $this->isLoading = false;
            $this->alert('warning', $e->getMessage());
        } catch (\Throwable $e) {
            $this->isLoading = false;
            $this->alert('warning', $e->getMessage());
        }
    }
}
