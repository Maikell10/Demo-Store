@extends('layouts.app')

@section('titulo','Registrate | TuMiniMercado')

@section('scripts')
<script src="https://www.paypal.com/sdk/js?client-id=ASmTZ5cj3P9Vp-z-3_bfPKpyerjr5-a6gSXV3NO2KBU-_tGIucMOpDgCw4mEjhF1r-EcNms-6HB0c834&vault=true" data-sdk-integration-source="button-factory"></script>
<script>
  paypal.Buttons({
      style: {
          shape: 'pill',
          color: 'silver',
          layout: 'vertical',
          label: 'subscribe'
      },
      createSubscription: function(data, actions) {
        return actions.subscription.create({
          'plan_id': 'P-39M72794DM726540NL5XAH5Y'
        });
      },
      onApprove: function(data, actions) {
        alert(data.subscriptionID);
      }
  }).render('#paypal-button-container');
</script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-deck">
                <div class="card">
                    <img src="{{ asset('asset/images/LogoTM3.svg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Suscripción Mensual</h5>
                        <p class="card-text">Para poder vender y tener todos los benecifios que le ofrecemos puede obtener a la suscripción mensual.</p>
                        <br>

                        <div id="paypal-button-container"></div>

                    </div>
                </div>
                <div class="card">
                    <img src="{{ asset('asset/images/LogoTM3.svg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Suscripción Mensual</h5>
                        <p class="card-text">Para poder vender y tener todos los benecifios que le ofrecemos puede obtener a la suscripción mensual.</p>
                    </div>
                </div>
                <div class="card">
                    <img src="{{ asset('asset/images/LogoTM3.svg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                            additional content. This card has even longer content than the first to show that equal
                            height action.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection