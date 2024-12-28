<?php

namespace App\Livewire\Auth\RegistrationStep;

use Carbon\Carbon;
use App\Jobs\Mailer;
use App\Enums\Genders;
use App\Models\School;
use Livewire\Component;
use App\Rules\PhoneNumber;
use Illuminate\Support\Str;
use App\Models\TeacherRequest;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rules\Password;
use Jantinnerezo\LivewireAlert\LivewireAlert;

#[Layout('layouts.auth')]
class TeacherRegistrationFinal extends Component
{
    use LivewireAlert;

    public array $genders;

    public string $nuptk;
    public string $name;
    public string $address;
    public string $placeOfBirth;
    public string $dateOfBirth;
    public string $gender;
    public string $subject;
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

    public string $educationLevel;
    public array $gradeLevelList;

    public string $successfulMessage;

    public int $maxNuptk = 8;

    public bool $isLoading = false;

    public function dev()
    {
        $this->nuptk = fake()->numerify('########');
        $this->name = fake()->name;
        $this->address = fake()->address;
        $this->placeOfBirth = fake()->city;
        $this->dateOfBirth = fake()->date;
        $this->subject = 'English or Spanish';
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

        $this->genders = collect(Genders::cases())
            ->map(fn($gender) => ['value' => $gender->name, 'label' => $gender->value])
            ->toArray();

        $this->successfulMessage = __('Teacher enrollment was successful. Please contact the School Administrator to confirm.');
    }

    public function render()
    {
        return view('pages.auth.registration-step.teacher-registration-final')
            ->title(__('Registration'));
    }

    public function rules()
    {
        if ($this->step == 1) {
            return [
                'name' => 'required|string|max:60',
                'nuptk' => 'required|string|digits:' . $this->maxNuptk . '|unique:teachers,nuptk|unique:teacher_requests,nuptk',
                'address' => 'required|string|max:255',
                'placeOfBirth' => 'required|string|max:40',
                'dateOfBirth' => 'required|date|beforeOrEqual:' . now()->addYears(-5)->format('Y-m-d'),
                'gender' => [
                    'required',
                    Rule::in(Genders::names())
                ],
                'phoneNumber' => ['required', new PhoneNumber],
                'subject' => 'required|string|max:60',
            ];
        }

        if ($this->step == 2)
            return [
                'email' => 'required|email:dns|unique:users,email|unique:teacher_requests,email|unique:student_requests,email',
                'username' => 'required|min:8|max:32|alpha_dash|string|unique:users,username|unique:teacher_requests,username|unique:student_requests,username',
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
            'nuptk' => 'NUPTK',
            'name' => __(':name Name', ['name' => __('Teacher')]),
            'placeOfBirth' => __('Place of Birth'),
            'dateOfBirth' => __('Date of Birth'),
            'gender' => __('Gender'),
            'phoneNumber' => __('Phone Number'),
            'address' => __('Address'),
            'subject' => __('Mata Pelajaran'),
            'username' => __('Username'),
            'email' => __('Email'),
            'password' => __('Password'),
            'rePassword' => __('Re-Password'),
        ];
    }

    public function messages()
    {
        return [
            'dateOfBirth.before_or_equal' => __('The :attribute field must be a date before or equal to :date.', ['date' => Carbon::now()->translatedFormat('d M Y')]),
        ];
    }

    public function updated($attribute)
    {
        $this->validateOnly($attribute);
    }

    public function next()
    {
        $this->validate();

        $isExist = TeacherRequest::where('nuptk', $this->nuptk)->first();

        if ($isExist) {
            if ($isExist->nuptk == $this->nuptk) {
                $this->alert('warning', __('The teacher with :value (:attribute) has been registered. Please contact the School Administrator to verify the registration.', ['value' => $this->nuptk, 'attribute' => 'NUPTK']));
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

    public function submit()
    {
        $this->validate();
        $this->isLoading = true;
        DB::beginTransaction();
        try {
            $teacherRequest = TeacherRequest::create([
                'username' => Str::lower($this->username),
                'password' => bcrypt($this->password),
                'email' => Str::lower($this->email),
                'nuptk' => $this->nuptk,
                'name' => $this->name,
                'address' => $this->address,
                'place_of_birth' => $this->placeOfBirth,
                'date_of_birth' => \Carbon\Carbon::parse($this->dateOfBirth)->format('Y-m-d'),
                'gender' => $this->gender,
                'phone_number' => $this->phoneNumber,
                'school_id' => $this->schoolId,
                'subject' => $this->subject,
            ]);

            DB::commit();
            // $school = School::findOrFail($this->schoolId);
            // dispatch(new Mailer('teacher_registration', $school->user->email, $teacherRequest->toArray()));
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
