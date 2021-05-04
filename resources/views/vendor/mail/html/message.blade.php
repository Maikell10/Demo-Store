@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])

@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
Te enviamos este mensaje a <a href="mailto:{{$user->email}}">{{$user->email}}</a>
<br>
Conócenos y visita nuestros <a href="https://tuminimercado.com/terminos">Términos y Condiciones de TuMiniMercado</a>
<br>
<strong>© {{ date('Y') }} <a href="https://tuminimercado.com">TuMiniMercado</a>.</strong> @lang('All rights reserved.')
@endcomponent
@endslot
@endcomponent
