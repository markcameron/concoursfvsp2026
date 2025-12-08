<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\SponsorLevel;
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
            ?->firstWhere('type', 'program')
            ;

        $sponsorLevels = SponsorLevel::orderBy('price', 'asc')->get();

        return view('welcome')
            ->with('programBlock', $programBlock)
            ->with('sponsorLevels', $sponsorLevels);
    }
}
