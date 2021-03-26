@extends('plantilla.tienda')

@section('titulo', $user->name.' | Ver Tienda | TuMiniMercado')

@section('estilos')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('asset/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('asset/styles/responsive.css') }}">

<!-- Ekko Lightbox -->
<link rel="stylesheet" href="{{ asset('adminlte/plugins/ekko-lightbox/ekko-lightbox.css') }}">

<style>
    /*--------- single product details -----------*/

    input:focus {
        outline: none;
    }

    .small-img-row {
        display: flex;
    }

    .small-img-col {
        flex-basis: 24%;
        cursor: pointer;
    }

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
        $('#cantidad').select2();


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

<div class="super_container_inner">
    <div class="products">
        <div class="container-fluid">
            <img class="home__image" src="{{asset('asset/images/banner.jpg')}}" alt="" />

            <div class="container">
                <h1 class="home_subtitle font-weight-bold mb-5"><i class="nav-icon fas fa-store text-success"></i> Tienda de
                    {{$user->name}}
                </h1>

                <div class="row row-cols-2 row-cols-md-4">
                    @foreach ($productos as $producto)
                    <div class="col mb-4">
                        <a href="{{ url('store/show-product/'.$producto->slug.'') }}">
                            <div class="card border-success h-100">

                                @if ($producto->images->count() <= 0) <div class="product_image" style="height: 200px">
                                    <img class="card-img-top img-thumbnail" src="/imagenes/boxed-bg.jpg" alt=""
                                        style="object-fit: contain; height: 100%">
                            </div>

                            @else
                            <div class="product_image" style="height: 200px">
                                <img class="card-img-top img-thumbnail" src="{{$producto->images->random()->url}}"
                                    alt="" style="object-fit: contain; height: 100%">
                            </div>
                            @endif
                        </a>
                        <div class="card-header h5 bg-transparent">{{$producto->nombre}}</div>
                        <div class="card-body text-success p-2 ml-2">
                            <h5 class="card-title"></h5>


                            @if ($producto->estado == 'En Oferta')
                            <div class="product_price text-right">
                                <p class="card-text">
                                    <del class="text-muted text-black-50">
                                        US${{number_format($producto->precio_anterior,2)}}
                                    </del>US${{number_format($producto->precio_actual,2)}}
                                </p>
                            </div>
                            @else
                            <div class="product_price text-right">
                                <p class="card-text">
                                    US${{number_format($producto->precio_actual,2)}}
                                </p>
                            </div>
                            @endif

                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Ver todo en <a
                                    href="{{url('store/show-category/'.$producto->main_category->sub_category->category->slug.'')}}"
                                    class="text-success">{{$producto->main_category->sub_category->category->nombre}}</a></small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>


        </div>

        <div class="float-right m-2">
            {{$productos->appends($_GET)->links()}}
        </div>

    </div>



</div>
</div>

@endsection