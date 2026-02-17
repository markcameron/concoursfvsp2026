<x-mail::message>
# Inscription Tir au tuyau

**Nom de la société :** {{ $contact->company_name ?? 'N/A' }}

**Nom / Prénom :** {{ $contact->name }}

**E-mail :** {{ $contact->email }}

</x-mail::message>
