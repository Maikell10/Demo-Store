@extends('plantilla.admin')

@section('titulo',__('See Order'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.order.index')}}">{{__('Orders Administration')}}</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('scripts')
<script>
    $('#slidOrder>a').addClass('active');

    $(function () {
        //Initialize Select2 Elements
        $('#statusC').select2();
    });
</script>
@endsection

@section('contenido')

@include('custom.modal_rating_store')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <!-- applocate for use in javascript -->
                <input type="text" value="{{session('applocate')}}" hidden id="applocate">

                <div class="card card-success card-outline">
                    <div class="card-header">
                        <h2 class="card-title">{{__('Order Nº:')}} <font class="font-weight-bold">
                                {{strftime("%j%d%G-%H%M%S", strtotime($sales[0]->created_at) . $sales[0]->user_id )}}
                            </font>
                        </h2>
                        <h3 class="card-title float-right">
                            @if (session('applocate') == 'en')
                                {{__('Ordered:')}} <font class="font-weight-bold">{{date("Y/m/d", strtotime($sales[0]->created_at))}} {{date("h:i:s a", strtotime($sales[0]->created_at))}}</font>
                            @else
                                {{__('Ordered:')}} <font class="font-weight-bold">{{date("d/m/Y", strtotime($sales[0]->created_at))}} {{date("h:i:s a", strtotime($sales[0]->created_at))}}</font>
                            @endif
                        </h3>

                        @if ($rating_user != '[]')
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 class="card-title mt-2"><i class="fas fa-check text-success"></i> {{__('Rated Sale')}}</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    @if ($rating_user[0]['rating'] == '-')
                                        <h2 class="card-title mt-2">{{__('Rating:')}} <font class="font-weight-bold">{{__('Negative')}}</font></h2>
                                    @else
                                        <h2 class="card-title mt-2">{{__('Rating:')}} <font class="font-weight-bold">{{__('Positive')}}</font></h2>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <h2 class="card-title mt-2">{{__('Opinion:')}} <font class="font-weight-bold">{{$rating_user[0]['opinion']}}</font></h2>
                                </div>
                            </div>

                            @if ($rating_store == '[]')
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <a href="#" role="button" data-toggle="modal" data-target="#ratingSModal" class="btn btn-outline-success" style="white-space: break-spaces;"><i class="fas fa-star"></i> {{__('Rate the Buyer')}} <i class="fas fa-star"></i></a>
                                    </div>
                                </div>
                            @else
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 class="card-title mt-2"><i class="fas fa-user-check text-success"></i> {{__('Your Rating to the Buyer')}}</h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        @if ($rating_store[0]['rating'] == '-')
                                            <h2 class="card-title mt-2">{{__('Your Rating:')}} <font class="font-weight-bold">{{__('Negative')}}</font></h2>
                                        @else
                                            <h2 class="card-title mt-2">{{__('Your Rating:')}} <font class="font-weight-bold">{{__('Positive')}}</font></h2>
                                        @endif
                                    </div>
                                    <div class="col-md-10">
                                        <h2 class="card-title mt-2">{{__('Your Opinion:')}} <font class="font-weight-bold">{{$rating_store[0]['opinion']}}</font></h2>
                                    </div>
                                </div>
                            @endif
                            
                        @endif
                    </div>

                    <div class="card-body">

                        <!-- Post -->
                        <div class="post">
                            <div class="user-block">
                                @if ($user[0]->social_image() != 'no hay img')
                                <img src="{{$user[0]->social_image()}}" class="img-circle img-bordered-sm elevation-2"
                                    alt="User Image" style="max-height: 40px; width: 40px; object-fit: cover">
                                @else
                                @if (isset($user[0]->image->url))
                                <img src="{{ $user[0]->image->url }}" class="img-circle img-bordered-sm elevation-2"
                                    alt="User Image" style="max-height: 40px; width: 40px; object-fit: cover">
                                @else
                                <img src="{{ asset('adminlte/dist/img/avatardefault.png') }}"
                                    class="img-circle img-bordered-sm elevation-2" alt="User Image">
                                @endif
                                @endif

                                <span class="username">
                                    <a href="#">{{ $user[0]->name }}</a>
                                </span>
                                <span class="description">{{__('Ordered:')}}
                                    {{ \Carbon\Carbon::parse($sales[0]->created_at)->diffForHumans() }}</span>
                            </div>
                            <!-- /.user-block -->
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="text-center">
                                        <tr>
                                            <th>{{__('Status')}}</th>
                                            <th>{{__('Product')}}</th>
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

                                            @if ($sale->state == 'Ordenado')
                                                <td class="align-middle"><span class="badge badge-warning">{{$sale->state}}</span></td>
                                            @endif
                                            @if ($sale->state == 'Pagado')
                                                <td class="align-middle"><span class="badge badge-primary">{{$sale->state}}</span></td>
                                            @endif
                                            @if ($sale->state == 'Entregado')
                                                <td class="align-middle"><span class="badge badge-secondary">{{$sale->state}}</span></td>
                                            @endif
                                            @if ($sale->state == 'Finalizada')
                                                <td class="align-middle"><span class="badge badge-success">{{$sale->state}}</span></td>
                                            @endif
                                            @if ($sale->state == 'Cancelada')
                                                <td class="align-middle"><span class="badge badge-danger">{{$sale->state}}</span></td>
                                            @endif

                                            <td><a class="text-success"
                                                    href="{{ url('store/show-product/'.$sale->products->slug.'') }}">{{$sale->products->nombre}}</a>
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
                                            <th></th>
                                            <th colspan="3" class="text-uppercase">Total</th>
                                            <th class="text-right">{{ number_format($total,2) }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- /.post -->

                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="api_direct_m">
            <div class="col-md-12">
                <!-- Direct Messages -->
                <div class="card card-success card-outline direct-chat direct-chat-success">
                    <div class="card-header">
                        <h3 class="card-title">{{__('Direct Messages')}}</h3>

                        <div class="card-tools">
                            @if ($cant_dm_new != 0)
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
                        <div class="direct-chat-messages" id="direct-chat-messages">

                            @foreach ($d_messages as $d_message)
                                @if ($d_message->type == 'CLIENT')
                                    <!-- Message. Default to the left -->
                                    <div class="direct-chat-msg">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-left">{{ $user[0]->name }}</span>
                                            <span class="direct-chat-timestamp float-right">{{ \Carbon\Carbon::parse($d_message->created_at)->diffForHumans() }}</span>
                                        </div>
                                        <!-- /.direct-chat-infos -->

                                        @if ($user[0]->social_image() != 'no hay img')
                                        <img src="{{$user[0]->social_image()}}" class="direct-chat-img elevation-2"
                                            alt="User Image" style="max-height: 40px; width: 40px; object-fit: cover">
                                        @else
                                        @if (isset($user[0]->image->url))
                                        <img src="{{ $user[0]->image->url }}" class="direct-chat-img elevation-2"
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
                                    <!-- /.direct-chat-msg -->
                                @else
                                    <!-- Message to the right -->
                                    <div class="direct-chat-msg right">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-right">{{Auth::user()->name}}</span>
                                            <span class="direct-chat-timestamp float-left">{{ \Carbon\Carbon::parse($d_message->created_at)->diffForHumans() }}</span>
                                        </div>
                                        <!-- /.direct-chat-infos -->

                                        @if (auth()->user()->social_image() != 'no hay img')
                                        <img src="{{auth()->user()->social_image()}}" class="direct-chat-img elevation-2" alt="User Image"
                                        style="height: 40px; width: 40px; object-fit: cover">
                                        @else
                                        @if (isset(Auth::user()->image->url))
                                        <img src="{{ Auth::user()->image->url }}" class="direct-chat-img elevation-2" alt="User Image"
                                            style="height: 40px; width: 40px; object-fit: cover">
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
                        <form>
                            <div class="input-group">
                                <input type="hidden" value="{{strftime("%j%d%G-%H%M%S", strtotime($sales[0]->created_at) . $sales[0]->user_id )}}" id="order_id_dm" name="order_id_dm">
                                <input type="hidden" value="{{$user[0]->id}}" id="user_id_dm" name="user_id_dm">
                                <input type="hidden" value="{{Auth::user()->id}}" id="store_user_id_dm" name="store_user_id_dm">
                                <input type="hidden" value="STORE" id="type_dm" name="type_dm">
                                <input type="hidden" value="{{$sales[0]->created_at}}" id="date_order" name="date_order">

                                <textarea class="form-control" placeholder="{{__('Type Message...')}}" id="direct_m" rows="2" v-model="direct_m"></textarea>
                                <span class="input-group-append">
                                    <button v-on:click.prevent="setDirectM()" type="submit" class="btn btn-success font-weight-bold">{{ __('Send') }}</button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-footer-->
                </div>
                <!--/.direct-chat -->
            </div>
        </div>
    </div>
</div>

@endsection