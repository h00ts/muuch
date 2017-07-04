@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @if (isset($subcopy))
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endif

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')      
            Cualquier duda, queja o sugerencia que tengas puedes comunicarla con tu coordinador regional o enviando un correo a ruslan@ilumexico.mx
            
            &copy; {{ date('Y') }} Iluméxico
        @endcomponent
    @endslot
@endcomponent
