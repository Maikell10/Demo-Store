@extends('plantilla.tienda')

@section('titulo','TuMiniMercado')

@section('estilos')

<link rel="stylesheet" type="text/css" href="{{ asset('asset/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('asset/styles/responsive.css') }}">

@endsection

@section('scripts')
<script>
    function addToCart(id) {
        $.ajax({
            type: "GET",
            data: $('#formAddToCart').serialize(),
            url: "/store/cart/add/" + id,
            success: function(res) {
                if (res == 'negativo') {
                    Swal.fire({
                        title: 'Error!',
                        text: 'No hay más cantidades disponibles para el producto seleccionado',
                        icon: 'error',
                        confirmButtonText: 'Ok',
                    })
                } else if (res == 'same') {
                    Swal.fire({
                        title: 'Alerta!',
                        text: 'No puede comprar el producto de su tienda',
                        icon: 'warning',
                        confirmButtonText: 'Ok',
                    })
                } else{
                    Swal.fire({
                        icon: 'success',
                        title: 'Agregado al Carrito!',
                        showConfirmButton: false,
                    })
                    
                    window.setTimeout(function(){
                        location.reload();
                    }, 500)
                }
            }
        });
    };
</script>
@endsection


@section('contenido')


<div class="super_container_inner">
    <div class="super_overlay"></div>

    <!-- Home -->

    <form action="" method="POST" id="formAddToCart" hidden>
        @csrf
        <input type="text" value="hidden form for Add To Cart">
    </form>

    <div class="home">
        <!-- Home Slider -->
        <div class="home_slider_container" style="margin-top: -6px">

            <div class="owl-carousel owl-theme home_slider">

                @foreach ($productos as $producto)

                @if ($producto->sliderprincipal == 'Si')
                @php
                $urlImage = $producto->images[0]->url;
                $urlImage = substr($urlImage, 10);
                @endphp

                <!-- Slide -->
                <div class="owl-item">
                    <div class="background_image"
                        style="background-image:url({{ asset('imagenes/'.$urlImage.'') }});"></div>
                    <div class="container fill_height">
                        <div class="row fill_height">
                            <div class="col fill_height">
                                <div class="home_container d-flex flex-column align-items-center justify-content-start">
                                    <div class="home_content mt-5">
                                        <div class="home_title">{{__('Premium Products')}}</div>
                                        <div class="home_subtitle">TuMiniMercado</div>
                                        <div class="home_items">
                                            <div class="row">
                                                <div class="col-sm-3 offset-lg-1">
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-8 offset-sm-2 offset-md-0">
                                                    <div class="product home_item_large">
                                                        <div
                                                            class="product_tag d-flex flex-column align-items-center justify-content-center">
                                                            <div>
                                                                <div>${{number_format($producto->precio_actual,2)}}
                                                                </div>
                                                                <del
                                                                    class="price-oldslider">${{number_format($producto->precio_anterior,2)}}</del>
                                                            </div>
                                                        </div>
                                                        <div class="product_image" style="background-color: aliceblue">
                                                            <a
                                                                href="{{ url('store/show-product/'.$producto->slug.'') }}">
                                                                <img src="{{$producto->images[0]->url}}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="product_content"
                                                            onclick="addToCart({{$producto->id}})">
                                                            <div class="product_buttons">
                                                                <div
                                                                    class="text-right d-flex flex-row align-items-start justify-content-start">
                                                                    <div
                                                                        class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center">
                                                                        <div>
                                                                            <div>
                                                                                <img src="{{ asset('asset/images/cart_2.svg') }}"
                                                                                    alt="">
                                                                                <div>+</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="home_subtitle">{{$producto->nombre}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @endforeach


            </div>
            <div class="home_slider_nav home_slider_nav_prev"><i class="fa fa-chevron-left" aria-hidden="true"></i>
            </div>
            <div class="home_slider_nav home_slider_nav_next"><i class="fa fa-chevron-right" aria-hidden="true"></i>
            </div>

        </div>
    </div>










    <!-- Products -->

    <div class="products">
        <div class="container" style="max-width: 1200px;">
            <div class="row page_nav_row">
                <div class="col">
                    <div class="page_nav">
                        <ul class="d-flex flex-row align-items-start justify-content-center">
                            <li class="active"><a href="{{ url('/store/show-category') }}">{{__('See All Categories')}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section_title text-center">{{__('Populars')}}</div>
                </div>
            </div>

            <div class="row products_row">

                <!-- item-->
                @if (count($populars) >= 6)
                @php
                $contador = 6;
                @endphp
                @else
                @php
                $contador = count($populars);
                @endphp
                @endif

                @for ($i = 0; $i < $contador; $i++) <!-- Product -->
                    <div class="col-xl-4 col-md-6">
                        <div class="product">

                            @if ($populars[$i]->estado == 'En Oferta')
                            <span class="badge-offer"><b> - {{$populars[$i]->porcentaje_descuento}}%</b></span>
                            <span class="badge-new"><b> {{$populars[$i]->estado}} </b></span>
                            @else
                            <span class="badge-new"><b> {{$populars[$i]->estado}} </b></span>
                            @endif

                            <a href="{{ url('store/show-product/'.$populars[$i]->slug.'') }}">
                                @if ($populars[$i]->images->count() <= 0) <div class="product_image"
                                    style="height: 300px">
                                    <img src="/imagenes/boxed-bg.jpg" alt=""
                                        style="object-fit: cover; height: 100%; width: 100%">
                        </div>
                        @else
                        <div class="product_image" style="height: 300px">
                            <img src="{{$populars[$i]->images->random()->url}}" alt=""
                                style="object-fit: cover; height: 100%; width: 100%">
                        </div>
                        @endif

                        </a>


                        <div class="product_content">
                            <div class="product_info align-items-start justify-content-start">
                                <div>
                                    <div>
                                        <div class="product_name" data-toggle="tooltip" data-placement="top" title=""
                                            data-original-title="{{$populars[$i]->nombre}}"><a
                                                href="{{ url('store/show-product/'.$populars[$i]->slug.'') }}">{{\Illuminate\Support\Str::limit($populars[$i]->nombre ?? '',22,' ...')}}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="ml-auto text-right">
                                    <div class="product_category">{{__('In')}} <a
                                            href="{{url ('/store/show-category/'.$populars[$i]->main_category->sub_category->category->slug.'')}}">
                                            <td>{{$populars[$i]->main_category->sub_category->category->nombre}}</td>
                                        </a></div>

                                    @if ($populars[$i]->estado == 'En Oferta')
                                    <div class="product_price text-right"><del class="price-old"
                                            style="font-size: 15px">
                                            ${{number_format($populars[$i]->precio_anterior,2)}}</del>${{number_format($populars[$i]->precio_actual,2)}}
                                    </div>
                                    @else
                                    <div class="product_price text-right">
                                        ${{number_format($populars[$i]->precio_actual,2)}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="product_buttons" onclick="addToCart({{$populars[$i]->id}})">
                                <div class="text-right d-flex flex-row align-items-start justify-content-start">
                                    <div
                                        class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center">
                                        <div>
                                            <div><img src="{{ asset('asset/images/cart.svg') }}" class="svg"
                                                    alt="">
                                                <div>+</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            @endfor

        </div>
        <div class="row load_more_row" hidden>
            <div class="col">
                <div class="button load_more ml-auto mr-auto"><a
                        href="{{ url('store/show-product') }}">{{__('See All')}}</a></div>
            </div>
        </div>
    </div>
</div>







<!-- Nuestros Productos -->

<div class="lomasvendidocontenedor mt-3">
    <div class="section_title text-center">{{__('Our Products')}}</div>
    <br>
    <div class="lomasvendido owl-carousel owl-theme">

        <!-- item-->
        @if (count($productos) >= 14)
        @php
        $contador = 10;
        @endphp
        @else
        @php
        $contador = count($productos);
        @endphp
        @endif

        @for ($i = 0; $i < $contador; $i++) <div class="item">
            <div class="product">

                @if ($productos[$i]->estado == 'En Oferta')
                <span class="badge-offer"><b> - {{$productos[$i]->porcentaje_descuento}}%</b></span>
                <span class="badge-new"><b> {{$productos[$i]->estado}} </b></span>
                @else
                <span class="badge-new"><b> {{$productos[$i]->estado}} </b></span>
                @endif

                @if ($productos[$i]->images->count() <= 0) <div class="product_image" style="height: 300px">
                    <img class="img-thumbnail" src="/imagenes/boxed-bg.jpg" alt=""
                        style="object-fit: contain; height: 100%">
            </div>
            @else
            <div class="product_image" style="height: 300px">
                <img class="img-thumbnail" src="{{$productos[$i]->images->random()->url}}" alt=""
                    style="object-fit: contain; height: 100%">
            </div>
            @endif

            <div class="product_content">
                <div class="product_info  align-items-start justify-content-start">
                    <div>
                        <div>
                            <div class="product_name" data-toggle="tooltip" data-placement="top" title=""
                                data-original-title="{{$productos[$i]->nombre}}"><a
                                    href="{{ url('store/show-product/'.$productos[$i]->slug.'') }}">{{\Illuminate\Support\Str::limit($productos[$i]->nombre ?? '',20,' ...')}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="ml-auto text-left">
                        <div class="product_category">{{__('In')}} <a
                                href="{{ url('store/show-category/'.$productos[$i]->main_category->sub_category->category->slug.'') }}">
                                <td>{{$productos[$i]->main_category->sub_category->category->nombre}}</td>
                            </a></div>

                        @if ($productos[$i]->estado == 'En Oferta')
                        <div class="product_price text-right"><del class="price-old">
                                ${{number_format($productos[$i]->precio_anterior,2)}}</del>${{number_format($productos[$i]->precio_actual,2)}}
                        </div>
                        @else
                        <div class="product_price text-right">${{number_format($productos[$i]->precio_actual,2)}}
                        </div>
                        @endif
                    </div>
                </div>

                <div class="product_buttons" onclick="addToCart({{$productos[$i]->id}})">
                    <div class="text-right d-flex flex-row align-items-start justify-content-start">
                        <div
                            class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center">
                            <div>
                                <div><img src="{{ asset('asset/images/cart.svg') }}" class="svg" alt="">
                                    <div>+</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>

@endfor
<div class="">
    <div class="row load_more_row">
        <div class="col">
            <div class="button load_more ml-auto mr-auto" style="margin-top: 50%"><a
                    href="{{ url('store/show-product') }}">{{__('See All')}}</a>
            </div>
        </div>
    </div>
</div>
</div>
</div>


<br>

<br>

<br>


<!-- En oferta -->


<div class="lomasvendidocontenedor">
    <div class="section_title text-center">{{__('Offers')}}</div>
    <br>
    <div class="lomasvendido owl-carousel owl-theme">

        <!-- item-->

        @foreach ($productos as $producto)

        @if ($producto->estado == 'En Oferta')

        <div class="">
            <div class="product">

                <span class="badge-offer"><b> - {{$producto->porcentaje_descuento}}%</b></span>
                <span class="badge-new"><b> {{$producto->estado}} </b></span>

                @if ($producto->images->count() <= 0) <div class="product_image" style="height: 300px">
                    <img class="img-thumbnail" src="/imagenes/boxed-bg.jpg" alt=""
                        style="object-fit: contain; height: 100%">
            </div>
            @else
            <div class="product_image" style="height: 300px">
                <img class="img-thumbnail" src="{{$producto->images->random()->url}}" alt=""
                    style="object-fit: contain; height: 100%">
            </div>
            @endif

            <div class="product_content">
                <div class="product_info">
                    <div>
                        <div>
                            <div class="product_name product_namesinwidth text-center" data-toggle="tooltip"
                                data-placement="top" title="" data-original-title="{{$producto->nombre}}"><a
                                    href="{{ url('store/show-product/'.$producto->slug.'') }}">{{\Illuminate\Support\Str::limit($producto->nombre ?? '',20,' ...')}}</a>
                            </div>

                        </div>
                    </div>
                    <div class="ml-auto">
                        <div class="product_price text-center">${{number_format($producto->precio_actual,2)}}<del
                                class="price-old">
                                ${{number_format($producto->precio_anterior,2)}}</del>
                        </div>

                    </div>
                </div>
                <div class="product_buttons" onclick="addToCart({{$producto->id}})">
                    <div class="text-right d-flex flex-row align-items-start justify-content-start">
                        <div
                            class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center">
                            <div>
                                <div><img src="{{ asset('asset/images/cart.svg') }}" class="svg" alt="">
                                    <div>+</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @endif

    @endforeach
    <div class="">
        <div class="row load_more_row">
            <div class="col">
                <div class="button load_more ml-auto mr-auto" style="margin-top: 50%"><a href="#">{{__('See All')}}</a>
                </div>
            </div>
        </div>
    </div>

</div>
</div>

<br>

<br>

<br>




<!-- Features -->

<div class="features">
    <div class="container">
        <div class="row">

            <!-- Feature -->
            <div class="col-lg-4 feature_col">
                <div class="feature d-flex flex-row align-items-start justify-content-start">
                    <div class="feature_left">
                        <div class="feature_icon"><img src="{{ asset('asset/images/icon_1.svg') }}" alt="">
                        </div>
                    </div>
                    <div class="feature_right d-flex flex-column align-items-start justify-content-center">
                        <div class="feature_title">{{__('Direct payments with the seller')}}</div>
                    </div>
                </div>
            </div>

            <!-- Feature -->
            <div class="col-lg-4 feature_col">
                <div class="feature d-flex flex-row align-items-start justify-content-start">
                    <div class="feature_left">
                        <div class="feature_icon ml-auto mr-auto"><img
                                src="{{ asset('asset/images/icon_2.svg') }}" alt=""></div>
                    </div>
                    <div class="feature_right d-flex flex-column align-items-start justify-content-center">
                        <div class="feature_title">{{__('Quality Products')}}</div>
                    </div>
                </div>
            </div>

            <!-- Feature -->
            <div class="col-lg-4 feature_col">
                <div class="feature d-flex flex-row align-items-start justify-content-start">
                    <div class="feature_left">
                        <div class="feature_icon"><img src="{{ asset('asset/images/icon_3.svg') }}" alt="">
                        </div>
                    </div>
                    <div class="feature_right d-flex flex-column align-items-start justify-content-center">
                        <div class="feature_title">{{__('Direct messaging with the seller')}}</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


@endsection