<?php

namespace App\Livewire\Dashboard\Account;

use App\Enums\Genders;
use Livewire\Component;
use App\Rules\PhoneNumber;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Teacher extends Component
{
    use LivewireAlert;
    public string $name;
    public string $subject;
    public string $nuptk;
    public string $dateOfBirth;
    public string $placeOfBirth;
    public string $address;
    public string $phoneNumber;
    public string $gender;
    public int $maxNuptk = 8;

    public array $genders;
    public bool $isLoading = false;

    public function mount()
    {
        $this->genders = collect(Genders::cases())
            ->map(fn($gender) => ['value' => $gender->name, 'label' => $gender->value])
            ->toArray();

        $user = auth()->user()->teacher;
        $this->name = $user->name;
        $this->subject = $user->subject;
        $this->nuptk = $user->nuptk;
        $this->dateOfBirth = $user->date_of_birth->format('Y-m-d');
        $this->placeOfBirth = $user->place_of_birth;
        $this->address = $user->address;
        $this->phoneNumber = $user->phone_number;
        $this->gender = $user->gender;
    }

    public function render()
    {
        return view('pages.dashboard.account.teacher');
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:60',
            'nuptk' => 'required|string|digits:' . $this->maxNuptk . '|unique:teachers,nuptk,' . auth()->user()->teacher->id . '|unique:teacher_requests,nuptk',
            'address' => 'required|string|max:255',
            'placeOfBirth' => 'required|string|max:40',
            'dateOfBirth' => 'required|date|beforeOrEqual:' . \Carbon\Carbon::now()->addYears(-5)->format('Y-m-d'),
            'gender' => [
                'required',
                Rule::in(Genders::names())
            ],
            'phoneNumber' => ['required', new PhoneNumber],
            'subject' => 'required|string|max:60',
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
        ];
    }

    public function submit()
    {
        $this->validate();
        $this->isLoading = true;
        try {
            auth()->user()->teacher->update([
                'nuptk' => $this->nuptk,
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
