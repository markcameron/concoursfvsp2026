<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Mail\ContactFormSubmission;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(ContactFormRequest $request)
    {
        $contact = Contact::create($request->safe()->except('cf-turnstile-response'));

        Mail::to(explode(',', config('site.contact_emails')))->send(new ContactFormSubmission($contact));

        return redirect()->back()->with('success', 'Votre message a été envoyé avec succès !');
    }
}
