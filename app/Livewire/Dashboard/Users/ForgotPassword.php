<?php

namespace App\Livewire\Dashboard\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ForgotPassword extends Component
{
    use LivewireAlert;
    protected $listeners = ['setForgotPassword', 'clearModal'];

    public $user;
    public $result;
    public bool $isLoading = true;

    public function render()
    {
        return view('pages.dashboard.users.forgot-password');
    }

    public function setForgotPassword(User $user)
    {
        $this->isLoading = true;
        $this->user = $user;
        $this->isLoading = false;

        if ($user->role_name == 'Superadmin') {
            $this->clearModal();
            $this->dispatch('toggle-forgot-password-modal');
            $this->alert('warning', __('Accounts of this type cannot be updated.'));
        }
    }

    public function clearModal()
    {
        $this->reset();
        $this->isLoading = true;
    }

    public function submit()
    {
        $this->isLoading = true;
        try {
            $newPassword = Str::random(8);
            $this->user->update([
                'password' => bcrypt($newPassword)
            ]);

            $this->result = [
                'new_password' => $newPassword
            ];

            $this->alert('success', __('Successfully'), ['text' => __(':attribute updated successfully.', ['attribute' => __('Password')])]);
            $this->isLoading = false;
        } catch (\Exception $e) {
            $this->alert('error', __('Something went wrong'), ['text' => $e->getMessage()]);
            $this->isLoading = false;
        } catch (\Throwable $e) {
            $this->alert('error', __('Something went wrong'), ['text' => $e->getMessage()]);
            $this->isLoading = false;
        }
    }
}
