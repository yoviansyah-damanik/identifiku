<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Password;
use Jantinnerezo\LivewireAlert\LivewireAlert;

#[Layout('layouts.auth')]
class ForgotPassword extends Component
{
    use LivewireAlert;

    public bool $isLoading = false;
    public string $username;
    public string $email;

    public function render()
    {
        return view('pages.auth.forgot-password')
            ->title(__('Forgot Password'));
    }

    public function rules()
    {
        return ['email' => 'required|email'];
    }

    public function submit()
    {
        $this->validate();
        try {
            $this->isLoading = true;

            $user = User::whereEmail($this->email)
                ->first();

            if ($user) {
                $status = Password::sendResetLink(
                    $this->email
                );

                if ($status === Password::RESET_LINK_SENT) {
                    $this->alert('success', __('Confirmation of your forgotten password request has been sent to your email.'));
                    return;
                }
            }

            $this->isLoading = false;
            $this->alert('warning', __('The credentials you entered were not found.'));
        } catch (\Exception $e) {
            $this->isLoading = false;
            $this->alert('warning', $e->getMessage());
        } catch (\Throwable $e) {
            $this->isLoading = false;
            $this->alert('warning', $e->getMessage());
        }
    }
}
