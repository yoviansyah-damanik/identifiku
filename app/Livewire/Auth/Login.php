<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Jenssegers\Agent\Agent;
use App\Models\StudentRequest;
use App\Models\TeacherRequest;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;

#[Layout('layouts.auth')]
class Login extends Component
{
    use LivewireAlert;

    public bool $isLoading = false;
    public string $username;
    public string $password;
    public bool $rememberMe = false;

    public function render()
    {
        return view('pages.auth.login')
            ->title(__('Login'));
    }

    public function rules()
    {
        return [
            'username' => 'required|string',
            'password' => 'required|string',
            'rememberMe' => 'nullable',
        ];
    }

    public function submit()
    {
        $this->validate();
        try {
            $this->isLoading = true;

            $username = $this->username;
            $password = $this->password;

            $studentRegistration = StudentRequest::where('username', $username)->first();
            $teacherRegistration = TeacherRequest::where('username', $username)->first();

            if ($studentRegistration || $teacherRegistration) {
                $this->alert('warning', __('Your account is currently under review. Please contact the School Administrator.'));
                $this->isLoading = false;
                return;
            }

            $user = User::whereUsername($username)
                ->first();

            if ($user) {
                if (Hash::check($password, $user->password)) {
                    $agent = new Agent();

                    if ($agent->isRobot()) {
                        $this->alert('error', "Jangan ya dek yaaaaa.");
                        return;
                    }
                    $user->update(['last_login_at' => now()]);

                    Auth::login($user, $this->rememberMe === true);
                    return $this->redirectIntended(route('home'), false);
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
