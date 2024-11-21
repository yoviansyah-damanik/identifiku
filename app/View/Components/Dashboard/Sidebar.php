<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Sidebar extends Component
{
    public array $menu_group;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->menu_group = $this->filterByPermission($this->setMenuGroup());
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.sidebar');
    }

    private function setMenuGroup()
    {
        return [
            [
                'title' => __('Assessment'),
                'items' => [
                    [
                        'title' => __('Assessment'),
                        'icon' => 'i-fluent-emoji-flat-bookmark-tabs',
                        'to' => route('dashboard.assessment'),
                        'isActive' => request()->routeIs('dashboard.assessment'),
                        'permission' => 'assessment'
                    ],
                    [
                        'title' => __('Assessment History'),
                        'icon' => 'i-fluent-emoji-flat-bookmark-tabs',
                        'to' => route('dashboard.assessment-history'),
                        'isActive' => request()->routeIs('dashboard.assessment-history'),
                        'permission' => 'assessment history'
                    ],
                    [
                        'title' => __('Student Assessments'),
                        'icon' => 'i-fluent-emoji-flat-bookmark-tabs',
                        'to' => route('dashboard.assessment-students'),
                        'isActive' => request()->routeIs('dashboard.assessment-students'),
                        'permission' => 'assessment students'
                    ],
                ]
            ],
            [
                'title' => __('Class'),
                'items' => [
                    [
                        'title' => __('All Classes'),
                        'icon' => 'i-fluent-emoji-flat-door',
                        'to' => route('dashboard.class'),
                        'isActive' => request()->routeIs('dashboard.class*') && !request()->routeIs('dashboard.class.request'),
                        'permission' => 'class'
                    ],
                    [
                        'title' => __('Class Request'),
                        'icon' => 'i-fluent-emoji-flat-man-student',
                        'to' => route('dashboard.class.request'),
                        'isActive' => request()->routeIs('dashboard.class.request'),
                        'permission' => 'class request'
                    ],
                    [
                        'title' => __('My Class'),
                        'icon' => 'i-fluent-emoji-flat-door',
                        'to' => route('dashboard.student-class'),
                        'isActive' => request()->routeIs('dashboard.student-class*') && !request()->routeIs('dashboard.student-class.available'),
                        'permission' => 'class student'
                    ],
                    [
                        'title' => __('Available Classes'),
                        'icon' => 'i-fluent-emoji-flat-door',
                        'to' => route('dashboard.student-class.available'),
                        'isActive' => request()->routeIs('dashboard.student-class.available'),
                        'permission' => 'class available'
                    ],
                ]
            ],
            [
                'title' => __('Master'),
                'items' => [
                    [
                        'title' => __('School'),
                        'icon' => 'i-fluent-emoji-flat-school',
                        'to' => route('dashboard.school'),
                        'isActive' => request()->routeIs('dashboard.school'),
                        'permission' => 'school'
                    ],
                    [
                        'title' => __('Student'),
                        'icon' => 'i-fluent-emoji-flat-man-student',
                        'to' => route('dashboard.student'),
                        'isActive' => request()->routeIs('dashboard.student'),
                        'permission' => 'student'
                    ],
                    [
                        'title' => __('Teacher'),
                        'icon' => 'i-fluent-emoji-flat-man-teacher',
                        'to' => route('dashboard.teacher'),
                        'isActive' => request()->routeIs('dashboard.teacher'),
                        'permission' => 'teacher'
                    ],
                    [
                        'title' => __('Education Level'),
                        'icon' => 'i-fluent-emoji-flat-level-slider',
                        'to' => route('dashboard.education-level'),
                        'isActive' => request()->routeIs('dashboard.education-level'),
                        'permission' => 'educationLevel'
                    ],
                    [
                        'title' => __('Grade Level'),
                        'icon' => 'i-fluent-emoji-flat-level-slider',
                        'to' => route('dashboard.grade-level'),
                        'isActive' => request()->routeIs('dashboard.grade-level'),
                        'permission' => 'gradeLevel'
                    ],
                    [
                        'title' => __('School Status'),
                        'icon' => 'i-fluent-emoji-flat-level-slider',
                        'to' => route('dashboard.school-status'),
                        'isActive' => request()->routeIs('dashboard.school-status'),
                        'permission' => 'schoolStatus'
                    ]
                ]
            ],
            [
                'title' => __('Request'),
                'items' => [
                    [
                        'title' => __('School Request'),
                        'icon' => 'i-fluent-emoji-flat-school',
                        'to' => route('dashboard.school-request'),
                        'isActive' => request()->routeIs('dashboard.school-request'),
                        'permission' => 'school request'
                    ],
                    [
                        'title' => __('Student Request'),
                        'icon' => 'i-fluent-emoji-flat-man-student',
                        'to' => route('dashboard.student-request'),
                        'isActive' => request()->routeIs('dashboard.student-request'),
                        'permission' => 'student request'
                    ],
                    [
                        'title' => __('Teacher Request'),
                        'icon' => 'i-fluent-emoji-flat-man-teacher',
                        'to' => route('dashboard.teacher-request'),
                        'isActive' => request()->routeIs('dashboard.teacher-request'),
                        'permission' => 'teacher request'
                    ],
                ]
            ],
            [
                'title' => __('Quiz'),
                'items' => [
                    [
                        'title' => __('Available Quiz'),
                        'icon' => 'i-fluent-emoji-flat-abacus',
                        'to' => route('dashboard.quiz.available'),
                        'isActive' => request()->routeIs('dashboard.quiz.available') || request()->routeIs('dashboard.quiz.show') || request()->routeIs('dashboard.quiz.preview'),
                        'permission' => 'quiz available'
                    ],
                    [
                        'title' => __('Quiz'),
                        'icon' => 'i-fluent-emoji-flat-abacus',
                        'to' => route('dashboard.quiz'),
                        'isActive' => request()->routeIs('dashboard.quiz.*') && !request()->routeIs('dashboard.quiz.available'),
                        'permission' => 'quiz'
                    ],
                    [
                        'title' => __('Quiz Category'),
                        'icon' => 'i-fluent-emoji-flat-card-file-box',
                        'to' => route('dashboard.quiz-category'),
                        'isActive' => request()->routeIs('dashboard.quiz-category'),
                        'permission' => 'quiz category'
                    ],
                    [
                        'title' => __('Quiz Phase'),
                        'icon' => 'i-fluent-emoji-flat-card-file-box',
                        'to' => route('dashboard.quiz-phase'),
                        'isActive' => request()->routeIs('dashboard.quiz-phase'),
                        'permission' => 'quiz phase'
                    ],
                ]
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
                'title' => __('Configuration'),
                'items' => [
                    [
                        'title' => __('Region'),
                        'icon' => 'i-fluent-emoji-flat-world-map',
                        'to' => route('dashboard.region'),
                        'isActive' => request()->routeIs('dashboard.region'),
                        'permission' => 'region'
                    ],
                    [
                        'title' => __('Users'),
                        'icon' => 'i-fluent-emoji-flat-busts-in-silhouette',
                        'to' => route('dashboard.users'),
                        'isActive' => request()->routeIs('dashboard.users'),
                        'permission' => 'users'
                    ],
                    [
                        'title' => __('Account Settings'),
                        'icon' => 'i-fluent-emoji-flat-identification-card',
                        'to' => route('dashboard.account'),
                        'isActive' => request()->routeIs('dashboard.account'),
                        'permission' => 'account'
                    ],
                    [
                        'title' => __('General'),
                        'icon' => 'i-fluent-emoji-flat-control-knobs',
                        'to' => route('dashboard.general'),
                        'isActive' => request()->routeIs('dashboard.general'),
                        'permission' => 'general'
                    ],
                ]
            ]
        ];
    }

    private function filterByPermission($menus)
    {
        return collect($menus)
            ->map(function ($q) {
                return [
                    ...collect($q)->except('items')->toArray(),
                    'items' => collect($q['items'])
                        ->filter(fn($r) => in_array($r['permission'], auth()->user()->getAllPermissions()->pluck('name')->toArray()))
                ];
            })
            ->filter(fn($q) => count($q['items']) > 0)
            ->toArray();
    }
}
