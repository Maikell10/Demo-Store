@component('mail::message', ['user' => $user_store])
<center>
<img src='https://www.tuminimercado.com/asset/images/LogoTM3mail.png' alt="TuMiniMercado Logo" class="brand-image" style="max-height: 100px;" />
</center>
<br>

<h2 style="text-align: center; font-weight: bold">{{__('Hello!')}} <font style="color: goldenrod">{{$user_store->name}}</font></h2>

<h3 style="text-align: center">{{__('You have a new Order in your Store of')}} <a style="color: limegreen; font-weight: bold" href="http://tiendademo1.test">TuMiniMercado</a></h3>
<h3 style="text-align: center">{{__('Client')}}: <font style="color: darkgreen; font-weight: bold">{{$user->name}}</font></h3>

@component('mail::button', ['url' => 'http://tiendademo1.test/admin/order/'.$sale->created_at, 'color' => 'success'])
{{__('See Order')}}
@endcomponent

<hr>

@component('mail::panel')
{{__('We are your best option in ecommerce always')}}
@endcomponent

@endcomponent