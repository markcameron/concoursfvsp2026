<?php

namespace App\View\Components;

use App\Enums\SponsorType;
use App\Models\Sponsor;
use App\Models\Variable;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Marquee extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct() {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $sponsors = Sponsor::where('type', SponsorType::PARRAINAGE)
            ->where('active', true)
            ->orderBy('sort', 'asc')
            ->get();

        $showMarqueeHomepage = Variable::where('key', 'sponsor_marquee_home')->first()?->value;

        return view('components.marquee')
            ->with('sponsors', $sponsors)
            ->with('showMarqueeHomepage', $showMarqueeHomepage);
    }
}
