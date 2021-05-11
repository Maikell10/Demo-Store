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


            <h1 class="home_subtitle font-weight-bold mt-2 mb-5"><i
                    class="nav-icon fas fa-shopping-cart text-success"></i>
                {{__('Cart')}}
            </h1>

            @if($products[0] != '0')

            <div class="row m-0">
                <div class="col-md-8">
                    <div class="row row-cols-1 row-cols-md-1 ml-3">
                        <input type="text" value="{{count($products)}}" id="numId" hidden>
                        @for ($a = 0; $a < count($products); $a++)
                        <div class="row card border-success" style="flex-direction: row;">
                            <div class="col-md-4 mt-2" style="max-inline-size: fit-content;">
                                @if ($products[$a]->images->count() <= 0)
                                <img src="/imagenes/boxed-bg.jpg" style="object-fit: contain; max-height: 200px;width: -webkit-fill-available;">
                                @else
                                <img src="{{$products[$a]->images[0]->url}}" style="object-fit: contain; max-height: 200px;width: -webkit-fill-available;">
                                @endif
                            </div>
                            <div class="col-md">
                                <div class="row ml-1 mr-1 mt-3">
                                    <div class="product_name">
                                        <a href="{{ url('store/show-product/'.$products[$a]->slug.'') }}">{{$products[$a]->nombre}}</a>
                                    </div>
                                    <h5 class="text-right ml-auto font-weight-bold">US$ @{{(precio_act[{{{$a}}}])}}</h5>
                                    <input id="precio_act{{$a}}" type="text" value="{{($products[$a]->precio_actual)}}" hidden>
                                    <input id="id_producto{{$a}}" type="text" value="{{($products[$a]->id)}}" hidden>

                                    @php
                                        $total_p = $total_p + $products[$a]->precio_actual;
                                    @endphp
                                </div>

                                <div class="row ml-1 mr-1 d-block">
                                    @if ($products[$a]->cantidad > 0)
                                        <h5 class="text-success">{{__('Available.')}}</h5>
                                        <div class="form-group" style="width: 160px;">
                                            <label style="align-self: flex-end;">{{__('Quantity')}}</label>
                                            <select name="cantidad{{$a}}" id="cantidad{{$a}}" class="form-control select2">
                                                @for ($i = 1; $i <= $products[$a]->cantidad; $i++)
                                                    @if ($i == $sessions[$a]['cantidad'])
                                                        <option value="{{ $i }}" selected="selected">{{ $i }}</option>
                                                    @else
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endif
                                                @endfor
                                            </select>
                                        </div>

                                        @php
                                            $cantidad_p = $cantidad_p + $products[$a]->cantidad;
                                        @endphp
                                    @else
                                        <h5 class="text-danger">{{__('Not available.')}}</h5>
                                    @endif

                                    
                                </div>

                                <div class="row ml-1 mr-1 mb-3">
                                    <form action="{{ url('store/cart/'.$indice.'') }}" method="POST" id="formDelete">
                                        @csrf
                                        @method('delete')
                                        <button v-on:click="eliminarCarrito({{$indice}},{{($products[$a]->id)}})" type="button" class="btn btn-danger">{{__('Delete')}}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @php
                            $indice = $indice + 1;
                        @endphp
                        @endfor
                    </div>
                <h3 class="text-right mr-1">Subtotal (<font v-model="cantTotal">@{{cantTotal}}</font>): <font class="font-weight-bold">US$ @{{precio_total}}</font></h3>
                </div>
                <div class="col-md-4">
                    <div class="card border-success p-3">
                        
                        <h4>Subtotal (@{{cantTotal}}): </h4>
                        <h4><font class="font-weight-bold">US$ @{{precio_total}}</font></h4>

                        @if(isset(Auth::user()->name))
                        <button v-on:click="order()" class="btn btn-warning font-weight-bold" style="white-space: break-spaces">{{__('Proceed to Purchase')}}</button>
                        @else
                        <a href="{{url('login?pag=store/cart')}}" class="btn btn-outline-success font-weight-bold" style="white-space: break-spaces">{{__('You must log in to proceed with the purchase')}}</a>
                        @endif
                    </div>
                </div>
            </div>
                

            @else

                <h3 class="font-weight-bold mt-2 mb-5 text-danger text-center"><i class="nav-icon fas fa-warning text-warning"></i>
                    {{__('Add a product to the Cart to continue')}}
                </h3>

            @endif



        </div>
        
    </div>

</div>

@endsection