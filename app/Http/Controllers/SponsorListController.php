<?php

namespace App\Http\Controllers;

use App\Enums\SponsorType;
use App\Models\Sponsor;

class SponsorListController extends Controller
{
    public function index()
    {
        $sponsorsByLevel = Sponsor::where('type', SponsorType::PARRAINAGE)
            ->orderBy('sort', 'asc')
            ->get()
            ->groupBy('sponsor_level_id');

        return view('sponsor_list')
            ->with('sponsorsByLevel', $sponsorsByLevel);
    }
}
