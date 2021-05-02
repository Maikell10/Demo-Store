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

            <div class="container-fluid">
                <h1 class="home_subtitle font-weight-bold mb-5"><i class="nav-icon fas fa-store text-success"></i> Tienda de
                    {{$user->name}}
                </h1>
                
                <div class="row">
                    <div class="col-md-4 col-xl-3">
                        <div class="card card-success card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    @if ($user->social_image() != 'no hay img')
                                    <img src="{{$user->social_image()}}" class="profile-user-img img-fluid img-circle elevation-2" alt="User Image"
                                    style="height: 100px; width: 100px; object-fit: cover">
                                    @else
                                    @if (isset($user->image->url))
                                    <img src="{{ $user->image->url }}" class="profile-user-img img-fluid img-circle elevation-2" alt="User Image"
                                        style="height: 100px; width: 100px; object-fit: cover">
                                    @else
                                    <img src="{{ asset('adminlte/dist/img/avatardefault.png') }}"
                                        class="profile-user-img img-fluid img-circle elevation-2" alt="User Image">
                                    @endif
                                    @endif
                                </div>

                                @if ($user->verified == 1)
                                    <h3 class="profile-username text-center">{{ $user->name }} <img src="{{asset('asset/images/verified-account.png')}}" style="width: 30px" data-toggle="tooltip" data-placement="right" title="{{ __('Verified') }}" /></h3>
                                @else
                                    <h3 class="profile-username text-center">{{ $user->name }}</h3>
                                @endif
                                

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>{{ __('Sales') }}</b> <a class="float-right">{{$sales_count}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>{{ __('Positive Ratings') }}</b> <a class="float-right">{{$positive_rating}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>{{ __('Neutral Ratings') }}</b> <a class="float-right">{{$neutral_rating}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>{{ __('Negative Ratings') }}</b> <a class="float-right">{{$negative_rating}}</a>
                                    </li>
                                </ul>

                                @if ($store_profile_config != '[]')
                                    @if ($store_profile_config[0]->contact_phone != null)
                                        <h5 class="text-center h6">{{__('Contact')}}: <a href="tel:{{$store_profile_config[0]->contact_phone}}" class="btn btn-link">{{$store_profile_config[0]->contact_phone}}</a></h5>
                                    @endif
                                @endif

                                @if ($store_profile_config != '[]')
                                @if ($store_profile_config[0]->facebook != null || $store_profile_config[0]->instagram != null || $store_profile_config[0]->twitter != null)
                                    <div class="menu_social">
                                        <ul
                                            class="menu_social_list d-flex flex-row align-items-center justify-content-center">

                                            @if ($store_profile_config[0]->facebook != null)
                                                <li><a href="{{$store_profile_config[0]->facebook}}" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                            @endif
                                            
                                            @if ($store_profile_config[0]->twitter != null)
                                                <li><a href="{{$store_profile_config[0]->twitter}}" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                            @endif
                                            
                                            @if ($store_profile_config[0]->instagram != null)
                                                <li><a href="{{$store_profile_config[0]->instagram}}" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                            @endif
                                        </ul>
                                        <h5 class="text-center h6 text-success font-weight-bold">Siguenos!!</h5>
                                    </div>
                                    <hr>
                                @endif
                                @endif


                                <h5 class="profile-username text-center h6">{{__('Joined to TuMiniMercado On:')}} <font class="font-weight-bold">{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</font></h5>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-8 col-xl-9">
                        
                        <div class="row row-cols-2 row-cols-md-2 row-cols-xl-4">
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
                                    <small class="text-muted">Ver todo en <a
                                            href="{{url('store/show-category/'.$producto->main_category->sub_category->category->slug.'')}}"
                                            class="text-success">{{$producto->main_category->sub_category->category->nombre}}</a></small>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>

                    <div class="d-flex flex-row-reverse">
                        <div class="float-right">
                            {{$productos->appends($_GET)->links()}}
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @if ($store_profile_config != '[]')
            @if ($store_profile_config[0]->gmaps != null)
                <hr>
                <div class="d-flex flex-row align-items-center justify-content-center">
                    <h5 class="h2 font-weight-bold">Ubícanos <img src="{{asset('asset/images/maps.png')}}" style="width: 30px" /></h5>
                </div>
                <div class="row">
                    <iframe src="{{$store_profile_config[0]->gmaps}}" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            @endif
        @endif

    </div>



</div>
</div>

@endsection