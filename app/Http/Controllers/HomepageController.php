<?php

namespace App\Http\Controllers;

use App\Enums\SponsorType;
use App\Models\Page;
use App\Models\Sponsor;
use App\Models\SponsorLevel;
use App\Models\Variable;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $programBlock = collect(Page::where('machine_name', 'program')
            ->first()
            ?->content)
            ?->firstWhere('type', 'program');

        $sponsorLevels = SponsorLevel::orderBy('price', 'asc')->get();

        $showSponsorListHomepage = Variable::where('key', 'sponsor_list_home')->first()?->value;

        $sponsors = Sponsor::where('type', SponsorType::PARRAINAGE->value)
            ->orderBy('sort', 'asc')
            ->get();

        return view('welcome')
            ->with('programBlock', $programBlock)
            ->with('sponsorLevels', $sponsorLevels)
            ->with('showSponsorListHomepage', $showSponsorListHomepage)
            ->with('sponsors', $sponsors);
    }
}
