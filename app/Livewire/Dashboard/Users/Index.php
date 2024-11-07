<?php

namespace App\Livewire\Dashboard\Users;

use Livewire\Component;
use Livewire\WithPagination;
use App\Helpers\GeneralHelper;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Spatie\Permission\Models\Role;

#[Layout('layouts.dashboard')]
class Index extends Component
{
    use WithPagination;
    protected $listeners = ['refreshUsers' => '$refresh', 'refreshUserActivation' => '$refresh', 'setSearch', 'setViewActive'];
    public int $perPage;

    #[Url]
    public string $search = '';

    public array $roles, $activationTypes, $perPageList;
    public string $role = 'all', $activationType;

    public function mount()
    {
        $this->perPageList = GeneralHelper::getPerPageList();
        $this->perPage = $this->perPageList[0];

        $roles = Role::get()
            ->map(fn($role) => [
                'title' => __($role->name),
                'value' => $role->name,
            ])
            ->toArray();

        $this->roles = [['value' => 'all', 'title' => __('All')], ...$roles];

        $this->activationTypes = [
            [
                'title' => __('All'),
                'value' => 'all'
            ],
            [
                'title' => __('Active'),
                'value' => 0
            ],
            [
                'title' => __('Suspended'),
                'value' => 1
            ],
        ];
        $this->activationType = $this->activationTypes[0]['value'];
    }

    public function render()
    {
        $users = User::with('roles', 'hasRelation', 'school', 'teacher', 'student', 'administrator')
            ->when($this->activationType != 'all' && collect($this->activationTypes)->some(fn($activationType) => $activationType['value'] == $this->activationType), fn($q) => $q->where('is_suspended', $this->activationType))
            ->when($this->role != 'all' && collect($this->roles)->some(fn($role) => $role['value'] == $this->role), fn($q) => $q->role($this->role))
            ->whereAny(['id', 'username', 'email'], 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate($this->perPage);
        // dd($users);
        return view('pages.dashboard.users.index', compact('users'))
            ->title(__('Users'));
    }
}
