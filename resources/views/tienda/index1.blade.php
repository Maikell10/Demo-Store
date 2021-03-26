@extends('plantilla.plantilla')

@section('titulo','TuMiniMercado')

@section('estilos')

<link rel="stylesheet" type="text/css" href="{{ asset('asset/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('asset/styles/responsive.css') }}">

@endsection


@section('contenido')


<div class="super_container_inner">
    <div class="super_overlay"></div>

    <!-- Home -->

    <div class="home">
        <!-- Home Slider -->
        <div class="home_slider_container">
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
                        style="background-image:url({{ asset('imagenes/'.$urlImage.'') }})"></div>
                    <div class="container fill_height">
                        <div class="row fill_height">
                            <div class="col fill_height">
                                <div class="home_container d-flex flex-column align-items-center justify-content-start">
                                    <div class="home_content mt-5">
                                        <div class="home_title">Premium Items</div>
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
                                                        <div class="product_image"><img
                                                                src="{{$producto->images->random()->url}}" alt=""></div>
                                                        <div class="product_content">
                                                            <div class="product_buttons">
                                                                <div
                                                                    class="text-right d-flex flex-row align-items-start justify-content-start">
                                                                    <div
                                                                        class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center">
                                                                        <div>
                                                                            <div><img
                                                                                    src="{{ asset('asset/images/cart_2.svg') }}"
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
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section_title text-center">Popular on Jhonatan Shop</div>
                </div>
            </div>
            <div class="row page_nav_row">
                <div class="col">
                    <div class="page_nav">
                        <ul class="d-flex flex-row align-items-start justify-content-center">
                            <li class="active"><a href="category.html">Women</a></li>
                            <li><a href="category.html">Men</a></li>
                            <li><a href="category.html">Kids</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row products_row">

                <!-- Product -->
                <div class="col-xl-4 col-md-6">
                    <div class="product">
                        <div class="product_image"><img src="{{ asset('asset/images/product_1.jpg') }}" alt="">
                        </div>
                        <div class="product_content">
                            <div class="product_info d-flex flex-row align-items-start justify-content-start">
                                <div>
                                    <div>
                                        <div class="product_name"><a href="product.html">Cool Clothing with
                                                Brown Stripes</a></div>

                                    </div>
                                </div>
                                <div class="ml-auto text-right">
                                    <div class="product_category">In <a href="category.html">Category</a></div>
                                    <div class="product_price text-right">$3<span>.99</span></div>
                                </div>
                            </div>
                            <div class="product_buttons">
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

                <!-- Product -->
                <div class="col-xl-4 col-md-6">
                    <div class="product">
                        <div class="product_image"><img src="{{ asset('asset/images/product_2.jpg') }}" alt="">
                        </div>
                        <div class="product_content">
                            <div class="product_info d-flex flex-row align-items-start justify-content-start">
                                <div>
                                    <div>
                                        <div class="product_name"><a href="product.html">Cool Clothing with
                                                Brown Stripes</a></div>

                                    </div>
                                </div>
                                <div class="ml-auto text-right">
                                    <div class="product_category">In <a href="category.html">Category</a></div>
                                    <div class="product_price text-right">$3<span>.99</span></div>
                                </div>
                            </div>
                            <div class="product_buttons">
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

                <!-- Product -->
                <div class="col-xl-4 col-md-6">
                    <div class="product">
                        <div class="product_image"><img src="{{ asset('asset/images/product_3.jpg') }}" alt="">
                        </div>
                        <div class="product_content">
                            <div class="product_info d-flex flex-row align-items-start justify-content-start">
                                <div>
                                    <div>
                                        <div class="product_name"><a href="product.html">Cool Clothing with
                                                Brown Stripes</a></div>

                                    </div>
                                </div>
                                <div class="ml-auto text-right">
                                    <div class="product_category">In <a href="category.html">Category</a></div>
                                    <div class="product_price text-right">$3<span>.99</span></div>
                                </div>
                            </div>
                            <div class="product_buttons">
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

                <!-- Product -->
                <div class="col-xl-4 col-md-6">
                    <div class="product">
                        <div class="product_image"><img src="{{ asset('asset/images/product_4.jpg') }}" alt="">
                        </div>
                        <div class="product_content">
                            <div class="product_info d-flex flex-row align-items-start justify-content-start">
                                <div>
                                    <div>
                                        <div class="product_name"><a href="product.html">Cool Clothing with
                                                Brown Stripes</a></div>

                                    </div>
                                </div>
                                <div class="ml-auto text-right">
                                    <div class="product_category">In <a href="category.html">Category</a></div>
                                    <div class="product_price text-right">$3<span>.99</span></div>
                                </div>
                            </div>
                            <div class="product_buttons">
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

                <!-- Product -->
                <div class="col-xl-4 col-md-6">
                    <div class="product">
                        <div class="product_image"><img src="{{ asset('asset/images/product_5.jpg') }}" alt="">
                        </div>
                        <div class="product_content">
                            <div class="product_info d-flex flex-row align-items-start justify-content-start">
                                <div>
                                    <div>
                                        <div class="product_name"><a href="product.html">Cool Clothing with
                                                Brown Stripes</a></div>

                                    </div>
                                </div>
                                <div class="ml-auto text-right">
                                    <div class="product_category">In <a href="category.html">Category</a></div>
                                    <div class="product_price text-right">$3<span>.99</span></div>
                                </div>
                            </div>
                            <div class="product_buttons">
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

                <!-- Product -->
                <div class="col-xl-4 col-md-6">
                    <div class="product">
                        <div class="product_image"><img src="{{ asset('asset/images/product_6.jpg') }}" alt="">
                        </div>
                        <div class="product_content">
                            <div class="product_info d-flex flex-row align-items-start justify-content-start">
                                <div>
                                    <div>
                                        <div class="product_name"><a href="product.html">Cool Clothing with
                                                Brown Stripes</a></div>

                                    </div>
                                </div>
                                <div class="ml-auto text-right">
                                    <div class="product_category">In <a href="category.html">Category</a></div>
                                    <div class="product_price text-right">$3<span>.99</span></div>
                                </div>
                            </div>
                            <div class="product_buttons">
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

            </div>
            <div class="row load_more_row">
                <div class="col">
                    <div class="button load_more ml-auto mr-auto"><a href="#">load more</a></div>
                </div>
            </div>
        </div>
    </div>







    <!-- Lo mas visto -->


    <div class="lomasvendidocontenedor">
        <div class="section_title text-center">Lo mas Visto</div>
        <br>
        <div class="lomasvendido owl-carousel owl-theme">

            <!-- item-->
            @if (count($productos) >= 14)
            @php
            $contador = 14;
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

                    @if ($productos[$i]->images->count() <= 0) <div class="product_image">
                        <img class="img-thumbnail" src="/imagenes/boxed-bg.jpg" alt="">
                </div>
                @else
                <div class="product_image">
                    <img class="img-thumbnail" src="{{$productos[$i]->images->random()->url}}" alt="">
                </div>
                @endif

                <div class="product_content">
                    <div class="product_info  align-items-start justify-content-start">
                        <div>
                            <div>
                                <div class="product_name" data-toggle="tooltip" data-placement="top" title=""
                                    data-original-title="{{$productos[$i]->nombre}}"><a
                                        href="product.html/{{$productos[$i]->slug}}">{{\Illuminate\Support\Str::limit($productos[$i]->nombre ?? '',20,' ...')}}</a>
                                </div>

                            </div>
                        </div>
                        <div class="ml-auto text-left">
                            <div class="product_category">En <a href="category.html/{{$productos[$i]->category->slug}}">
                                    <td>{{$productos[$i]->category->nombre}}</td>
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

                    <div class="product_buttons">
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







