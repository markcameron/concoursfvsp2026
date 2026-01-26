<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Contact;
use App\Enums\ContactType;
use App\Models\SponsorInfo;
use App\Models\SponsorLevel;
use App\Mail\SponsorFormReply;
use App\Mail\SponsorFormSubmission;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\SponsorFormRequest;

class PageController extends Controller
{
    public function committee()
    {
        $page = Page::where('machine_name', 'committee')->first();

        return view('pages.committee')
            ->with('page', $page);
    }

    public function volunteers()
    {
        $page = Page::where('machine_name', 'volunteers')->first();

        return view('pages.basic')
            ->with('page', $page);
    }

    public function station()
    {
        return view('pages.station');
    }

    public function donations()
    {
        $page = Page::where('machine_name', 'donations')->first();

        return view('pages.basic')
            ->with('page', $page);
    }
}
