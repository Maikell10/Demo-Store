@component('mail::message', ['user' => $user])
<center>
<img src='https://www.tuminimercado.com/asset/images/LogoTM3mail.png' alt="TuMiniMercado Logo" class="brand-image" style="max-height: 100px;height: 100px; width: 100px" height="100px" width="100px" />
</center>
<br>

<h2 style="text-align: center; font-weight: bold">{{__('Hello!')}} <font style="color: goldenrod">{{$user->name}}</font></h2>

<h3 style="text-align: center">{{__('You have placed a new order in')}} <a style="color: limegreen; font-weight: bold" href="https://tuminimercado.com">TuMiniMercado</a></h3>

@component('mail::button', ['url' => 'https://tuminimercado.com/store/purchases/'.$sale->created_at, 'color' => 'success'])
{{__('See Order')}}
@endcomponent

<hr>

@component('mail::panel')
{{__('We are your best option in ecommerce always')}}
@endcomponent

@endcomponent