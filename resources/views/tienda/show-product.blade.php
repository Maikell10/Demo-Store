@extends('plantilla.tienda')

@if (isset($producto))
@section('titulo', $producto->nombre.' | '.__('See the Product').' | TuMiniMercado')
@else
@section('titulo', __('See All Products').' | TuMiniMercado')
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

    function addToCart(id) {
        $.ajax({
            type: "GET",
            data: $('#formAddToCart'+id).serialize(),
            url: "/store/cart/adde/" + id,
            success: function(res) {
                Swal.fire({
                    icon: 'success',
                    title: 'Agregado al Carrito!',
                    showConfirmButton: false,
                })
                
                window.setTimeout(function(){
                    location.reload();
                }, 500)
            }
        });
    };
</script>
@endsection


@section('contenido')

<div class="super_container_inner" id="apirating">

    <div class="products">
        @if (isset($producto))

        <div class="container">
            <a href="{{ url('store/show-category/'.$category->slug.'') }}"
                class="text-success">{{$category->nombre}}</a> <i class="nav-icon fas fa-arrow-right text-warning"></i>
            <a href="{{ url('store/show-sub-category/'.$producto->main_category->sub_category->slug.'') }}"
                class="text-success">{{$producto->main_category->sub_category->nombre}}</a> <i
                class="nav-icon fas fa-arrow-right text-warning"></i> <a
                href="{{ url('store/show-main-category/'.$producto->main_category->slug.'') }}"
                class="text-success">{{$producto->main_category->nombre}}</a>
        </div>

        <div class="container mt-3">

            <!------------- single product details ---------------->
            <div class="row">
                <div class="col-md-4">


                    @if ($producto->images->count() <= 0) <div class="product_image">
                        <img class="img-thumbnail" src="/imagenes/boxed-bg.jpg" alt="">
                </div>
                @else

                <a href="{{$producto->images[0]->url}}" data-toggle="lightbox" data-gallery="gallery"
                    style="cursor: zoom-in" id="ProductHref">
                    <img src="{{$producto->images[0]->url}}" width="100%" id="ProductImg">
                </a>

                <div class="small-img-row mt-2">
                    @foreach ($producto->images as $image)
                    <div class="small-img-col">
                        <img src="{{$image->url}}" width="100%" class="small-img img-thumbnail"
                            id="idimagen-{{$image->id}}">
                    </div>
                    @endforeach
                </div>

                @endif

            </div>
            <div class="col-md-8">
                <h1>{{$producto->nombre}}</h1>
                <span class="h5">
                    {{__('Visit to:')}} <a href="{{ url('commerce/'.$producto->users[0]->name.'') }}" class="text-success" data-toggle="tooltip" data-placement="top" title="Vendedor">{{$producto->users[0]->name}}</a>
                    @if ($producto->users[0]->verified == 1)
                        <img src="{{asset('asset/images/verified-account.png')}}" style="width: 30px" data-toggle="tooltip" data-placement="right" title="{{ __('Verified') }}" />
                    @endif
                </span>

                <!--
                <p class="h4" style="width: fit-content;" data-toggle="tooltip" data-placement="bottom"
                    title="{{ __('Rating of ') .''.$producto->users[0]->name }}">
                    <star-rating :inline="true" :read-only="true" :show-rating="false" :star-size="25"
                        v-model="totalrate" :increment="0.1" active-color="#ffed4a"></star-rating>
                </p>-->

                <hr>

                <H4>${{number_format($producto->precio_actual,2)}}
                    <del>${{number_format($producto->precio_anterior,2)}}</del></H4>

                @if ($producto->cantidad > 0)
                <h4 class="text-success">{{__('Available.')}}</h4>

                <div class="form-group" style="width: 160px;">
                    <form action="{{ url('/store/cart/adde/'.$producto->id.'') }}" method="POST"
                        id="formAddToCart{{$producto->id}}">
                        @csrf

                        <label>{{__('Quantity')}}</label>
                        <select name="cantidad" id="cantidad" class="form-control select2">
                            @for ($i = 1; $i <= $producto->cantidad; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                        </select>

                        <br>


                        <button onclick="addToCart({{$producto->id}})" type="button" class="btn btn-success">
                            {{ __('Add to Cart') }}<img class="svg svgP svgCart ml-0"
                                src="{{ asset('asset/images/cart.svg') }}" alt="Indent" style="width: 50px">
                        </button>
                    </form>
                </div>


                @else
                <h4 class="text-danger">{{__('Not available.')}}</h4>
                @endif



                <br>

                <h3>{{__('Product Details')}}
                    <img class="svg svgP ml-2" src="{{ asset('asset/images/indent-solid.svg') }}" alt="Indent"
                        style="width: 50px">
                </h3>

                <p>{!!$producto->descripcion_corta!!}</p>
            </div>

        </div>

        @if ($producto->especificaciones != '' || $producto->datos_de_interes != '' || $producto->descripcion_larga != '')
        <div class="card border-success mt-2">
            <div class="card-body">
                <h4>{{__('Specifications')}}</h4>
                <hr>
                <div class="overflow-auto">
                    <p>{!!$producto->especificaciones!!}</p>

                    @if ($producto->datos_de_interes != '')
                    <h5 class="font-weight-bold">{{__('Data of interest')}}</h5>
                    <p>{!!$producto->datos_de_interes!!}</p>
                    <hr>
                    @endif

                    @if ($producto->descripcion_larga != '')
                    <h5 class="font-weight-bold">{{__('Long description')}}</h5>
                    <p>{!!$producto->descripcion_larga!!}</p>
                    @endif
                </div>
            </div>
        </div>
        @endif

        <h3 class="mt-4">{{__('More Products of')}} {{$producto->users[0]->name}}</h3>
        <div class="lomasvendido owl-carousel owl-theme mb-3">

            <!-- item-->
            @if (count($productos_store) >= 4)
            @php
            $contador = 4;
            @endphp
            @else
            @php
            $contador = count($productos_store);
            @endphp
            @endif
    
            @for ($i = 0; $i < $contador; $i++) 
            <div class="item">
                <div class="product">
    
                    @if ($productos_store[$i]->estado == 'En Oferta')
                    <span class="badge-offer"><b> - {{$productos_store[$i]->porcentaje_descuento}}%</b></span>
                    <span class="badge-new"><b> {{$productos_store[$i]->estado}} </b></span>
                    @else
                    <span class="badge-new"><b> {{$productos_store[$i]->estado}} </b></span>
                    @endif
    
                    @if ($productos_store[$i]->images->count() <= 0) 
                    <div class="product_image" style="height: 300px">
                        <a href="{{ url('store/show-product/'.$productos_store[$i]->slug.'') }}">
                            <img class="img-thumbnail" src="/imagenes/boxed-bg.jpg" alt=""
                                style="object-fit: contain; height: 100%">
                        </a>
                    </div>
                    @else
                    <div class="product_image" style="height: 300px">
                        <a href="{{ url('store/show-product/'.$productos_store[$i]->slug.'') }}">
                            <img class="img-thumbnail" src="{{$productos_store[$i]->images->random()->url}}" alt=""
                                style="object-fit: contain; height: 100%">
                        </a>
                    </div>
                    @endif
    
                <div class="product_content">
                    <div class="product_info  align-items-start justify-content-start">
                        <div>
                            <div>
                                <div class="h6" data-toggle="tooltip" data-placement="top" title=""
                                    data-original-title="{{$productos_store[$i]->nombre}}">
                                    <a class="text-black-50" href="{{ url('store/show-product/'.$productos_store[$i]->slug.'') }}">{{\Illuminate\Support\Str::limit($productos_store[$i]->nombre ?? '',20,' ...')}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="ml-auto text-left">
                            <div class="product_price text-right">${{number_format($productos_store[$i]->precio_actual,2)}}</div>
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
                                href="{{ url('commerce/'.$producto->users[0]->name.'') }}">{{__('See All')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-success mt-2">
            <div class="card-body">

                @if (isset(Auth::user()->id) && $can_rate != '[]' && $rate_old == '[]')
                <h4 class="">{{ __('You can rate the product now and leave a review') }}</h4>
                <hr>
                <star-rating v-model="rating" :increment="0.5" text-class="custom-text"></star-rating>
                <div class="w-75 m-auto">
                    <textarea class="form-control text-center mt-2" placeholder="{{__('Write a review')}}" id="review_rating" rows="3"
                        v-model="review_rating"></textarea>
                </div>
                <div class="text-center mt-2 mb-2">
                    <button @click="setRating" class="btn btn-outline-success">{{ __('Publish') }}</button>
                </div>
                @endif

                @if (isset(Auth::user()->id) && $can_rate != '[]' && $rate_old != '[]')
                    <h4 class="">{{ __('You have already rated the product') }} <i class="nav-icon fas fa-check text-success"></i></h4>
                    <hr>
                @endif

                <input type="text" value="{{ !empty(Auth::user()->id) ? Auth::user()->id:'' }}" id="user_id_rating"
                    hidden>
                <input type="text" value="{{$producto->id}}" id="product_id_rating" hidden>

                <h4 class="">{{ __('Ratings of ').''.$producto->nombre }}</h4>
                <hr>

                <div class="row">
                    <div class="col-md-4">
                        <p class="text-center font-weight-bold display-1 mb-0" style="margin-top: -20px">
                            @{{ totalrate }}</p>
                        <p class="text-center h4">
                            <star-rating :inline="true" :read-only="true" :show-rating="false" :star-size="20"
                                v-model="totalrate" :increment="0.1" active-color="#ffed4a"></star-rating>
                        </p>
                        <p class="text-center h4">
                            <i class="nav-icon fas fa-users text-success"></i>
                            <small>@{{ totaluser }} Total</small>
                        </p>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col ">
                                <h5 class="p-0 text-right">5</h5>
                            </div>
                            <div class="col-10">
                                <div class="progress">
                                    <div class="progress-bar bg-success bar-5" role="progressbar" style="width: 0%"
                                        aria-valuemin="0" aria-valuemax="100">
                                        <p class="text-white font-weight-bold">@{{bar5}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col ">
                                <h5 class="p-0 text-right">4</h5>
                            </div>
                            <div class="col-10">
                                <div class="progress">
                                    <div class="progress-bar bg-lime bar-4" role="progressbar" style="width: 0%"
                                        aria-valuemin="0" aria-valuemax="100">
                                        <p class="text-muted font-weight-bold">@{{bar4}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col ">
                                <h5 class="p-0 text-right">3</h5>
                            </div>
                            <div class="col-10">
                                <div class="progress">
                                    <div class="progress-bar bg-warning bar-3" role="progressbar" style="width: 0%"
                                        aria-valuemin="0" aria-valuemax="100">
                                        <p class="text-muted font-weight-bold">@{{bar3}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col ">
                                <h5 class="p-0 text-right">2</h5>
                            </div>
                            <div class="col-10">
                                <div class="progress">
                                    <div class="progress-bar bg-orange bar-2" role="progressbar" style="width: 0%"
                                        aria-valuemin="0" aria-valuemax="100">
                                        <p class="text-white font-weight-bold">@{{bar2}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col ">
                                <h5 class="p-0 text-right">1</h5>
                            </div>
                            <div class="col-10">
                                <div class="progress">
                                    <div class="progress-bar bg-danger bar-1" role="progressbar" style="width: 0%"
                                        aria-valuemin="0" aria-valuemax="100">
                                        <p class="text-white font-weight-bold">@{{bar1}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="card border-success mt-2">
            <div class="card-body">
                <h4 class="">{{ __('Questions and answers') }}</h4>
                <hr>

                @if (isset(Auth::user()->id))
                <form>
                    <textarea class="form-control" placeholder="{{__('Write a question')}}" id="pregunta_prod" rows="3"
                        v-model="pregunta_prod"></textarea>
                    <button v-on:click.prevent="setComment()"
                        class="btn btn-outline-success btn-lg btn-block mb-2 mt-2 font-weight-bold">{{ __('Ask') }}</button>
                </form>
                <hr>
                @else
                <a href="{{url('login?pag=store/show-product/'. $producto->slug . '')}}" class="btn btn-warning btn-lg btn-block mb-2 mt-2 font-weight-bold" style="white-space: break-spaces">{{__('You must log in to ask')}}</a>
                <hr>
                @endif

                @if ($coments_auth_user == 1)
                    <h4 class="">{{ __('Your Questions') }}</h4>
                    <hr style="border: 3px solid #28a745">
                    <div style="background-color: honeydew">
                    @foreach ($comments as $comment)
                        @if ($comment['users']->id == auth()->user()->id)
                        @if ($comment['parent_id'] == null)
                        <div class="row p-2">
                            <div class="col-md-12 d-flex">
                                <img src="{{asset('asset/images/speech-bubble-with-dots.png')}}" width="40px"
                                    height="45px" class="mr-4" />
                                <div>
                                    <p class="text-justify" style="/*text-indent: 25px*/"><font class="font-weight-bold mr-2">{{$comment['users']->name}}</font>{{$comment['body']}}</p>
                                    <small>{{ \Carbon\Carbon::parse($comment['created_at'])->diffForHumans() }}</small>
                                    <small hidden>{{ \Carbon\Carbon::parse($comment['created_at'])->format('d/m/Y h:i:s a') }}</small>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        @isset($comment['answers'][0]['body'])
                        <div class="row p-3 ml-5">
                            <div class="col-md-12 d-flex">
                                <img src="{{asset('asset/images/speech-bubble-with-dots-answ.png')}}" width="35px"
                                    height="40px" class="mr-4" />
                                <div>
                                    <p class="text-muted text-justify"><font class="font-weight-bold mr-2 text-success">{{$producto->users[0]->name}}</font>{{$comment['answers'][0]['body']}}
                                    </p>
                                    <small>{{ \Carbon\Carbon::parse($comment['answers'][0]['created_at'])->diffForHumans() }}</small>
                                </div>
                            </div>
                        </div>
                        @endisset
                        @endif
                    @endforeach
                    </div>
                    <hr style="border: 3px solid #28a745">

                    @foreach ($comments as $comment)
                        @if ($comment['users']->id != auth()->user()->id)
                        @if ($comment['parent_id'] == null)
                        <div class="row p-2">
                            <div class="col-md-12 d-flex">
                                
                                <img src="{{asset('asset/images/speech-bubble-with-dots.png')}}" width="40px"
                                    height="45px" class="mr-4" />
                                <div>
                                    <p class="text-justify" style="/*text-indent: 25px*/"><font class="font-weight-bold mr-2">{{$comment['users']->name}}</font>{{$comment['body']}}</p>
                                    <small>{{ \Carbon\Carbon::parse($comment['created_at'])->diffForHumans() }}</small>
                                    <small hidden>{{ \Carbon\Carbon::parse($comment['created_at'])->format('d/m/Y h:i:s a') }}</small>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        @isset($comment['answers'][0]['body'])
                        <div class="row p-3 ml-5">
                            <div class="col-md-12 d-flex">
                                <img src="{{asset('asset/images/speech-bubble-with-dots-answ.png')}}" width="35px"
                                    height="40px" class="mr-4" />
                                <div>
                                    <p class="text-muted text-justify"><font class="font-weight-bold mr-2 text-success">{{$producto->users[0]->name}}</font>{{$comment['answers'][0]['body']}}
                                    </p>
                                    <small>{{ \Carbon\Carbon::parse($comment['answers'][0]['created_at'])->diffForHumans() }}</small>
                                </div>
                            </div>
                        </div>
                        @endisset
                        @endif
                    @endforeach
                @else
                    @foreach ($comments as $comment)

                    @if ($comment['parent_id'] == null)
                    <div class="row p-2">
                        <div class="col-md-12 d-flex">
                            <img src="{{asset('asset/images/speech-bubble-with-dots.png')}}" width="40px"
                                height="45px" class="mr-4" />
                            <div>
                                <p class="text-justify" style="/*text-indent: 25px*/"><font class="font-weight-bold mr-2">{{$comment['users']->name}}</font>{{$comment['body']}}</p>
                                <small>{{ \Carbon\Carbon::parse($comment['created_at'])->diffForHumans() }}</small>
                                <small hidden>{{ \Carbon\Carbon::parse($comment['created_at'])->format('d/m/Y h:i:s a') }}</small>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    @isset($comment['answers'][0]['body'])
                    <div class="row p-3 ml-5">
                        <div class="col-md-12 d-flex">
                            <img src="{{asset('asset/images/speech-bubble-with-dots-answ.png')}}" width="35px"
                                height="40px" class="mr-4" />
                            <div>
                                <p class="text-muted text-justify"><font class="font-weight-bold mr-2 text-success">{{$producto->users[0]->name}}</font>{{$comment['answers'][0]['body']}}
                                </p>
                                <small>{{ \Carbon\Carbon::parse($comment['answers'][0]['created_at'])->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>
                    @endisset
                    @endforeach
                @endif
                
            </div>
        </div>


    </div>
    @endif


    @if (isset($productos))
    <div class="container-fluid mt-3">

        <div class="row row-cols-1 row-cols-md-2">

            <div class="col-md-2"></div>
            <div class="col">
                <h1 class="font-weight-bold"><i class="nav-icon fas fa-shapes text-success"></i> {{__('All Products')}}
                </h1>
            </div>
            <div class="col align-content-end" hidden>
                <form class="">
                    <div class="input-group input-group float-right" style="width: 200px;">
                        <input type="text" name="nombre_producto" class="form-control float-right" placeholder="Buscar"
                            value="{{request()->get('nombre_producto')}}">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-outline-success"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-2 border-right">
                <h1>Filtros</h1>
            </div>
            <div class="col-md-10 row">

                @foreach ($productos as $producto)
    
                <div class="col-6 col-sm-4 col-md-4 col-lg-3 mb-4">
                    <a href="{{ url('store/show-product/'.$producto->slug.'') }}">
                        <div class="card border-success h-100">
    
                            @if ($producto->images->count() <= 0) 
                            <div class="product_image" style="height: 200px">
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
    
                            <div class="card-header h5 bg-transparent">
                                {{$producto->nombre}}
                            </div>
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
                                <small class="text-muted">{{__('See all in')}} <a href="{{url('store/show-category/'.$producto->main_category->sub_category->category->slug.'')}}" class="text-success">{{$producto->main_category->sub_category->category->nombre}}</a></small>
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
    @endif

</div>
</div>

@endsection