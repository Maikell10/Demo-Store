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

    .direct-chat-messages::-webkit-scrollbar {
        width: 10px;
    }

    /* Estilos barra (thumb) de scroll */
    .direct-chat-messages::-webkit-scrollbar-thumb {
        background: #4bc57d;
        border-radius: 4px;
    }

    .direct-chat-messages::-webkit-scrollbar-thumb:hover {
        background: #4d8b05;
        box-shadow: 0 0 2px 1px rgba(0, 0, 0, 0.2);
    }

    /* Estilos track de scroll */
    .direct-chat-messages::-webkit-scrollbar-track {
        background: rgb(190, 189, 189);
        border-radius: 4px;
    }

    .direct-chat-messages::-webkit-scrollbar-track:hover,
    .direct-chat-messages::-webkit-scrollbar-track:active {
        background: rgb(153, 152, 152);
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

@include('custom.modal_rating_p')

@php
$cantidad_p = 0;
$total_p = 0;
$indice = 0;
@endphp

<div class="super_container_inner" id="appTienda">
    <span id="inicio"></span>
    <input type="text" value="{{config('app.locale')}}" id="lang" hidden>

    <div class="products">
        <div class="container-fluid">
            <img class="home__image" src="{{asset('asset/images/banner.jpg')}}" alt="" />


            <h1 class="home_subtitle font-weight-bold mt-2 mb-5"><i
                    class="nav-icon fas fa-shopping-bag text-success"></i>
                {{__('Purchases')}}
            </h1>

            @if($sales != '[]')

            <div class="row m-0">
                <div class="col-md-3">

                    <!-- Nº Order Card -->
                    <div class="card card-success card-outline">
                        <div class="card-body box-profile">

                            <h3 class="profile-username text-center">{{__('Order Nº:')}}</h3>
                            <!-- dia año / dia mes / año / hora / minutos / segundos -->
                            <h3 class="profile-username text-center text-muted">
                                {{strftime("%j%d%G-%H%M%S", strtotime($sales[0]->created_at) . $sales[0]->user_id )}}
                            </h3>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    
                    <!-- Rating Purchase -->
                    <div class="card card-success card-outline">
                        <div class="card-body box-profile text-center">
                            
                            @php
                                $count = 0;
                            @endphp
                            @foreach ($sales as $sale)
                            @php
                                $user_store = App\User::where('id', $sale->store_id)->get();
                            @endphp
                            @if (\App\RatingStore::where('created_sale', $id)->where('store_user_id', $user_store[0]->id)->get() == '[]')
                                @php
                                    $count = $count +1;
                                @endphp
                            @endif
                            @endforeach

                            @if ($count != 0)
                            <a href="#" role="button" data-toggle="modal" data-target="#ratingPModal" class="btn btn-outline-success" style="white-space: break-spaces;"><i class="fas fa-star"></i> {{__('Rate the Purchase:')}} <i class="fas fa-star"></i></a>

                            @else
                            <h5>{{__('You have already rated everything Thank you!')}} <i class="fas fa-smile text-success"></i></h5>
                            @endif

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>

                <div class="col-md-9">
                    <div class="card card-success card-outline">
                        <div class="card-body">

                            <!-- Post -->
                            <div class="post">
                                <div class="user-block">
                                    @if (auth()->user()->social_image() != 'no hay img')
                                    <img src="{{auth()->user()->social_image()}}"
                                        class="img-circle img-bordered-sm elevation-2" alt="User Image"
                                        style="max-height: 40px; width: 40px; object-fit: cover">
                                    @else
                                    @if (isset(Auth::user()->image->url))
                                    <img src="{{ Auth::user()->image->url }}"
                                        class="img-circle img-bordered-sm elevation-2" alt="User Image"
                                        style="max-height: 40px; width: 40px; object-fit: cover">
                                    @else
                                    <img src="{{ asset('adminlte/dist/img/avatardefault.png') }}"
                                        class="img-circle img-bordered-sm elevation-2" alt="User Image">
                                    @endif
                                    @endif

                                    <span class="username">
                                        <a href="#">{{ Auth::user()->name }}</a>
                                    </span>
                                    <span class="description">{{__('You Ordered:')}}
                                        {{ \Carbon\Carbon::parse($sales[0]->created_at)->diffForHumans() }}</span>
                                </div>
                                <!-- /.user-block -->
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="text-center">
                                            <tr>
                                                <th>{{__('Product')}}</th>
                                                <th>{{__('Seller')}}</th>
                                                <th>{{__('Unit Price')}}</th>
                                                <th>{{__('Quantity')}}</th>
                                                <th>{{__('Price')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $total = 0;
                                            @endphp
                                            @foreach ($sales as $sale)
                                            <tr>
                                                <td><a class="text-success"
                                                        href="{{ url('store/show-product/'.$sale->products->slug.'') }}">{{$sale->products->nombre}}</a>
                                                </td>

                                                <td><a class="text-success"
                                                        href="{{ url('commerce/'.$sale->name.'') }}">{{$sale->name}}</a>
                                                </td>

                                                <td class="text-right">{{ number_format($sale->price_sale,2) }}</td>
                                                <td class="text-center">{{$sale->cantidad}}</td>
                                                <td class="text-right">
                                                    {{ number_format($sale->price_sale * $sale->cantidad,2) }}</td>
                                            </tr>

                                            @php
                                            $total = $total + ($sale->price_sale * $sale->cantidad);
                                            @endphp
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="4" class="text-uppercase">Total</th>
                                                <th class="text-right">{{ number_format($total,2) }}</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!-- /.post -->




                        </div><!-- /.card-body -->
                    </div>
                </div>
            </div>

            <div class="row m-0">
                <div class="col-md-3">
                    <div class="nav flex-column">
                        <h3 class="font-weight-bold">{{__('Direct Messages')}}</h3>
                    </div>
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                        <a class="nav-link active h5" id="v-pills-{{$distinct_seller[0]->id}}-tab" data-toggle="pill"
                            href="#v-pills-{{$distinct_seller[0]->id}}" role="tab"
                            aria-controls="v-pills-{{$distinct_seller[0]->id}}"
                            aria-selected="true">{{$distinct_seller[0]->name}}</a>

                        @for ($i = 1; $i < count($distinct_seller); $i++) <a class="nav-link h5"
                        id="v-pills-{{$distinct_seller[$i]->id}}-tab" data-toggle="pill"
                        href="#v-pills-{{$distinct_seller[$i]->id}}" role="tab"
                        aria-controls="v-pills-{{$distinct_seller[$i]->id}}" aria-selected="false">
                        {{$distinct_seller[$i]->name}}</a>
                        @endfor

                    </div>
                </div>

                <div class="col-md-9 mt-4">
                    <!-- Direct Messages -->
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-{{$distinct_seller[0]->id}}" role="tabpanel"
                            aria-labelledby="v-pills-{{$distinct_seller[0]->id}}-tab">
                                <div class="card card-success card-outline direct-chat direct-chat-success">
                                    <div class="card-header">

                                        @if ($distinct_seller[0]->verified == 1)
                                            <h3 class="card-title">{{__('Direct Messages with:')}} <font class="text-success font-weight-bold">{{$distinct_seller[0]->name}}</font> <img src="{{asset('asset/images/verified-account.png')}}" style="width: 30px" data-toggle="tooltip" data-placement="right" title="{{ __('Verified') }}" /></h3>
                                        @else
                                            <h3 class="card-title">{{__('Direct Messages with:')}} <font class="text-success font-weight-bold">{{$distinct_seller[0]->name}}</font></h3>
                                        @endif

                                        <div class="card-tools">
                                            @if ($cant_d_messages_new != 0)
                                            <span data-toggle="tooltip" title="{{__('New Messages')}}" class="badge bg-danger">!</span>
                                            @endif
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                    class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <!-- Conversations are loaded here -->
                                        <div class="direct-chat-messages">
                                            @foreach ($d_messages as $d_message)
                                            @if ($d_message->type == 'CLIENT')
                                            @php
                                                $store_user = App\User::where('id',$d_message->store_user_id)->get()[0];
                                            @endphp
                                            <!-- Message. Default to the left -->
                                            <div class="direct-chat-msg right">
                                                <div class="direct-chat-infos clearfix">
                                                    <span class="direct-chat-name float-right">{{Auth::user()->name}}</span>
                                                    <span
                                                        class="direct-chat-timestamp float-left">{{ \Carbon\Carbon::parse($d_message->created_at)->diffForHumans() }}</span>
                                                </div>
                                                <!-- /.direct-chat-infos -->

                                                @if (auth()->user()->social_image() != 'no hay img')
                                                <img src="{{auth()->user()->social_image()}}" class="direct-chat-img elevation-2"
                                                    alt="User Image" style="height: 40px; width: 40px; object-fit: cover">
                                                @else
                                                @if (isset(Auth::user()->image->url))
                                                <img src="{{ Auth::user()->image->url }}" class="direct-chat-img elevation-2"
                                                    alt="User Image" style="height: 40px; width: 40px; object-fit: cover">
                                                @else
                                                <img src="{{ asset('adminlte/dist/img/avatardefault.png') }}"
                                                    class="direct-chat-img elevation-2" alt="User Image">
                                                @endif
                                                @endif

                                                <!-- /.direct-chat-img -->
                                                <div class="direct-chat-text">
                                                    {{$d_message->body}}
                                                </div>
                                                <!-- /.direct-chat-text -->
                                            </div>
                                            <!-- /.direct-chat-msg -->
                                            @else
                                            <!-- Message to the right -->
                                            <div class="direct-chat-msg">
                                                <div class="direct-chat-infos clearfix">
                                                    <span class="direct-chat-name float-left">{{ $store_user->name }}</span>
                                                    <span
                                                        class="direct-chat-timestamp float-right">{{ \Carbon\Carbon::parse($d_message->created_at)->diffForHumans() }}</span>
                                                </div>
                                                <!-- /.direct-chat-infos -->

                                                @if ($store_user->social_image() != 'no hay img')
                                                <img src="{{$store_user->social_image()}}" class="direct-chat-img elevation-2"
                                                    alt="User Image" style="max-height: 40px; width: 40px; object-fit: cover">
                                                @else
                                                @if (isset($store_user->image->url))
                                                <img src="{{ $store_user->image->url }}" class="direct-chat-img elevation-2"
                                                    alt="User Image" style="max-height: 40px; width: 40px; object-fit: cover">
                                                @else
                                                <img src="{{ asset('adminlte/dist/img/avatardefault.png') }}"
                                                    class="direct-chat-img elevation-2" alt="User Image">
                                                @endif
                                                @endif

                                                <!-- /.direct-chat-img -->
                                                <div class="direct-chat-text">
                                                    {{$d_message->body}}
                                                </div>
                                                <!-- /.direct-chat-text -->
                                            </div>
                                            @endif
                                            @endforeach

                                            <span id="final"></span>
                                            <!-- /.direct-chat-msg -->
                                        </div>
                                        <!--/.direct-chat-messages-->
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <form id="form0">
                                            <div class="input-group">
                                                <input type="hidden"
                                                    value="{{strftime("%j%d%G-%H%M%S", strtotime($sales[0]->created_at) . $sales[0]->user_id )}}"
                                                    id="order_id_dm" name="order_id_dm">
                                                <input type="hidden" value="{{Auth::user()->id}}" id="user_id_dm" name="user_id_dm">
                                                <input type="hidden" value="{{$distinct_seller[0]->id}}" id="store_user_id_dm"
                                                    name="store_user_id_dm">
                                                <input type="hidden" value="CLIENT" id="type_dm" name="type_dm">
                                                <input type="hidden" value="{{$sales[0]->updated_at}}" id="date_order"
                                                    name="date_order">

                                                <textarea class="form-control" placeholder="{{__('Type Message...')}}" id="direct_m"
                                                    rows="2" v-model="direct_m"></textarea>
                                                <span class="input-group-append">
                                                    <button v-on:click.prevent="setDirectM(0)" type="submit"
                                                        class="btn btn-success font-weight-bold">{{ __('Send') }}</button>
                                                </span>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.card-footer-->
                                </div>
                        </div>

                        @for ($i = 1; $i < count($distinct_seller); $i++) 
                        <div class="tab-pane fade" id="v-pills-{{$distinct_seller[$i]->id}}" role="tabpanel" aria-labelledby="v-pills-{{$distinct_seller[$i]->id}}-tab">

                            <div class="card card-success card-outline direct-chat direct-chat-success">
                                <div class="card-header">
                                    <h3 class="card-title">{{__('Direct Messages whit:')}} <font class="text-success font-weight-bold">{{$distinct_seller[$i]->name}}</font></h3>

                                    <div class="card-tools">
                                        @if ($cant_d_messages_new != 0)
                                        <span data-toggle="tooltip" title="{{__('New Messages')}}" class="badge bg-danger">!</span>
                                        @endif
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <!-- Conversations are loaded here -->
                                    <div class="direct-chat-messages">
                                        @php
                                            $d_messages = App\DirectMessages::where('order_id', $order_id)->where('store_user_id',$distinct_seller[$i]->id)->orderBy('created_at', 'asc')->get();
                                        @endphp
                                        @foreach ($d_messages as $d_message)
                                        @if ($d_message->type == 'CLIENT')
                                        @php
                                            $store_user = App\User::where('id',$d_message->store_user_id)->get()[0];
                                        @endphp
                                        <!-- Message. Default to the left -->
                                        <div class="direct-chat-msg right">
                                            <div class="direct-chat-infos clearfix">
                                                <span class="direct-chat-name float-right">{{Auth::user()->name}}</span>
                                                <span
                                                    class="direct-chat-timestamp float-left">{{ \Carbon\Carbon::parse($d_message->created_at)->diffForHumans() }}</span>
                                            </div>
                                            <!-- /.direct-chat-infos -->

                                            @if (auth()->user()->social_image() != 'no hay img')
                                            <img src="{{auth()->user()->social_image()}}" class="direct-chat-img elevation-2"
                                                alt="User Image" style="height: 40px; width: 40px; object-fit: cover">
                                            @else
                                            @if (isset(Auth::user()->image->url))
                                            <img src="{{ Auth::user()->image->url }}" class="direct-chat-img elevation-2"
                                                alt="User Image" style="height: 40px; width: 40px; object-fit: cover">
                                            @else
                                            <img src="{{ asset('adminlte/dist/img/avatardefault.png') }}"
                                                class="direct-chat-img elevation-2" alt="User Image">
                                            @endif
                                            @endif

                                            <!-- /.direct-chat-img -->
                                            <div class="direct-chat-text">
                                                {{$d_message->body}}
                                            </div>
                                            <!-- /.direct-chat-text -->
                                        </div>
                                        <!-- /.direct-chat-msg -->
                                        @else
                                        <!-- Message to the right -->
                                        <div class="direct-chat-msg">
                                            <div class="direct-chat-infos clearfix">
                                                <span class="direct-chat-name float-left">{{ $store_user->name }}</span>
                                                <span
                                                    class="direct-chat-timestamp float-right">{{ \Carbon\Carbon::parse($d_message->created_at)->diffForHumans() }}</span>
                                            </div>
                                            <!-- /.direct-chat-infos -->

                                            @if ($store_user->social_image() != 'no hay img')
                                            <img src="{{$store_user->social_image()}}" class="direct-chat-img elevation-2"
                                                alt="User Image" style="max-height: 40px; width: 40px; object-fit: cover">
                                            @else
                                            @if (isset($store_user->image->url))
                                            <img src="{{ $store_user->image->url }}" class="direct-chat-img elevation-2"
                                                alt="User Image" style="max-height: 40px; width: 40px; object-fit: cover">
                                            @else
                                            <img src="{{ asset('adminlte/dist/img/avatardefault.png') }}"
                                                class="direct-chat-img elevation-2" alt="User Image">
                                            @endif
                                            @endif

                                            <!-- /.direct-chat-img -->
                                            <div class="direct-chat-text">
                                                {{$d_message->body}}
                                            </div>
                                            <!-- /.direct-chat-text -->
                                        </div>
                                        @endif
                                        @endforeach

                                        <span id="final"></span>
                                        <!-- /.direct-chat-msg -->
                                    </div>
                                    <!--/.direct-chat-messages-->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <form id="form{{$i}}">
                                        <div class="input-group">
                                            <input type="hidden"
                                                value="{{strftime("%j%d%G-%H%M%S", strtotime($sales[0]->created_at) . $sales[0]->user_id )}}"
                                                id="order_id_dm" name="order_id_dm">
                                            <input type="hidden" value="{{Auth::user()->id}}" id="user_id_dm" name="user_id_dm">
                                            <input type="hidden" value="{{$distinct_seller[$i]->id}}" id="store_user_id_dm"
                                                name="store_user_id_dm">
                                            <input type="hidden" value="CLIENT" id="type_dm" name="type_dm">
                                            <input type="hidden" value="{{$sales[0]->updated_at}}" id="date_order"
                                                name="date_order">
        
                                            <textarea class="form-control" placeholder="{{__('Type Message...')}}" id="direct_m"
                                                rows="2" v-model="direct_m"></textarea>
                                            <span class="input-group-append">
                                                <button v-on:click.prevent="setDirectM({{$i}})" type="submit"
                                                    class="btn btn-success font-weight-bold">{{ __('Send') }}</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card-footer-->
                            </div>
                            
                        </div>
                        @endfor
                    </div>
                    <!--/.direct-chat -->
                </div>
            </div>


            @else

            <h3 class="font-weight-bold mt-2 mb-5 text-danger text-center"><i
                    class="nav-icon fas fa-warning text-warning"></i>
                La orden no existe vuelva a realizar la búsqueda
            </h3>

            @endif



        </div>

    </div>

</div>

@endsection