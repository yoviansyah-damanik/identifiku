<?php

namespace App\View\Components\Main;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Vite;

class Team extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $teams = [
            [
                'name' => 'M. Noor Hasan Siregar, S.T, M.Kom',
                'avatar' => Vite::image('silhouette-man.png'),
                'ig' => 'noor_srg',
                'as' => 'Leader'
            ],
            [
                'name' => 'Yulia Rizki Rahmadani, M.Pd',
                'avatar' => Vite::image('silhouette-women.png'),
                'ig' => 'yulia_damanik',
                'as' => 'Secretary'
            ],
            [
                'name' => 'Yusra Fadillah, S.Kom, M.Kom',
                'avatar' => Vite::image('silhouette-man.png'),
                'ig' => 'yusra_fadillah',
                'as' => 'Analyst'
            ],
            [
                'name' => 'Yoviansyah Rizki Pratama, S.Kom',
                'avatar' => Vite::image('silhouette-man.png'),
                'ig' => 'yoviansyah_damanik',
                'as' => 'Developer'
            ],
        ];

        return view('components.main.team', compact('teams'));
    }
}
