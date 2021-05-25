@extends('plantilla.admin')

@section('titulo', __('Edit Purchase'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.shopping.index')}}">{{__('Purchases')}}</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('scripts')
<!-- InputMask -->
<script src="{{ asset('adminlte/plugins/moment/moment-with-locales.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
</script>
<script>
    $('#slidShopp').addClass('menu-open');
    $('#slidShopp>a').addClass('active');

    $('#formCreate').submit(function(e) {
        e.preventDefault() ;
    })

    $('#submitButton').click(function() {
        document.formCreate.submit()
    })   
    
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();
        // Phone Mask
        $('[data-mask]').inputmask();

        //Date range picker
        $('#reservationdate').datetimepicker({
            format: 'DD-MM-YYYY',
            locale: moment.locale('es-us'),
            tooltips: {
                today: 'Hoy',
                clear: 'Limpiar Selección',
                close: 'Cerrar el picker',
                selectMonth: 'Seleccionar Mes',
                prevMonth: 'Mes Anterior',
                nextMonth: 'Mes Siguiente',
                selectYear: 'Seleccionar Año',
                prevYear: 'Año Anterior',
                nextYear: 'Año Siguiente',
                selectDecade: 'Seleccionar Década',
                prevDecade: 'Década Anterior',
                nextDecade: 'Década Siguiente',
                prevCentury: 'Siglo Anterior',
                nextCentury: 'Siglo Siguiente',
                selectDate: 'Seleccionar Fecha'
            },
        });

        $('#tblproductos').dataTable({
            dom: 'Bfrtip',//definimos los elementos del control de la tabla
            buttons: [

            ],
            "bDestroy":true,
            "iDisplayLength":5,//paginacion
            "order":[[0,"desc"]]//ordenar (columna, orden)
        }).DataTable();
    });
</script>
@endsection

@section('contenido')

@include('custom.modal_eliminar_purchase_detail')

