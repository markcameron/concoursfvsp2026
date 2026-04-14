<?php

namespace App\Http\Controllers;

use App\Enums\SponsorType;
use App\Models\Sponsor;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class SponsorListController extends Controller
{
    public function index()
    {
        $sponsorsByLevel = Sponsor::where('type', SponsorType::PARRAINAGE)
            ->orderBy('sort', 'asc')
            ->get()
            ->groupBy('sponsor_level_id');

        return view('sponsor_list')
            ->with('sponsorsByLevel', $sponsorsByLevel)
            ->with('seoData', new SEOData(
                title: 'Nos partenaires',
                description: 'Découvrez les sponsors et partenaires qui soutiennent le Concours FVSP 2026 à Coppet.',
            ));
    }
}
