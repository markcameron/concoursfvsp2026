<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\SponsorLevel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Mail\ContactFormSubmission;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactFormRequest;

class SponsorController extends Controller
{
    public function index()
    {
        $sponsorLevels = SponsorLevel::orderBy('price', 'asc')->get();

        return view('sponsoring')
            ->with('sponsorLevels', $sponsorLevels);
    }

    // public function store(ContactFormRequest $request)
    // {
    //     $contact = Contact::create($request->safe()->except('cf-turnstile-response'));

    //     Mail::to(explode(',', config('site.contact_emails')))->send(new ContactFormSubmission($contact));

    //     return redirect()->back()->with('success', 'Votre message a été envoyé avec succès !');
    // }
}