<!-- Lo mas visto -->


<div class="lomasvendidocontenedor">
    <div class="section_title text-center">Lo mas vendido</div>
    <br>
    <div class="lomasvendido owl-carousel owl-theme">

        <!-- item-->

        <div class="">
            <div class="product">
                <div class="product_image"><img src="{{ asset('asset/images/product_5.jpg') }}" alt="">
                </div>
                <div class="product_content">
                    <div class="product_info d-flex flex-row align-items-start justify-content-start">
                        <div>
                            <div>
                                <div class="product_name"><a href="product.html">Cool Clothing with Brown
                                        Stripes</a></div>

                            </div>
                        </div>
                        <div class="ml-auto text-right">
                            <div class="product_category">In <a href="category.html">Category</a></div>
                            <div class="product_price text-right">$3<span>.99</span></div>
                        </div>
                    </div>
                    <div class="product_buttons">
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

        <!-- item-->
        <div class="item">
            <div class="">
                <div class="product">
                    <div class="product_image"><img src="{{ asset('asset/images/product_6.jpg') }}" alt="">
                    </div>
                    <div class="product_content">
                        <div class="product_info d-flex flex-row align-items-start justify-content-start">
                            <div>
                                <div>
                                    <div class="product_name"><a href="product.html">Cool Clothing with Brown
                                            Stripes</a></div>

                                </div>
                            </div>
                            <div class="ml-auto text-right">
                                <div class="product_category">In <a href="category.html">Category</a></div>
                                <div class="product_price text-right">$3<span>.99</span></div>
                            </div>
                        </div>
                        <div class="product_buttons">
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

        </div>

        <div class="">
            <div class="row load_more_row">
                <div class="col">
                    <div class="button load_more ml-auto mr-auto" style="margin-top: 50%"><a
                            href="#">{{__('See All')}}</a>
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
    <div class="section_title text-center">En oferta</div>
    <br>
    <div class="lomasvendido owl-carousel owl-theme">

        <!-- item-->

        @foreach ($productos as $producto)

        @if ($producto->estado == 'En Oferta')

        <div class="">
            <div class="product">

                <span class="badge-offer"><b> - {{$producto->porcentaje_descuento}}%</b></span>
                <span class="badge-new"><b> {{$producto->estado}} </b></span>

                @if ($producto->images->count() <= 0) <div class="product_image">
                    <img class="img-thumbnail" src="/imagenes/boxed-bg.jpg" alt="">
            </div>
            @else
            <div class="product_image">
                <img class="img-thumbnail" src="{{$producto->images->random()->url}}" alt="">
            </div>
            @endif

            <div class="product_content">
                <div class="product_info">
                    <div>
                        <div>
                            <div class="product_name product_namesinwidth text-center" data-toggle="tooltip"
                                data-placement="top" title="" data-original-title="{{$producto->nombre}}"><a
                                    href="product.html/{{$producto->slug}}">{{\Illuminate\Support\Str::limit($producto->nombre ?? '',20,' ...')}}</a>
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
                <div class="product_buttons">
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


