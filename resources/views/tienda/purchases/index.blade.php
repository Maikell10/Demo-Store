@extends('plantilla.tienda')

@section('titulo', 'Shopping Cart | Ver Tienda | TuMiniMercado')

@section('estilos')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('asset/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('asset/styles/responsive.css') }}">

<!-- Ekko Lightbox -->
<link rel="stylesheet" href="{{ asset('adminlte/plugins/ekko-lightbox/ekko-lightbox.css') }}">

<style>
    .home__image {
        width: 100%;
        -webkit-mask-image: linear-gradient(to bottom, rgba(0, 0, 0, 1), rgba(0, 0, 0, 0));
        z-index: -1;
        margin-bottom: -150px;
        max-height: 200px;
    }

    .products {
        padding-top: 0px;
    }

    .product_name {
        max-width: none;
    }
</style>
@endsection

@section('scripts')
<!-- Select2 -->
<script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Ekko Lightbox -->
<script src="{{ asset('adminlte/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>

<script>
    $(function () {
        //Initialize Select2 Elements
        //$('#cantidad').select2();


        //Initialize Select2 Elements
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        });

        //usando lightbox
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });
    });

    $('#menuPurchases').addClass('active');
</script>
@endsection


@section('contenido')

@php
    $cantidad_p = 0;
    $total_p = 0;
    $indice = 0;
@endphp

<div class="super_container_inner" id="appTienda">
    <input type="text" value="{{config('app.locale')}}" id="lang" hidden>

    <div class="products">
        <div class="container-fluid">
            <img class="home__image" src="{{asset('asset/images/banner.jpg')}}" alt="" />


            <h1 class="home_subtitle font-weight-bold mt-3 mb-5"><i
                    class="nav-icon fas fa-shopping-bag text-success"></i>
                {{__('Purchases')}}
            </h1>

            
            @if($products[0] != '0')

            <div class="row m-0">
                <div class="col-md"></div>
                <div class="col-md-8">
                    <div class="row row-cols-1 row-cols-md-1">
                        <input type="text" value="{{count($products)}}" id="numId" hidden>
                        @for ($a = 0; $a < count($distinct_sale); $a++)

                        

                        <div class="card border-success" >

                            <div class="row" style="flex-direction: row;">
                                <div class="col-6 mt-2 mb-2">
                                    <h5 class="font-weight-bold ml-3">{{$distinct_sale[$a]->state}}</h5>
                                    <small class="ml-3 text-muted">{{ \Carbon\Carbon::parse($distinct_sale[$a]->updated_at)->diffForHumans() }}</small>
                                </div>
                                
                                <div class="col-6 text-right">
                                <a href="{{route('tienda.purchases.show',$distinct_sale[$a]->updated_at)}}" class="btn btn-outline-success mt-3 mr-3" style="white-space: break-spaces; width: min-content" data-toggle="tooltip" data-placement="bottom" title="{{ __('See Detail') }}"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                            
                            @for ($c = 0; $c < count($sales); $c++)
                            @if ($distinct_sale[$a]->updated_at == $sales[$c]->updated_at)
                            <div class="row p-2" style="flex-direction: row;">

                                <div class="col-lg-2 col-sm-2 mt-2 mb-2" style="max-inline-size: fit-content;">
                                    <img src="{{$products[$c]->images[0]->url}}" style="object-fit: contain; max-height: 120px;width: -webkit-fill-available;">
                                </div>

                                <div class="col-lg-6 col-sm-4">
                                    <div class="row ml-1 mr-1 mt-3">
                                        <div class="product_name">
                                            <a href="{{ url('store/show-product/'.$products[$c]->slug.'') }}">{{$products[$c]->nombre}}</a>
                                        </div>
                                        <input id="id_producto{{$c}}" type="text" value="{{($products[$c]->id)}}" hidden>
                                    </div>
    
                                    <div class="row ml-1 mr-1 d-block">
                                        @if ($products[$c]->cantidad > 0)
                                            <div class="form-group" style="width: 160px;">
                                            <h5 class="ml-auto font-weight-bold text-muted mt-1">US$ {{$sales[$c]->price_sale}} x {{$sales[$c]->cantidad}}</h5>
                                            <h5 class="ml-auto font-weight-bold">US$ {{number_format($sales[$c]->price_sale * $sales[$c]->cantidad,2)}}</h5>
                                            </div>

                                            @php
                                                $cantidad_p = $cantidad_p + $sales[$c]->cantidad;
                                            @endphp
                                        @else
                                            <h5 class="text-danger">{{__('Not available.')}}</h5>
                                        @endif
                                        
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="row ml-1 mt-2">
                                        <div class="product_name">
                                            <div class="image p-1 mr-1 row" style="margin-left: -5px flex-direction: row;">
                        
                                                @if ($products[$c]->users[0]->social_image() != 'no hay img')
                                                <img src="{{$products[$c]->users[0]->social_image()}}" class="img-circle elevation-2" alt="User Image"
                                                style="height: 40px; width: 40px; object-fit: cover">
                                                @else
                                                @if (isset($products[$c]->users[0]->image->url))
                                                <img src="{{ $products[$c]->users[0]->image->url }}" class="img-circle elevation-2" alt="User Image"
                                                    style="height: 40px; width: 40px; object-fit: cover">
                                                @else
                                                <img src="{{ asset('adminlte/dist/img/avatardefault.png') }}"
                                                    class="img-circle elevation-2" alt="User Image" style="height: 40px; width: 40px; object-fit: cover">
                                                @endif
                                                @endif
                                                <h5 class="font-weight-bold mt-auto ml-1">{{__('Seller')}}</h5>
                                            </div>
                                            
                                            <a href="{{ url('commerce/'.$products[$c]->users[0]->name.'') }}" class="text-break">{{$products[$c]->users[0]->name}}</a>

                                            @if (\App\RatingStore::where('created_sale', $distinct_sale[$a]->created_at)->where('store_user_id', $products[$c]->users[0]->id)->get() != '[]')
                                                <h5 class="text-success">Calificado <i class="fas fa-check-square"></i></h5>
                                            @endif

                                        </div>
                                        <input id="id_producto{{$c}}" type="text" value="{{($products[$c]->id)}}" hidden>
                                    </div>
                                </div>
                                
                            </div>
                            <hr class="mb-0 w-75 m-auto" >
                            @endif
                            @endfor

                        </div>
                        @php
                            $indice = $indice + 1;
                        @endphp
                        @endfor
                    </div>
                
                </div>
                <div class="col-md"></div>
            </div>
                

            @else

                <h3 class="font-weight-bold mt-2 mb-5 text-danger text-center"><i class="nav-icon fas fa-warning text-warning"></i>
                    No tiene ordenes disponibles
                </h3>

            @endif



        </div>
        
    </div>

</div>

@endsection