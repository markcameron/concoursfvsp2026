<x-mail::message>
# Nouveau message de contact

**Nom :** {{ $contact->name }}

**E-mail :** {{ $contact->email }}

**Téléphone :** {{ $contact->telephone ?? 'N/A' }}

**Message :**
{{ $contact->message }}

</x-mail::message>
