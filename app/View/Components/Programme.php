<?php

namespace App\View\Components;

use App\Models\Page;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Programme extends Component
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
        $programBlock = collect(Page::where('machine_name', 'program')
            ->first()
            ?->content)
            ?->firstWhere('type', 'program');

        return view('components.programme', [
            'programBlock' => $programBlock,
            'showBlock' => boolval($programBlock),
        ]);
    }
}
