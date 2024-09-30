<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LoginModal extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $modalTitle = null,
        public ?string $backdropClass = null,
        public ?string $modalClass = null,
        public ?string $name = null,
        public string $size = 'md',
    ) {
        $this->backdropClass = join(' ', [
            'fixed inset-0 z-[999] flex justify-center items-center'
        ]);
        $this->modalClass = join(' ', [
            'relative bg-white min-h-80 w-full rounded-xl m-5 sm:m-9 shadow-md overflow-hidden w-full max-w-4xl',
        ]);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.login-modal');
    }
}
