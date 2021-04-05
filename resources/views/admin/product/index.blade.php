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
</style>
@endsection

@section('scripts')
<script>
    $('#slidProd').addClass('menu-open');
    $('#slidProd>a').addClass('active');
    $('#slidProd>ul>li>#menuProd1').addClass('active');
</script>
@endsection

@section('contenido')

<!-- /.row -->
<div id="confirmareliminar" class="row">

    <span id="urlbase" hidden>{{route('admin.product.index')}}</span>
    @include('custom.modal_eliminar')
    <div class="col-12">

        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title">{{__('Products Section')}}</h3>

                <div class="card-tools">
                    <form>
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="nombre" class="form-control float-right" placeholder="{{__('Search')}}"
                                value="{{request()->get('nombre')}}">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <a class="m-2 float-right btn btn-primary" href="{{route('admin.product.create')}}">{{__('Create')}} <i
                        class="fas fa-plus"></i></a>
                <table class="table1 table-head-fixed table-hover">
                    <thead>
                        <tr>
                            <th>{{__('Image')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Quantity')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>Activo</th>
                            <th>Slider Principal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
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
                            <td>{{$producto->sliderprincipal}}</td>

                            <td class="text-nowrap">
                                <a class="btn btn-default" href="{{route('admin.product.show',$producto->slug)}}"><i
                                        class="far fa-eye"></i></a>
                                <a class="btn btn-info" href="{{route('admin.product.edit',$producto->slug)}}"><i
                                        class="far fa-edit"></i></a>
                                <a class="btn btn-danger" href="{{route('admin.product.index')}}"
                                    v-on:click.prevent="deseas_eliminar({{$producto->id}})"><i
                                        class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>

                        @endif

                        @endforeach

                    </tbody>
                </table>
                <div class="float-right m-2">
                    {{$productos->appends($_GET)->links()}}
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<!-- /.row -->

@endsection