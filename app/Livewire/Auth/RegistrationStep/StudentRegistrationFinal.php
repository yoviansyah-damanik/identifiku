<?php

namespace App\Livewire\Auth\RegistrationStep;

use Carbon\Carbon;
use App\Jobs\Mailer;
use App\Enums\Genders;
use App\Models\School;
use Livewire\Component;
use App\Models\GradeLevel;
use App\Rules\PhoneNumber;
use Illuminate\Support\Str;
use App\Models\StudentRequest;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rules\Password;
use Jantinnerezo\LivewireAlert\LivewireAlert;

#[Layout('layouts.auth')]
class StudentRegistrationFinal extends Component
{
    use LivewireAlert;

    public array $genders;

    public string $nis;
    public string $nisn;
    public string $name;
    public string $address;
    public string $placeOfBirth;
    public string $dateOfBirth;
    public string $gender;
    public string $phoneNumber;

    public string $username;
    public string $email;
    public string $password;
    public string $rePassword;

    public string $gradeLevelSearch = '';
    public string $gradeLevel = '';

    public string $schoolId;
    public string $token;

    public int $step = 1;
    public int $stepMin = 1;
    public int $stepMax = 2;

    public string $thisDay;

    public string $educationLevel;
    public array $gradeLevelList;

    public string $successfulMessage;

    public int $maxNis = 8;
    public int $maxNisn = 8;

    public bool $isLoading = false;

    public function dev()
    {
        $this->nis = fake()->numerify('########');
        $this->nisn = fake()->numerify('########');
        $this->name = fake()->name;
        $this->address = fake()->address;
        $this->placeOfBirth = fake()->city;
        $this->dateOfBirth = fake()->date;
        $this->gender = 'M';
        $this->phoneNumber = fake()->e164PhoneNumber();

        $this->username = Str::of(fake()->userName())->replace('.', '_')->snake();
        $this->email = fake()->email();
        $this->password = '@Password123';
        $this->rePassword = '@Password123';
    }

    public function mount()
    {
        $this->dev();
        $this->schoolId = Route::current()->parameter('school');
        $this->token = Route::current()->parameter('token');
        $school = School::whereId($this->schoolId)->whereToken($this->token)->first();
        if (!School::whereId($this->schoolId)->whereToken($this->token)->first())
            return $this->redirectRoute('registration');

        $educationLevel = $school->educationLevel;
        $this->educationLevel = $educationLevel->id;
        $this->gradeLevelList = $educationLevel->grades->pluck('id')->toArray();

        $this->thisDay = Carbon::now();
        $this->genders = collect(Genders::cases())
            ->map(fn($gender) => ['value' => $gender->name, 'label' => $gender->value])
            ->toArray();

        $this->successfulMessage = __('Student enrollment was successful. Please contact the School Administrator to confirm.');
    }

    public function render()
    {
        $gradeLevels = GradeLevel::where('name', 'like', '%' . $this->gradeLevelSearch . '%')
            ->where('education_level_id', $this->educationLevel)
            ->limit(10)
            ->get()
            ->map(fn($gradeLevel) => [
                'title' => $gradeLevel->name,
                'value' => $gradeLevel->id,
                // 'description' => $gradeLevel->description,
            ])
            ->toArray();

        return view('pages.auth.registration-step.student-registration-final', compact('gradeLevels'))
            ->title(__('Registration'));
    }

