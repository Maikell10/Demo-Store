@component('mail::message', ['user' => $user])
<center>
<img src='https://www.tuminimercado.com/asset/images/LogoTM3mail.png' alt="TuMiniMercado Logo" class="brand-image" style="max-height: 100px;height: 100px; width: 100px" height="100px" width="100px" />
</center>
<br>

<h2 style="text-align: center; font-weight: bold">{{__('Hello!')}} <font style="color: goldenrod">{{$user->name}}</font></h2>

<h3 style="text-align: center"><font style="color: darkgreen; font-weight: bold">{{$user_client->name}}</font>{{__(' has sent you a direct message in')}} <a style="color: limegreen; font-weight: bold" href="https://tuminimercado.com">TuMiniMercado</a></h3>

@component('mail::button', ['url' => 'https://tuminimercado.com/admin/order/'.$date_order, 'color' => 'success'])
{{__('See Direct Message')}}
@endcomponent

@component('mail::panel')
{{__('We are your best option in ecommerce always')}}
@endcomponent

@endcomponent
