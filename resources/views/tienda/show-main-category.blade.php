@extends('plantilla.tienda')

@if (isset($category))
@section('titulo', $main_category->nombre . ' | ' . $sub_category->nombre . ' | ' . $category->nombre.' | '.__('See the Main-Category').' | TuMiniMercado')
@else
@section('titulo', __('See All Categories').' | TuMiniMercado')
@endif

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
</style>
@endsection

@section('scripts')
<!-- Select2 -->
<script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Ekko Lightbox -->
<script src="{{ asset('adminlte/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>

<script>
</script>
@endsection


@section('contenido')

<div class="super_container_inner">

    <div class="products">



        <!------------- single category details ---------------->
        @if (isset($main_category))

        <div class="container">
            <a href="{{ url('store/show-category/'.$category->slug.'') }}" class="text-success">{{$category->nombre}}</a> <i class="nav-icon fas fa-arrow-right text-warning"></i> <a href="{{ url('store/show-sub-category/'.$sub_category->slug.'') }}" class="text-success">{{$sub_category->nombre}}</a> <i class="nav-icon fas fa-arrow-right text-warning"></i> <a href="{{ url('store/show-main-category/'.$main_category->slug.'') }}" class="text-success">{{$main_category->nombre}}</a>
        </div>
        
        <div class="container mt-3">

            <h1 class="font-weight-bold"><i class="nav-icon fas fa-shapes text-success"></i> {{__('All Products in')}}
                {{$main_category->nombre}}</h1>

            @if (!isset($productos[0]->id))
            <br><br><br>
            <div class="mt-5">
                <h2>{{__('There are no products available in this category')}}</h2>
            </div>
            @endif

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
                            <img class="card-img-top img-thumbnail" src="{{$producto->images->random()->url}}" alt=""
                                style="object-fit: contain; height: 100%">
                        </div>
                        @endif
                    </a>

                    <div class="card-header h5 bg-transparent">{{$producto->nombre}}</div>
                    <div class="card-body text-success p-0 ml-2 mr-2">
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
                        <small class="text-muted">{{__('See all in')}} <a href="{{ url('store/show-category/'.$producto->main_category->sub_category->category->slug.'') }}"
                                class="text-success">{{$producto->main_category->sub_category->category->nombre}}</a></small>
                    </div>

                </div>
            </div>

            @endforeach
        </div>

        <div class="float-right m-2">
            {{$productos->appends($_GET)->links()}}
        </div>



    </div>
    @endif

    <!------------- all categories ---------------->
    @if (isset($main_categories))


</div>
@endif
</div>
</div>

@endsection