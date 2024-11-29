<?php

namespace App\Livewire\Dashboard\Account;

use Livewire\Component;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Isolate;

#[Isolate]
class Password extends Component
{
    use LivewireAlert;
    public string $currentPassword;
    public string $password;
    public string $rePassword;
    public bool $isLoading = false;

    public function render()
    {
        return view('pages.dashboard.account.password');
    }

    public function rules()
    {
        return [
            'currentPassword' => 'required|string|current_password',
            'password' =>   [
                'required',
                'string',
                PasswordRule::min(8)->letters()->numbers()->symbols()
            ],
            'rePassword' => 'required|same:password'
        ];
    }

    public function validationAttributes()
    {
        return [
            'currentPassword' => __('Current Password'),
            'password' => __('New Password'),
            'rePassword' => __('Re-Password'),
        ];
    }

    public function submit()
    {
        $this->validate();
        $this->isLoading = true;
        try {
            auth()->user()->update([
                'password' => bcrypt($this->password)
            ]);

            $this->isLoading = false;
            $this->alert('success', __(':attribute updated successfully.', ['attribute' => __('Password')]));
        } catch (\Exception $e) {
            $this->isLoading = false;
            $this->alert('warning', $e->getMessage());
        } catch (\Throwable $e) {
            $this->isLoading = false;
            $this->alert('warning', $e->getMessage());
        }
    }
}
