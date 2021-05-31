@extends('plantilla.admin')

@section('titulo',__('Products Administration'))

@section('breadcrumb')
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('estilos')
<style type="text/css">
    .table1 {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
        text-align: center;
    }

    .table1 td,
    .table1 th {
        padding: .75rem;
        vertical-align: center;
        border-top: 1px solid #dee2e6
    }

    tbody > tr > td:nth-child(1),
    tbody > tr > td:nth-child(3),
    tbody > tr > td:nth-child(4),
    tbody > tr > td:nth-child(5),
    tbody > tr > td:nth-child(6) {
        text-align: center;
        vertical-align: middle;
    }
    tbody > tr > td:nth-child(2) {
        vertical-align: middle;
    } 
    
</style>
@endsection

@section('scripts')
<script>
    $('#slidProd').addClass('menu-open');
    $('#slidProd>a').addClass('active');
    $('#slidProd>ul>li>#menuProd1').addClass('active');
    
    $(document).ready(function(){
        var nombre = $("#nombre_get").val()
        $("#nombre").val($("#nombre_get").val())

        if ($('#applocate').val() == 'es') {
            $("#productTable").DataTable({
                "aaSorting": [],
                "responsive": true,
                "autoWidth": false,
                processing: true,
                serverSide: true,
                pageLength: 0,
                "lengthMenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "Todos"]
                ],
                ajax: "{{url('admin/getProduct?nombre=')}}"+nombre,
                columns: [
                    {data: 'image'},
                    {data: 'nombre'},
                    {data: 'cantidad'},
                    {data: 'estado'},
                    {data: 'activo'},
                    {data: 'action'},
                ],
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
            });
            
            $("#productITable").DataTable({
                "aaSorting": [],
                "responsive": true,
                "autoWidth": false,
                processing: true,
                serverSide: true,
                pageLength: 0,
                "lengthMenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "Todos"]
                ],
                ajax: "{{url('admin/getProductI?nombre=')}}"+nombre,
                columns: [
                    {data: 'image'},
                    {data: 'nombre'},
                    {data: 'cantidad'},
                    {data: 'estado'},
                    {data: 'activo'},
                    {data: 'action'},
                ],
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
            });
        } else {
            $("#productTable").DataTable({
                "aaSorting": [],
                "responsive": true,
                "autoWidth": false,
                processing: true,
                serverSide: true,
                pageLength: 0,
                "lengthMenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"]
                ],
                ajax: "{{url('admin/getProduct?nombre=')}}"+nombre,
                columns: [
                    {data: 'image'},
                    {data: 'nombre'},
                    {data: 'cantidad'},
                    {data: 'estado'},
                    {data: 'activo'},
                    {data: 'action'},
                ],
            });

            $("#productITable").DataTable({
                "aaSorting": [],
                "responsive": true,
                "autoWidth": false,
                processing: true,
                serverSide: true,
                pageLength: 0,
                "lengthMenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"]
                ],
                ajax: "{{url('admin/getProductI?nombre=')}}"+nombre,
                columns: [
                    {data: 'image'},
                    {data: 'nombre'},
                    {data: 'cantidad'},
                    {data: 'estado'},
                    {data: 'activo'},
                    {data: 'action'},
                ],
            });
        }
    });
    
</script>
@endsection

@section('contenido')

<!-- /.row -->
<div id="confirmareliminar" class="row">
    <!-- applocate for use in javascript -->
    <input type="text" value="{{session('applocate')}}" hidden id="applocate">

    @if (isset($_GET['nombre']))
        <input type="text" value="{{$_GET['nombre']}}" hidden id="nombre_get">
    @else
        <input type="text" value="" hidden id="nombre_get">
    @endif

    <span id="urlbase" hidden>{{route('admin.product.index')}}</span>
    @include('custom.modal_eliminar')
    <div class="col-12">

        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title mt-3">{{__('Products Section')}}</h3>

                <div class="card-tools">
                    <a class="m-2 float-right btn btn-primary" href="{{route('admin.product.create')}}">{{__('Create')}} <i class="fas fa-plus"></i></a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
                
                <table class="table table-hover dataTable dtr-inline" role="grid" id="productTable">
                    <thead>
                        <tr class="bg-gradient-green text-center">
                            <th>{{__('Image')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Quantity')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Active')}}</th>
                            <th></th>
                        </tr>
                    </thead>
                    {{-- <tbody>
                        @foreach ($productos as $producto)

                        @if ($producto->users[0]->id === Auth::user()->id || Auth::user()->id === 1)

                        <tr>
                            <td>
                                @if ($producto->images->count() <= 0) <img style="height:100px;width:100px"
                                    src="/imagenes/boxed-bg.jpg" class="rounded-circle">
                                    @else
                                    <img style="height:100px;width:100px" src="{{$producto->images->random()->url}}"
                                        class="rounded-circle">
                                    @endif
                            </td>
                            <td>{{$producto->nombre}}</td>
                            <td>{{$producto->cantidad}}</td>
                            <td>{{$producto->estado}}</td>
                            <td>{{$producto->activo}}</td>

                            <td class="text-nowrap">
                                <a class="hover_zoom mr-2" href="{{route('admin.product.show',$producto->slug)}}"><i class="far fa-eye fa-2x text-primary"></i></a>
                                <a class="hover_zoom mr-2" href="{{route('admin.product.edit',$producto->slug)}}"><i class="fas fa-pencil-alt fa-2x text-warning"></i></a>
                                <a class="hover_zoom mr-2" href="{{route('admin.product.index')}}"
                                    v-on:click.prevent="deseas_eliminar({{$producto->id}})"><i class="fas fa-times-circle fa-2x text-danger"></i></a>
                            </td>
                        </tr>

                        @endif

                        @endforeach

                    </tbody> --}}

                    <tfoot>
                        <tr class="bg-gradient-secondary text-center">
                            <th>{{__('Image')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Quantity')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Active')}}</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <div class="card card-danger card-outline" id="card2">
            <div class="card-header">
                <h3 class="card-title">{{__('Inactive Products')}}</h3>
            </div>

            <div class="card-body table-responsive">
                
                <table class="table table-hover dataTable dtr-inline" role="grid" id="productITable">
                    <thead>
                        <tr class="bg-gradient-red text-center">
                            <th>{{__('Image')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Quantity')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Active')}}</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr class="bg-gradient-secondary text-center">
                            <th>{{__('Image')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Quantity')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Active')}}</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>
</div>
<!-- /.row -->

@endsection