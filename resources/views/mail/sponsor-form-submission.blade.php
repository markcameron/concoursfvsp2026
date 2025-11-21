<x-mail::message>
# Nouveau message de demande d'informations sponsoring

**Nom :** {{ $contact->name }}

**E-mail :** {{ $contact->email }}

**Téléphone :** {{ $contact->telephone ?? 'N/A' }}

**Message :**
{{ $contact->message }}

</x-mail::message>
