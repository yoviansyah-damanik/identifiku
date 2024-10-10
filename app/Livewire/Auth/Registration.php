<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Vite;

#[Layout('layouts.auth')]
class Registration extends Component
{
    public array $registeredAsList;

    public function mount()
    {
        $this->registeredAsList = [
            [
                'value' => 'student',
                'title' => __('Student'),
                'url' => route('registration.student'),
                'image' => Vite::image('default-avatar.jpg')
            ],
            [
                'value' => 'teacher',
                'title' => __('Teacher'),
                'url' => route('registration.teacher'),
                'image' => Vite::image('default-avatar.jpg')
            ],
            [
                'value' => 'school',
                'title' => __('School'),
                'url' => route('registration.school'),
                'image' => Vite::image('default-school.webp')
            ]
        ];
    }

    public function render()
    {
        return view('pages.auth.registration')
            ->title(__('Registration'));
    }
}