<!-- Boxes -->

<div class="boxes">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="boxes_container d-flex flex-row align-items-start justify-content-between flex-wrap">

                    <!-- Box -->
                    <div class="box">
                        <div class="background_image"
                            style="background-image:url({{ asset('asset/images/box_1.jpg') }})"></div>
                        <div class="box_content d-flex flex-row align-items-center justify-content-start">
                            <div class="box_left">
                                <div class="box_image">
                                    <a href="category.html">
                                        <div class="background_image"
                                            style="background-image:url({{ asset('asset/images/box_1_img.jpg') }})">
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="box_right text-center">
                                <div class="box_title">Trendsetter Collection</div>
                            </div>
                        </div>
                    </div>

                    <!-- Box -->
                    <div class="box">
                        <div class="background_image"
                            style="background-image:url({{ asset('asset/images/box_2.jpg') }})"></div>
                        <div class="box_content d-flex flex-row align-items-center justify-content-start">
                            <div class="box_left">
                                <div class="box_image">
                                    <a href="category.html">
                                        <div class="background_image"
                                            style="background-image:url({{ asset('asset/images/box_2_img.jpg') }})">
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="box_right text-center">
                                <div class="box_title">Popular Choice</div>
                            </div>
                        </div>
                    </div>

                    <!-- Box -->
                    <div class="box">
                        <div class="background_image"
                            style="background-image:url({{ asset('asset/images/box_3.jpg') }})"></div>
                        <div class="box_content d-flex flex-row align-items-center justify-content-start">
                            <div class="box_left">
                                <div class="box_image">
                                    <a href="category.html">
                                        <div class="background_image"
                                            style="background-image:url({{ asset('asset/images/box_3_img.jpg') }})">
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="box_right text-center">
                                <div class="box_title">Popular Choice</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

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
                        <div class="feature_title">Pagos rápidos y seguros</div>
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
                        <div class="feature_title">Productos de calidad</div>
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
                        <div class="feature_title">Entrega gratis después de $100</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


@endsection