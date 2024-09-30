<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public array $menu_group;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->menu_group = [
            [
                [
                    'title' => __('Home'),
                    'icon' => 'i-ph-fire',
                    'to' => route('dashboard'),
                    'isActive' => request()->routeIs('dashboard')
                ]
            ],
            [
                [
                    'title' => __('Assessment'),
                    'icon' => 'i-ph-fire',
                    'to' => route('dashboard.assessment'),
                    'isActive' => request()->routeIs('dashboard.assessment')
                ],
                [
                    'title' => __('Assessment History'),
                    'icon' => 'i-ph-fire',
                    'to' => route('dashboard.assessment-history'),
                    'isActive' => request()->routeIs('dashboard.assessment-history')
                ]
            ],
            [
                [
                    'title' => __('School'),
                    'icon' => 'i-ph-fire',
                    'to' => route('dashboard.school'),
                    'isActive' => request()->routeIs('dashboard.school')
                ],
                [
                    'title' => __('Student'),
                    'icon' => 'i-ph-fire',
                    'to' => route('dashboard.student'),
                    'isActive' => request()->routeIs('dashboard.student')
                ],
            ],
            [
                [
                    'title' => __('School Request'),
                    'icon' => 'i-ph-fire',
                    'to' => route('dashboard.school-request'),
                    'isActive' => request()->routeIs('dashboard.school-request')
                ],
                [
                    'title' => __('Student Request'),
                    'icon' => 'i-ph-fire',
                    'to' => route('dashboard.student-request'),
                    'isActive' => request()->routeIs('dashboard.student-request')
                ],
            ],
            [
                [
                    'title' => __('Education Level'),
                    'icon' => 'i-ph-fire',
                    'to' => route('dashboard.education-level'),
                    'isActive' => request()->routeIs('dashboard.education-level')
                ],
                [
                    'title' => __('Grade Level'),
                    'icon' => 'i-ph-fire',
                    'to' => route('dashboard.grade-level'),
                    'isActive' => request()->routeIs('dashboard.grade-level')
                ],
                [
                    'title' => __('School Status'),
                    'icon' => 'i-ph-fire',
                    'to' => route('dashboard.school-status'),
                    'isActive' => request()->routeIs('dashboard.school-status')
                ]
            ],
            [
                [
                    'title' => __('Quiz'),
                    'icon' => 'i-ph-fire',
                    'to' => route('dashboard.quiz'),
                    'isActive' => request()->routeIs('dashboard.quiz')
                ],
                [
                    'title' => __('Quiz Category'),
                    'icon' => 'i-ph-fire',
                    'to' => route('dashboard.quiz-category'),
                    'isActive' => request()->routeIs('dashboard.quiz-category')
                ],
                [
                    'title' => __('Quiz Phase'),
                    'icon' => 'i-ph-fire',
                    'to' => route('dashboard.quiz-phase'),
                    'isActive' => request()->routeIs('dashboard.quiz-phase')
                ],
            ],
            // [
            //     [
            //         'title' => __('Question'),
            //         'icon' => 'i-ph-fire',
            //         'to' => route('dashboard.question'),
            //         'isActive' => request()->routeIs('dashboard.question')
            //     ],
            //     [
            //         'title' => __('Question Group'),
            //         'icon' => 'i-ph-fire',
            //         'to' => route('dashboard.question-group'),
            //         'isActive' => request()->routeIs('dashboard.question-group')
            //     ],
            //     [
            //         'title' => __('Question Type'),
            //         'icon' => 'i-ph-fire',
            //         'to' => route('dashboard.question-type'),
            //         'isActive' => request()->routeIs('dashboard.question-type')
            //     ],
            // ],
            [
                [
                    'title' => __('Region'),
                    'icon' => 'i-ph-users',
                    'to' => route('dashboard.region'),
                    'isActive' => request()->routeIs('dashboard.region')
                ],
                [
                    'title' => __('Users'),
                    'icon' => 'i-ph-users',
                    'to' => route('dashboard.users'),
                    'isActive' => request()->routeIs('dashboard.users')
                ],
                [
                    'title' => __('Account Settings'),
                    'icon' => 'i-ph-user',
                    'to' => route('dashboard.account'),
                    'isActive' => request()->routeIs('dashboard.account')
                ],
            ]
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.sidebar');
    }
}
