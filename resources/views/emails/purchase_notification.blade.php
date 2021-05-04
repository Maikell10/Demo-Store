@component('mail::message', ['user' => $user])
<center>
<img src='https://www.tuminimercado.com/asset/images/LogoTM3mail.png' alt="TuMiniMercado Logo" class="brand-image" style="max-height: 100px;height: 100px; width: 100px" height="100px" width="100px" />
</center>
<br>

<h2 style="text-align: center; font-weight: bold">Hola <font style="color: goldenrod">{{$user->name}}</font></h2>

<h3 style="text-align: center">Haz realizado una nueva Orden en <a style="color: limegreen; font-weight: bold" href="https://tuminimercado.com">TuMiniMercado</a></h3>

@component('mail::button', ['url' => 'http://tiendademo1.test/store/purchases/'.$sale->created_at, 'color' => 'success'])
Ver Orden
@endcomponent

<hr>

@component('mail::panel')
Somos tu mejor opción en ecommerce siempre
@endcomponent

@endcomponent