    public function rules()
    {
        if ($this->step == 1) {
            return [
                'name' => 'required|string|max:60',
                'nis' => [
                    'required',
                    'string',
                    'digits:' . $this->maxNis,
                    'unique:student_requests,local_nis',
                    Rule::unique('students', 'local_nis')->where(fn(Builder $query) => $query->where('school_id', $this->schoolId))
                ],
                'nisn' => 'required|string|digits:' . $this->maxNisn . '|unique:students,nisn|unique:student_requests,nisn',
                'address' => 'required|string|max:255',
                'placeOfBirth' => 'required|string|max:40',
                'dateOfBirth' => 'required|date|beforeOrEqual:' . \Carbon\Carbon::now()->addYears(-5)->format('Y-m-d'),
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

        if ($this->step == 2)
            return [
                'email' => 'required|email:dns|unique:users,email|unique:student_requests,email',
                'username' => 'required|min:8|max:32|alpha_dash|string|unique:users,username|unique:student_requests,username',
                'password' =>   [
                    'required',
                    'string',
                    Password::min(8)->letters()->numbers()->symbols()
                ],
                'rePassword' => 'required|same:password'
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
            'username' => __('Username'),
            'email' => __('Email'),
            'password' => __('Password'),
            'gradeLevel' => __('Grade Level'),
            'rePassword' => __('Re-Password'),
        ];
    }

    public function messages()
    {
        return [
            'dateOfBirth.before_or_equal' => __('The :attribute field must be a date before or equal to :date.', ['date' => Carbon::parse($this->thisDay)->translatedFormat('d M Y')]),
        ];
    }

    public function updated($attribute)
    {
        $this->validateOnly($attribute);
    }

    public function next()
    {
        $this->validate();

        $isExist = StudentRequest::where('local_nis', $this->nis)
            ->orWhere('nisn', $this->nisn)->first();

        if ($isExist) {
            if ($isExist->nisn == $this->nisn) {
                $this->alert('warning', __('The student with :value (:attribute) has been registered. Please contact the School Administrator to verify the registration.', ['value' => $this->nisn, 'attribute' => 'NISN']));
            }
            if ($isExist->local_nis == $this->nis) {
                $this->alert('warning', __('The student with :value (:attribute) has been registered. Please contact the School Administrator to verify the registration.', ['value' => $this->nis, 'attribute' => __('Local NIS')]));
            }
            return;
        }

        if ($this->step < $this->stepMax) $this->step++;
        else $this->step = $this->stepMax;
    }

    public function prev()
    {
        if ($this->step > $this->stepMin) $this->step--;
        else $this->step = $this->stepMin;
    }

    public function resetStep()
    {
        $this->step = $this->stepMin;
    }

    public function setSearchSearchGradeLevel($data)
    {
        $this->gradeLevelSearch = $data;
    }

    public function setValueGradeLevel($data)
    {
        $this->gradeLevel = $data;
        $this->resetValidation('gradeLevel');
    }

    public function resetValueGradeLevel()
    {
        $this->reset('gradeLevel', 'gradeLevelSearch');
    }

    public function submit()
    {
        $this->validate();
        $this->isLoading = true;
        DB::beginTransaction();
        try {
            // $user = User::create([
            //     'username' => $this->username,
            //     'password' => bcrypt($this->username),
            //     'email' => $this->email
            // ])->assignRole('Student');

            // $student = Student::create([
            //     'local_nis' => $this->nis,
            //     'nisn' => $this->nisn,
            //     'name' => $this->name,
            //     'address' => $this->address,
            //     'place_of_birth' => $this->placeOfBirth,
            //     'date_of_birth' => \Carbon\Carbon::parse($this->dateOfBirth)->format('Y-m-d'),
            //     'gender' => $this->gender,
            //     'phone_number' => $this->phoneNumber,
            //     'school_id' => $this->schoolId
            // ]);

            // UserHasRelation::create([
            //     'user_id' => $user->id,
            //     'modelable_type' => Student::class,
            //     'modelable_id' => $student->id
            // ]);

            $studentRequest = StudentRequest::create([
                'username' => $this->username,
                'password' => bcrypt($this->username),
                'email' => $this->email,
                'local_nis' => $this->nis,
                'nisn' => $this->nisn,
                'name' => $this->name,
                'address' => $this->address,
                'place_of_birth' => $this->placeOfBirth,
                'date_of_birth' => \Carbon\Carbon::parse($this->dateOfBirth)->format('Y-m-d'),
                'gender' => $this->gender,
                'phone_number' => $this->phoneNumber,
                'school_id' => $this->schoolId,
                'grade_level_id' => $this->gradeLevel,
            ]);

            DB::commit();
            $school = School::findOrFail($this->schoolId);
            dispatch(new Mailer('student_registration', $school->user->email, $studentRequest->toArray()));
            $this->step++;
            $this->isLoading = false;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->isLoading = false;
            $this->alert('warning', $e->getMessage());
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->isLoading = false;
            $this->alert('warning', $e->getMessage());
        }
    }
}