<div class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-success card-outline">

                    <div class="card-header">
                        <h3 class="card-title">{{ __('Purchases Section') }}</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="{{__('Collapse')}}">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>

                    <form action="{{route('admin.shopping.update', $purchase->id)}}" method="POST" id="formCreate" name="formCreate">
                        @csrf
                        @method('PUT')


                    <div class="card-body" id="apishopping">
                        <div class="container-fluid">

                            <input type="hidden" name="editar" id="editar" value="{{$editar}}">
                            <input type="hidden" name="ganancia1" id="ganancia1" value="{{$purchase->profit}}">
                            <input type="hidden" name="number1" id="number1" value="{{$purchase->number}}">
                            <input type="hidden" name="serie1" id="serie1" value="{{$purchase->serie}}">
                            <input type="hidden" name="tax1" id="tax1" value="{{$purchase->tax}}">
                            <input type="hidden" name="date1" id="date1" value="{{ \Carbon\Carbon::parse($purchase->date)->format('d-m-Y') }}">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="provider_id">{{__('Provider')}}</label>
                                            <select class="form-control select2 select2-danger"
                                                data-dropdown-css-class="select2-success" style="width: 100%;"
                                                name="provider_id" id="provider_id">

                                                @foreach ($providers as $provider)
                                                @if ($provider->name == $purchase->provider->name)
                                                    <option value="{{$provider->id}}" selected>{{$provider->name}}</option>
                                                @else
                                                    <option value="{{$provider->id}}">{{$provider->name}}</option>
                                                @endif
                                                @endforeach
                                            </select>
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

                                                    <input type="text" class="form-control datetimepicker-input"
                                                            data-target="#reservationdate"
                                                            data-inputmask-alias="datetime"
                                                            data-inputmask-inputformat="dd-mm-yyyy" data-mask id="date"
                                                            name="date" v-model="date"/>

                                                    <div class="input-group-append" data-target="#reservationdate"
                                                            data-toggle="datetimepicker">
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
                                            <input class="form-control" type="text" name="serie" id="serie" v-model="serie">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="number">{{__('Number')}}</label>
                                            <input class="form-control" type="text" name="number" id="number" v-model="number">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tax">{{__('Tax')}} (%)</label>
                                            <input v-model="tax" class="form-control" type="text" name="tax" id="tax" v-on:keyup="giveTax()" v-on:change="giveTax()">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="number">% {{__('Profit')}}</label>
                                            <input v-model="ganancia" class="form-control" type="number" name="ganancia" id="ganancia" v-on:keyup="giveGanancia()" v-on:change="giveGanancia()">
                                        </div>
                                    </div>
                                </div>


                                <a href="#" class="btn btn-outline-success" data-toggle="modal"
                                        data-target="#productsModal">{{__('Add Product')}} <i
                                            class="fas fa-plus-circle"></i></a>

                                <div class="form-group col-lg-12 col-md-12 col-xs-12 table-responsive mt-3" >

                                    <input type="text" id="text_action" value="{{__('Action Canceled')}}" v-model="text" hidden>
                                    <input type="text" id="text_actionD" value="{{__('Product Deleted')}}" v-model="textDelete" hidden>

                                    <input type="hidden" id="products" name="products" v-model="productsSend" >
                                
                                    @include('custom.modal_products')

                                    <table id="detalles"
                                        class="table table-striped table-bordered table-condensed table-hover">
                                        <thead class="bg-green">
                                            <tr class="text-center">
                                                <th>Opciones</th>
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
                                                <td class="align-middle">
                                                    <span  data-toggle="tooltip" data-placement="bottom" title="{{ __('Delete Provider') }}">
                                                        <a href="{{route('admin.shopping.index')}}" data-toggle="modal" data-id="{{$purchase_detail->id}}" data-target="#modal_eliminar_purchase_detail" class="hover_zoom" ><i class="fas fa-times-circle fa-2x text-danger"></i></a>
                                                    </span>
                                                </td>
                                                <td class="align-middle">{{$purchase_detail->product->nombre}}</td>
                                                <td class="align-middle">{{number_format($purchase_detail->cant,2)}}</td>
                                                <td class="align-middle">{{number_format($purchase_detail->price_purchase,2)}}</td>
                                                <td class="align-middle">{{number_format($purchase_detail->price_sell,2)}}</td>
                                                <td class="align-middle">{{number_format($subtotal,2)}}</td>
                                            </tr>
                                            @endforeach

                                            <tr v-for="(product, index) in products" class="text-center">
                                                <td class="align-middle">
                                                    <button class="btn btn-primary btn-sm" v-bind:id="index" v-on:click="sumCant(index)"><span class="fa fa-plus"></span></button>
                                                    <button class="btn btn-danger btn-sm" v-bind:id="index" v-on:click="deleteCant(index)"><span class="fa fa-minus"></span></button>

                                                    <button class="btn btn-outline-secondary btn-sm" v-bind:id="index" v-on:click="deleteProd(index)"><span class="fa fa-trash-alt"></span></button>
                                                </td>
                                                <td class="align-middle">@{{ product.nombre }}</td>
                                                <td class="align-middle" v-bind:id="index">
                                                    <input type="number" v-model="product.cant" v-on:keyup="sumPrecioC(index)" v-on:change="sumPrecioC(index)" class="form-control text-center">
                                                </td>
                                                <td class="align-middle" v-bind:id="index">
                                                    <input type="number" v-model="precio_compra[index]" v-on:keyup="sumPrecioC(index)" v-on:change="sumPrecioC(index)" class="form-control text-center">
                                                </td>
                                                <td class="align-middle">@{{product.precio_venta}}</td>
                                                <td class="align-middle">@{{product.subtotal}}</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr class="text-center">
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th>{{__('Tax')}}</th>
                                                <th>
                                                    <h5 id="taxs">$ @{{taxs}}</h5>
                                                </th>
                                            </tr>
                                            <tr class="text-center">
                                                <th>TOTAL</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th>
                                                    <h4 id="total">$ @{{total_compra}}</h4><input type="hidden"
                                                            name="total_compra" id="total_compra" v-model="total_compraSF">
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>

                                    <input type="hidden" name="total1" id="total1" value="{{$totalT}}">
                                </div>

                            </div>
                        </div>
                    </div>

                    </form>

                    <div class="card-footer">
                        <a href="{{route('cancelar','admin.shopping.index')}}" class="btn btn-danger">{{__('Cancel')}}</a>

                        <input :disabled="deshabilitar_boton==1" type="submit" value="{{__('Save')}}"
                                class="btn btn-primary float-right" id="submitButton">
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