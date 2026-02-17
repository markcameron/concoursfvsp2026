<?php

namespace App\Http\Controllers;

use App\Enums\ContactType;
use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactFormSubmission;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(ContactFormRequest $request)
    {
        $contact = Contact::create(array_merge(
            $request->safe()->except('cf-turnstile-response'),
            ['type' => ContactType::CONTACT->value]
        ));

        Mail::to(explode(',', config('site.contact_emails')))->send(new ContactFormSubmission($contact));

        return redirect()->back()->with('success', 'Votre message a été envoyé avec succès !');
    }
}
