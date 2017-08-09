@component('mail::message')

{{ $userName }} ({{ $userEmail }}) ha escrito el siguiente mensaje en el buzón de quejas y sugerencias:

@component('mail::panel')
   {{ $message }}
@endcomponent

@endcomponent