@component('mail::message', ['user' => $user])
<center>
<img src='https://www.tuminimercado.com/asset/images/LogoTM3mail.png' alt="TuMiniMercado Logo" class="brand-image" style="max-height: 100px;height: 100px; width: 100px" height="100px" width="100px" />
</center>
<br>

<h2 style="text-align: center; font-weight: bold">{{__('Hello!')}} <font style="color: goldenrod">{{$user->name}}</font>, gracias por registrarte en <strong>TuMiniMercado</strong> !</h2>
<p>Por favor confirma tu correo electrónico.</p>
<p>Para ello simplemente debes hacer click en el siguiente enlace:</p>

<h3 style="text-align: center">{{__('You have placed a new order in')}} <a style="color: limegreen; font-weight: bold" href="https://tuminimercado.com">TuMiniMercado</a></h3>

@component('mail::button', ['url' => 'https://tuminimercado.com/register/verify/'.$confirmation_code, 'color' => 'success'])
Clic para confirmar tu email
@endcomponent

<hr>

@component('mail::panel')
{{__('We are your best option in ecommerce always')}}
@endcomponent

@endcomponent