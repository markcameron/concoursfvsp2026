<?php

namespace App\Http\Controllers;

use App\Enums\ContactType;
use App\Http\Requests\SponsorFormRequest;
use App\Mail\SponsorFormReply;
use App\Mail\SponsorFormSubmission;
use App\Models\Contact;
use App\Models\SponsorInfo;
use App\Models\SponsorLevel;
use Illuminate\Support\Facades\Mail;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class SponsorController extends Controller
{
    public function index()
    {
        $sponsorLevels = SponsorLevel::orderBy('price', 'asc')->get();

        return view('sponsoring')
            ->with('sponsorLevels', $sponsorLevels)
            ->with('seoData', new SEOData(
                title: 'Sponsoring',
                description: 'Devenez sponsor du Concours FVSP 2026 et soutenez les sapeurs-pompiers vaudois à Coppet.',
            ));
    }

    public function info()
    {
        $sponsorInfo = SponsorInfo::first();

        return view('sponsoring_info')
            ->with('sponsorInfo', $sponsorInfo)
            ->with('seoData', new SEOData(
                title: 'Devenir sponsor',
                description: 'Découvrez les modalités pour devenir sponsor et partenaire du Concours FVSP 2026 à Coppet.',
            ));
    }

    public function form()
    {
        return view('sponsoring_form')
            ->with('seoData', new SEOData(
                title: 'Demande de sponsoring',
                description: 'Soumettez votre demande de sponsoring pour le Concours FVSP 2026 à Coppet.',
            ));
    }

    public function store(SponsorFormRequest $request)
    {
        try {
            $contact = Contact::create(collect(['type' => ContactType::SPONSORING])->merge($request->safe()->except('cf-turnstile-response'))->toArray());
            Mail::to(explode(',', config('site.sponsor_emails')))->send(new SponsorFormSubmission($contact));
            Mail::to($contact->email)->send(new SponsorFormReply($contact));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Une erreur est survenue lors de l'envoi de votre message. Veuillez réessayer plus tard.");
        }

        return redirect()->back()->with('success', 'Votre message a été envoyé avec succès !');
    }
}
