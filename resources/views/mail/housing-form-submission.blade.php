<x-mail::message>
# Nouveau message - Hébergement

**Nom :** {{ $contact->name }}

**E-mail :** {{ $contact->email }}

**Téléphone :** {{ $contact->telephone ?? 'N/A' }}

@if($contact->message)
**Message :**
{{ $contact->message }}
@endif

</x-mail::message>
