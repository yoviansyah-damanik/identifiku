<?php

namespace App\Livewire\Dashboard\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class UserActivation extends Component
{
    use LivewireAlert;
    protected $listeners = ['setUserActivation', 'clearModal'];

    public ?User $user = null;
    public bool $isLoading = true;
    public array $activationTypes;
    public string $activationType;

    public function mount()
    {
        $this->activationTypes = [
            [
                'label' => 'active',
                'code' => 0
            ],
            [
                'label' => 'suspend',
                'code' => 1
            ],
        ];
    }

    public function render()
    {
        return view('pages.dashboard.users.user-activation');
    }

    public function rules()
    {
        return [
            'activationType' => [
                'required',
                Rule::in(collect($this->activationTypes)->pluck('code')->toArray())
            ]
        ];
    }

    public function validationAttributes()
    {
        return [
            'activationType' => __('Activation Type'),
        ];
    }

    public function setUserActivation(User $user)
    {
        $this->clearModal();
        $this->user = $user;
        $this->activationType = $user->is_suspended;
        $this->isLoading = false;

        if ($user->roleName == 'Superadmin') {
            $this->clearModal();
            $this->dispatch('toggle-user-activation-modal');
            $this->alert('warning', __('Accounts of this type cannot be updated.'));
        }
    }

    public function clearModal()
    {
        $this->reset('activationType', 'user');
        $this->isLoading = true;
    }

    public function save()
    {
        $this->isLoading = true;
        $this->validate();
        try {
            $this->user->update(['is_suspended' => $this->activationType]);

            $this->isLoading = false;
            $this->dispatch('refreshUserActivation');
            $this->dispatch('toggle-user-activation-modal');
            $this->alert('success', __('Successfully'), ['text' => __(':attribute updated successfully.', ['attribute' => __('User')])]);
        } catch (\Exception $e) {
            $this->alert('error', __('Something went wrong'), ['text' => $e->getMessage()]);
            $this->isLoading = false;
        } catch (\Throwable $e) {
            $this->alert('error', __('Something went wrong'), ['text' => $e->getMessage()]);
            $this->isLoading = false;
        }
    }
}
