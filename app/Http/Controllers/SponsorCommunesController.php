<?php

namespace App\Http\Controllers;

use App\Enums\SponsorType;
use App\Models\Sponsor;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class SponsorCommunesController extends Controller
{
    public function index()
    {
        $sponsorsWithPhotos = Sponsor::where('type', SponsorType::COMMUNE)
            ->orderBy('sort', 'asc')
            ->get();

        $sponsorsWithoutPhotos = Sponsor::where('type', SponsorType::COMMUNE_NO_LOGO)
            ->orderBy('name', 'asc')
            ->get();

        return view('sponsor_communes')
            ->with('sponsorsWithPhotos', $sponsorsWithPhotos)
            ->with('sponsorsWithoutPhotos', $sponsorsWithoutPhotos)
            ->with('seoData', new SEOData(
                title: 'Les communes partenaires',
                description: 'Les communes de la région Terre-Sainte qui soutiennent le Concours FVSP 2026 à Coppet.',
            ));
    }
}
