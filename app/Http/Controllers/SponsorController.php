<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Enums\ContactType;
use App\Models\SponsorInfo;
use App\Models\SponsorLevel;
use App\Mail\SponsorFormReply;
use App\Mail\SponsorFormSubmission;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\SponsorFormRequest;

class SponsorController extends Controller
{
    public function index()
    {
        $sponsorLevels = SponsorLevel::orderBy('price', 'asc')->get();

        return view('sponsoring')
            ->with('sponsorLevels', $sponsorLevels);
    }

    public function info()
    {
        $sponsorInfo = SponsorInfo::first();

        return view('sponsoring_info')
            ->with('sponsorInfo', $sponsorInfo);
    }

    public function form()
    {
        return view('sponsoring_form');
    }

    public function store(SponsorFormRequest $request)
    {
        $contact = Contact::create(collect(['type' => ContactType::SPONSORING])->merge($request->safe()->except('cf-turnstile-response'))->toArray());

        Mail::to(explode(',', config('site.sponsor_emails')))->send(new SponsorFormSubmission($contact));

        Mail::to($contact->email)->send(new SponsorFormReply($contact));

        return redirect()->back()->with('success', 'Votre message a été envoyé avec succès !');
    }
}
