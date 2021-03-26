@extends('plantilla.admin')

@section('titulo', __('See Purchase'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.shopping.index')}}">{{__('Purchases')}}</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('scripts')
<script>
    $('#slidShopp').addClass('menu-open');
    $('#slidShopp>a').addClass('active');
</script>
@endsection

@section('contenido')

<div class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-success card-outline">

                    <div class="card-header">
                        <h3 class="card-title">{{ __('Purchases Section') }}</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="container-fluid">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="provider_id">{{__('Provider')}}</label>
                                            <input readonly class="form-control" type="text" name="provider_id" id="provider_id" value="{{$purchase->provider->name}}">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="number">{{__('Date')}}</label>

                                            <div class="input-group">
                                                <div class="input-group date" id="reservationdate"
                                                    data-target-input="nearest">
                                                    <input readonly class="form-control" type="text" name="date" id="date" value="{{ \Carbon\Carbon::parse($purchase->date)->format('d-m-Y') }}">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="serie">Serie</label>
                                            <input readonly class="form-control" type="text" name="serie" id="serie" value="{{$purchase->serie}}">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="number">{{__('Number')}}</label>
                                            <input readonly class="form-control" type="text" name="number" id="number" value="{{$purchase->number}}">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tax">{{__('Tax')}} (%)</label>
                                            <input readonly class="form-control" type="text" name="tax" id="tax" value="{{$purchase->tax}}">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="number">% {{__('Profit')}}</label>
                                            <input readonly class="form-control" type="text" name="ganancia" id="ganancia" value="{{$purchase->profit}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12 col-md-12 col-xs-12 table-responsive mt-3" >

                                    
                                    <table id="detalles"
                                        class="table table-striped table-bordered table-condensed table-hover">
                                        <thead class="bg-green">
                                            <tr class="text-center">
                                                <th>Articulo</th>
                                                <th>Cantidad</th>
                                                <th>Precio Compra</th>
                                                <th>Precio Venta</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $totalT = 0;
                                            @endphp
                                            @foreach ($purchase_details as $purchase_detail)
                                            @php
                                                $subtotal = $purchase_detail->price_purchase * $purchase_detail->cant;
                                                $totalT = $totalT + $subtotal;
                                            @endphp
                                            <tr class="text-center">
                                                <td class="align-middle">{{$purchase_detail->product->nombre}}</td>
                                                <td class="align-middle">{{number_format($purchase_detail->cant,2)}}</td>
                                                <td class="align-middle">{{number_format($purchase_detail->price_purchase,2)}}</td>
                                                <td class="align-middle">{{number_format($purchase_detail->price_sell,2)}}</td>
                                                <td class="align-middle">{{number_format($subtotal,2)}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr class="text-center">
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th>{{__('Tax')}}</th>
                                                <th>
                                                <h5 id="taxs">$ {{ number_format((($purchase->tax * $totalT)/100),2) }}</h5>
                                                </th>
                                            </tr>
                                            <tr class="text-center">
                                                <th>TOTAL</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th>
                                                    <h4 id="total">$ {{ number_format($purchase->total,2) }}</h4>
                                                </th>
                                            </tr>
                                        </tfoot>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <a href="{{route('cancelar','admin.shopping.index')}}" class="btn btn-danger">{{__('Cancel')}}</a>

                        <a href="{{route('admin.shopping.edit',$purchase->id)}}" class="btn btn-outline-success float-right">{{__('Edit')}}</a>
                    </div>

                </div><!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

@endsection