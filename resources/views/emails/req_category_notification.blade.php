@component('mail::message', ['user' => $admin])
<center>
<img src='https://www.tuminimercado.com/asset/images/LogoTM3mail.png' alt="TuMiniMercado Logo" class="brand-image" style="max-height: 100px;height: 100px; width: 100px" height="100px" width="100px" />
</center>
<br>

<h2 style="text-align: center; font-weight: bold"><font style="color: goldenrod">{{$user_client->name}}</font> Ha solicitado una nueva Categoría</h2>

<h2 style="text-align: center; color: black">Pedido: {{$body}}</h2>


<h2 style="text-align: center; font-weight: bold; color: coral">{{$user_client->email}}</h2>

@component('mail::panel')
{{__('We are your best option in ecommerce always')}}
@endcomponent

@endcomponent
