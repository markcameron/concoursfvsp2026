<?php

namespace App\Http\Controllers;

use App\Enums\SponsorType;
use App\Models\Sponsor;

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
            ->with('sponsorsWithoutPhotos', $sponsorsWithoutPhotos);
    }
}
