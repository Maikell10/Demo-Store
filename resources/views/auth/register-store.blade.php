@extends('plantilla.tienda')

@section('titulo','Registrate | TuMiniMercado')

@section('estilos')

<link rel="stylesheet" type="text/css" href="{{ asset('asset/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('asset/styles/responsive.css') }}">

@endsection

@section('scripts')
<script
    src="https://www.paypal.com/sdk/js?client-id=ASmTZ5cj3P9Vp-z-3_bfPKpyerjr5-a6gSXV3NO2KBU-_tGIucMOpDgCw4mEjhF1r-EcNms-6HB0c834&vault=true"
    data-sdk-integration-source="button-factory"></script>
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

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card card-success card-outline mt-2">
                <div class="card-body table-responsive">
                    <h5 class="h4 text-center font-weight-bold">{{__('With any of our plans the first month is')}} <font class="text-danger">{{__('FREE')}}</font></h5>
                </div>
            </div>

            <div class="card-deck">
                <div class="card card-success card-outline">
                    <img class="mt-2" style="width: 200px;align-self: center;"
                        src="{{ asset('asset/images/LogoTM3.svg') }}" class="card-img-top" alt="TuMiniMercado Logo">
                    <div class="card-body">
                        <h5 class="h4 text-center font-weight-bold">{{__('Monthly Subscription')}}</h5>
                        <p class="h5 text-center">({{__('Basic Plan')}})</p>
                        <p class="card-text mt-2 text-justify">{{__('To sell and have all the benefits that we offer you, you can obtain a monthly subscription.')}}</p>
                        
                        <ul class="nav nav-pills nav-sidebar flex-column mt-2">
                            <li class="nav-item has-treeview">
                                <span class="nav-link text-orange"><i class="nav-icon fas fa-check"></i> {{__('Sell ​​Products (Up to 3 Different Products per Month)')}}</span>
                                <span class="nav-link text-success"><i class="nav-icon fas fa-check"></i> {{__('Products inventory')}}</span>
                                <span class="nav-link text-success"><i class="nav-icon fas fa-check"></i> {{__('Questions and Answers with the Clients')}}</span>
                                <span class="nav-link text-success"><i class="nav-icon fas fa-check"></i> {{__('Internal Messaging with Clients')}}</span>
                                <span class="nav-link text-success"><i class="nav-icon fas fa-check"></i> {{__('Control Dashboard')}}</span>

                                <span class="nav-link text-danger"><i class="nav-icon fas fa-times"></i> {{__('Customer Management')}}</span>
                                <span class="nav-link text-danger"><i class="nav-icon fas fa-times"></i> {{__('Purchasing and Provider Management')}}</span>
                            </li>
                        </ul>

                        <h4 class="text-center">{{__('Comming Soon')}}...</h4>

                        {{-- <div id="paypal-button-container"></div> --}}

                    </div>
                </div>
                <div class="card card-success card-outline">
                    <img class="mt-2" style="width: 200px;align-self: center;"
                        src="{{ asset('asset/images/LogoTM3.svg') }}" class="card-img-top" alt="TuMiniMercado Logo">
                    <div class="card-body">
                        <h5 class="h4 text-center font-weight-bold">{{__('Monthly Subscription')}}</h5>
                        <p class="h5 text-center">({{__('Premium Plan')}})</p>
                        <p class="card-text mt-2 text-justify">{{__('To sell and have all the benefits that we offer you, you can obtain a monthly subscription.')}}</p>
                        
                        <ul class="nav nav-pills nav-sidebar flex-column mt-2">
                            <li class="nav-item has-treeview">
                                <span class="nav-link text-success"><i class="nav-icon fas fa-check"></i> {{__('Sell ​​Products (No Limit)')}}</span>
                                <span class="nav-link text-success"><i class="nav-icon fas fa-check"></i> {{__('Products inventory')}}</span>
                                <span class="nav-link text-success"><i class="nav-icon fas fa-check"></i> {{__('Questions and Answers with the Clients')}}</span>
                                <span class="nav-link text-success"><i class="nav-icon fas fa-check"></i> {{__('Internal Messaging with Clients')}}</span>
                                <span class="nav-link text-success"><i class="nav-icon fas fa-check"></i> {{__('Control Dashboard')}}</span>

                                <span class="nav-link text-success"><i class="nav-icon fas fa-check"></i> {{__('Customer Management')}}</span>
                                <span class="nav-link text-success"><i class="nav-icon fas fa-check"></i> {{__('Purchasing and Provider Management')}}</span>
                            </li>
                        </ul>

                        <h1 class="text-center">5$</h1>
                    </div>
                </div>
                <div class="card card-success card-outline">
                    <img class="mt-2" style="width: 200px;align-self: center;"
                        src="{{ asset('asset/images/LogoTM3.svg') }}" class="card-img-top" alt="TuMiniMercado Logo">
                    <div class="card-body">
                        <h5 class="h4 text-center font-weight-bold">{{__('Annual Subscription')}}</h5>
                        <p class="h5 text-center">({{__('Premium Plan')}})</p>
                        <p class="card-text mt-2 text-justify">{{__('To sell and have all the benefits that we offer you, you can obtain a annual premium subscription.')}}</p>
                        
                        <ul class="nav nav-pills nav-sidebar flex-column mt-2">
                            <li class="nav-item has-treeview">
                                <span class="nav-link text-success"><i class="nav-icon fas fa-check"></i> {{__('Sell ​​Products (No Limit)')}}</span>
                                <span class="nav-link text-success"><i class="nav-icon fas fa-check"></i> {{__('Products inventory')}}</span>
                                <span class="nav-link text-success"><i class="nav-icon fas fa-check"></i> {{__('Questions and Answers with the Clients')}}</span>
                                <span class="nav-link text-success"><i class="nav-icon fas fa-check"></i> {{__('Internal Messaging with Clients')}}</span>
                                <span class="nav-link text-success"><i class="nav-icon fas fa-check"></i> {{__('Control Dashboard')}}</span>

                                <span class="nav-link text-success"><i class="nav-icon fas fa-check"></i> {{__('Customer Management')}}</span>
                                <span class="nav-link text-success"><i class="nav-icon fas fa-check"></i> {{__('Purchasing and Provider Management')}}</span>
                            </li>
                        </ul>

                        <h1 class="text-center">55$</h1>
                    </div>
                </div>
            </div>

            <div class="card card-success card-outline mt-3">
                <div class="card-header">
                    <h3 class="card-title mt-2 h3">{{__('Payment Methods')}}</h3>
                </div>
    
                <div class="card-body table-responsive">
                    <div>
                        <h5 class="h5 text-center font-weight-bold">{{__('You can request your seller account by sending an email to')}} <a href="mailto:pagos@tuminimercado.com?subject={{__('Seller%20account%20request')}}">pagos@tuminimercado.com</a> {{__('for the activation of our plans and services, then we will provide you with the details of the payment method you have.')}}</h5>

                        <div class="list-group" id="list-tab" role="tablist" style="flex-direction: row;justify-content: center;align-items: center;">
                            <a class="" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">
                                <img class="mt-2" style="width: 150px;align-self: center;" src="{{ asset('asset/images/logo-pipol.png') }}" class="card-img-top" alt="Pipol Pay Logo">
                            </a>
                            <a class="ml-5" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">
                                <img class="mt-2 ml-3" style="width: 150px;align-self: center;" src="{{ asset('asset/images/paypal-logo.svg') }}" class="card-img-top" alt="Paypal Logo">
                            </a>
                        </div>
                        {{-- <div class="row">
                            <div class="col-md-12">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                                        <p class="text-center">maikell.ods10@gmail.com</p>
                                    </div>
                                    <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                                        <p class="text-center">inversionesoliveira1608@gmail.com</p>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <br>

                        <div class="list-group" id="list-tab" role="tablist" style="flex-direction: row;justify-content: center;align-items: center;">
                            <a class="" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">
                                <img class="mt-2 ml-3" style="width: 150px;align-self: center;" src="{{ asset('asset/images/logo-banesco.png') }}" class="card-img-top" alt="Banesco Logo">
                            </a>
                            <a class="ml-5" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">
                                <img class="mt-2 ml-3" style="width: 150px;align-self: center;" src="{{ asset('asset/images/logo-b-pm.png') }}" class="card-img-top" alt="Banesco PagoMovil Logo">
                            </a>
                        </div>
                        {{-- <div class="row">
                            <div class="col-md-12">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
                                        <p class="text-center">Datos Banesco</p>
                                    </div>
                                    <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
                                        <p class="text-center">Datos Banesco Pago Móvil</p>
                                    </div>
                                </div>
                            </div>
                        </div> --}}


                        {{-- <img class="mt-2 ml-3" style="width: 150px;align-self: center;" src="{{ asset('asset/images/logo-facebank.png') }}" class="card-img-top" alt="Facebank Logo"> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection