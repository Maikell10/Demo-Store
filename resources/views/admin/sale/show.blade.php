@extends('plantilla.admin')

@section('titulo',__('See Sale'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.sale.index')}}">{{__('Sales Administration')}}</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('scripts')
<script>
    $('#slidSale>a').addClass('active');

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
                                {{__('Sold:')}} <font class="font-weight-bold">{{date("Y/m/d", strtotime($sales[0]->updated_at))}} {{date("h:i:s a", strtotime($sales[0]->updated_at))}}</font>
                            @else
                                {{__('Sold:')}} <font class="font-weight-bold">{{date("d/m/Y", strtotime($sales[0]->updated_at))}} {{date("h:i:s a", strtotime($sales[0]->updated_at))}}</font>
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

        
    </div>
</div>

@endsection