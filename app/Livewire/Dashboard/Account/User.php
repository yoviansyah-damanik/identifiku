<?php

namespace App\Livewire\Dashboard\Account;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class User extends Component
{
    use LivewireAlert;
    public string $username;
    public string $email;
    public string $password;

    public bool $isLoading = false;

    public function mount()
    {
        $userData = Auth::user();
        $this->username = $userData->username;
        $this->email = $userData->email;
    }

    public function render()
    {
        return view('pages.dashboard.account.user');
    }

    public function rules()
    {
        return [
            'email' => 'required|email:dns|unique:users,email,' . auth()->user()->id . '|unique:teacher_requests,email,' . auth()->user()->id . '|unique:student_requests,email,' . auth()->user()->id . '',
            'username' => 'required|min:8|max:32|alpha_dash|string|unique:users,username,' . auth()->user()->id . '|unique:teacher_requests,username,' . auth()->user()->id . '|unique:student_requests,username,' . auth()->user()->id . '',
        ];
    }

    public function validationAttributes()
    {
        return [
            'username' => __('Username'),
            'email' => __('Email'),
        ];
    }

    public function submit()
    {
        $this->validate();
        $this->isLoading = true;
        try {
            auth()->user()->update([
                'username' => $this->username,
                'email' => $this->email,
            ]);
            $this->isLoading = false;
            $this->alert('success', __(':attribute updated successfully.', ['attribute' => __('User Data')]));
        } catch (\Exception $e) {
            $this->isLoading = false;
            $this->alert('warning', $e->getMessage());
        } catch (\Throwable $e) {
            $this->isLoading = false;
            $this->alert('warning', $e->getMessage());
        }
    }
}
