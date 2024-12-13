<?php

namespace App\Livewire\Dashboard\Home\Additional;

use App\Models\Assessment;
use Livewire\Component;

class LastAssessment extends Component
{
    public function render()
    {
        $assessment = Assessment::where('student_id', auth()->user()->student->id)
            ->with([
                'quiz',
                'result',
                'result.details',
            ])
            ->done()
            ->latest()
            ->first();

        return view('pages.dashboard.home.additional.last-assessment', compact('assessment'));
    }
}
