@extends('plantilla.admin')

@section('titulo','Editar Categoría')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.category.index')}}">Categorías</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('scripts')
<script>
    $('#slidCat').addClass('menu-open');
    $('#slidCat>a').addClass('active');
</script>
@endsection

@section('contenido')


<div id="apicategory">
    <form action="{{route('admin.category.update',$cat->id)}}" method="POST">
        @csrf
        @method('PUT')

        <span id="editar" hidden>{{$editar}}</span>
        <span id="nombretemp" hidden>{{$cat->nombre}}</span>
        <!-- Default box -->
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title">Administración de Categorías</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="{{__('Collapse')}}">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                        title="{{__('Remove')}}">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">


                <div class="container">

                    <h1>Editar Categoría</h1>

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input v-model="nombre" @blur="getCategory" @focus='div_aparecer=false' class="form-control"
                            type="text" name="nombre" id="nombre">
                        <label for="slug">Slug</label>
                        <div v-if="div_aparecer" v-bind:class="div_clase_slug">
                            @{{div_mensaje_slug}}
                        </div>
                        <input readonly v-model="generarSlug" class="form-control" type="text" name="slug" id="slug">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" name="descripcion" id="descripcion" cols="30"
                            rows="5">{{$cat->descripcion}}</textarea>
                    </div>
                </div>


            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{{route('cancelar','admin.category.index')}}" class="btn btn-danger">Cancelar</a>

                <input :disabled="deshabilitar_boton==1" type="submit" value="Guardar"
                    class="btn btn-primary float-right">
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
    </form>
</div>
@endsection