<x-mail::message>
# New Contact Message

**From:** {{ $contactMessage->fullname }} ({{ $contactMessage->email }})

{{ $contactMessage->message }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
