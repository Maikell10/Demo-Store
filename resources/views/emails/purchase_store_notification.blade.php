@component('mail::message', ['user' => $user_store])
<center>
<img src='https://www.tuminimercado.com/asset/images/LogoTM3mail.png' alt="TuMiniMercado Logo" class="brand-image" style="max-height: 100px;" />
</center>
<br>

<h2 style="text-align: center; font-weight: bold">Hola <font style="color: goldenrod">{{$user_store->name}}</font></h2>

<h3 style="text-align: center">Tienes una nueva Orden en tu Tienda de <a style="color: limegreen; font-weight: bold" href="https://tuminimercado.com">TuMiniMercado</a></h3>
<h3 style="text-align: center">Cliente: <font style="color: darkgreen; font-weight: bold">{{$user->name}}</font></h3>

@component('mail::button', ['url' => 'http://tiendademo1.test/admin/order/'.$sale->created_at, 'color' => 'success'])
Ver Orden
@endcomponent

<hr>

@component('mail::panel')
Somos tu mejor opción en ecommerce siempre
@endcomponent

@endcomponent