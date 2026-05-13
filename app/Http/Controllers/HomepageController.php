<?php

namespace App\Http\Controllers;

use App\Enums\SponsorType;
use App\Models\PressItem;
use App\Models\Sponsor;
use App\Models\SponsorLevel;
use App\Models\Variable;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $sponsorLevels = SponsorLevel::orderBy('price', 'asc')->get();

        $showSponsorListHomepage = Variable::where('key', 'sponsor_list_home')->first()?->value;

        $sponsors = Sponsor::where('type', SponsorType::PARRAINAGE->value)
            ->orderBy('sort', 'asc')
            ->get();

        $hideCountdown = Carbon::now('Europe/Zurich')
            ->isAfter(Carbon::parse('2026-05-09 07:30:00', 'Europe/Zurich'));

        $pressItems = PressItem::where('active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('welcome')
            ->with('sponsorLevels', $sponsorLevels)
            ->with('showSponsorListHomepage', $showSponsorListHomepage)
            ->with('sponsors', $sponsors)
            ->with('hideCountdown', $hideCountdown)
            ->with('pressItems', $pressItems);
    }
}
