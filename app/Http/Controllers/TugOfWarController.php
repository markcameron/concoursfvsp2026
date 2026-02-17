<?php

namespace App\Http\Controllers;

use App\Http\Requests\TugOfWarFormRequest;
use App\Mail\TugOfWarSubmission;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

class TugOfWarController extends Controller
{
    public function index()
    {
        return view('tug-of-war');
    }

    public function store(TugOfWarFormRequest $request)
    {
        $contact = Contact::create([
            'type' => 'tug-of-war',
            'company_name' => $request->safe()->only('company_name')['company_name'] ?? null,
            'name' => $request->safe()->only('name')['name'],
            'email' => $request->safe()->only('email')['email'],
        ]);

        Mail::to(explode(',', config('site.tug_of_war_emails')))->send(new TugOfWarSubmission($contact));

        return redirect()->back()->with('success', 'Votre inscription a été envoyée avec succès !');
    }
}
