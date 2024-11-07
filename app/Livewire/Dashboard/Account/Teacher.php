<?php

namespace App\Livewire\Dashboard\Account;

use App\Enums\Genders;
use Livewire\Component;
use App\Rules\PhoneNumber;
use Illuminate\Validation\Rule;

class Teacher extends Component
{
    public function render()
    {
        return view('pages.dashboard.account.teacher');
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:60',
            'nuptk' => 'required|string|digits:' . $this->maxNisn . '|unique:teachers,nuptk|unique:teacher_requests,nuptk',
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
            'username' => __('Username'),
            'email' => __('Email'),
            'password' => __('Password'),
            'rePassword' => __('Re-Password'),
        ];
    }
}
