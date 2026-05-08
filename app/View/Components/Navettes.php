<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navettes extends Component
{
    public function __construct(
        public bool $withTitle = false,
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('components.navettes');
    }
}
