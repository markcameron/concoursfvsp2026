<?php

namespace App\Http\Controllers;

use App\Models\Page;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class PageController extends Controller
{
    public function committee()
    {
        $page = Page::where('machine_name', 'committee')->first();

        return view('pages.committee')
            ->with('page', $page)
            ->with('seoData', new SEOData(title: $page?->title));
    }

    public function volunteers()
    {
        $page = Page::where('machine_name', 'volunteers')->first();

        return view('pages.basic')
            ->with('page', $page)
            ->with('seoData', new SEOData(title: $page?->title));
    }

    public function station()
    {
        return view('pages.station');
    }

    public function donations()
    {
        $page = Page::where('machine_name', 'donations')->first();

        return view('pages.basic')
            ->with('page', $page)
            ->with('seoData', new SEOData(title: $page?->title));
    }

    public function livret()
    {
        $page = Page::where('machine_name', 'livret')->first();

        return view('pages.livret')
            ->with('page', $page)
            ->with('seoData', new SEOData(title: $page?->title));
    }

    public function programme()
    {
        $page = Page::where('machine_name', 'program')->first();

        return view('pages.programme')
            ->with('page', $page)
            ->with('seoData', new SEOData(title: $page?->title));
    }

    public function map()
    {
        $page = Page::where('machine_name', 'map')->first();

        return view('pages.map')
            ->with('page', $page)
            ->with('seoData', new SEOData(title: $page?->title));
    }

    public function procession()
    {
        $page = Page::where('machine_name', 'procession')->first();

        return view('pages.procession')
            ->with('page', $page)
            ->with('seoData', new SEOData(title: $page?->title));
    }
}
