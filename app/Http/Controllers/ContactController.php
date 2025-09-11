<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Mail\ContactFormSubmission;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'nullable|string|max:20',
            'message' => 'required|string',
        ]);

        $contact = Contact::create($validated);

        Mail::to([
            'webmaster@sdis-ts.ch',
        ])->send(new ContactFormSubmission($contact));

        return redirect()->back()->with('success', 'Votre message a été envoyé avec succès !');
    }
}
