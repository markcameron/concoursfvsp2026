<?php

namespace App\Http\Controllers;

use App\Enums\ContactType;
use App\Http\Requests\ContactFormRequest;
use App\Http\Requests\HousingFormRequest;
use App\Mail\ContactFormSubmission;
use App\Mail\HousingFormReply;
use App\Mail\HousingFormSubmission;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact')
            ->with('seoData', new SEOData(
                title: 'Contact',
                description: 'Contactez le comité d\'organisation du Concours FVSP 2026 à Coppet.',
            ));
    }

    public function store(ContactFormRequest $request)
    {
        $contact = Contact::create(array_merge(
            $request->safe()->except('cf-turnstile-response'),
            ['type' => ContactType::CONTACT->value],
        ));

        Mail::to(explode(',', config('site.contact_emails')))->send(new ContactFormSubmission($contact));

        return redirect()->back()->with('success', 'Votre message a été envoyé avec succès !');
    }

    public function housing()
    {
        return view('housing')
            ->with('seoData', new SEOData(
                title: 'Hébergement',
                description: 'Trouvez un hébergement pour le Concours FVSP 2026, les 8 et 9 mai à Coppet.',
            ));
    }

    public function storeHousing(HousingFormRequest $request)
    {
        $contact = Contact::create(array_merge(
            $request->safe()->except('cf-turnstile-response'),
            ['type' => ContactType::HOUSING->value],
        ));

        Mail::to(explode(',', config('site.housing_emails')))->send(new HousingFormSubmission($contact));
        Mail::to($contact->email)->send(new HousingFormReply($contact));

        return redirect()->back()->with('success', 'Votre demande d\'hébergement a été envoyée avec succès !');
    }
}
