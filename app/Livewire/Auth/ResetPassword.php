<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\Rules\Password as PasswordRule;

class ResetPassword extends Component
{
    public bool $isLoading = false;
    public string $token;
    public string $password;
    public string $password_confirmation;
    public string $email;

    public function mount(string $token)
    {
        $isExist = DB::tables('password_reset_tokens')
            ->where('token', $token)
            ->first();

        if (!$isExist) {
            $this->redirectRoute('dashboard');
        }

        $this->token = $token;
    }

    public function render()
    {
        return view('pages.auth.reset-password');
    }

    public function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' =>   [
                'required',
                'string',
                PasswordRule::min(8)->letters()->numbers()
            ],
            'password_confirmation' => 'required|same:password'
        ];
    }

    public function submit()
    {
        try {
            $status = Password::reset(
                $this->only('email', 'password', 'password_confirmation', 'token'),
                function (User $user, string $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));

                    $user->save();

                    event(new PasswordReset($user));
                }
            );

            if ($status === Password::PASSWORD_RESET) {
            }
        } catch (\Exception $e) {
            $this->isLoading = false;
            $this->alert('warning', $e->getMessage());
        } catch (\Throwable $e) {
            $this->isLoading = false;
            $this->alert('warning', $e->getMessage());
        }
    }
}
