@extends('plantilla.admin')

@section('titulo','Editar Rol')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.role.index')}}">Roles</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('contenido')


<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Editar Rol</h2>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                    title="{{__('Collapse')}}">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>

        <div class="card-body">
            @include('custom.message')

            <form action="{{ route('admin.role.update',$role->id)}}" method="POST">
                @csrf
                @method('PUT')

                <div class="container">

                    <h3>Data Requerida</h3>

                    <div class="form-group">
                        <input type="text" class="form-control" id="name" placeholder="Nombre" name="name"
                            value="{{ old('name',$role->name)}}">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="slug" placeholder="Slug" name="slug"
                            value="{{ old('slug',$role->slug)}}">
                    </div>

                    <div class="form-group">

                        <textarea class="form-control" placeholder="Descripción" name="description" id="description"
                            rows="3">{{ old('description',$role->description)}}</textarea>
                    </div>

                    <hr>

                    <h3>Full Access</h3>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="fullaccessyes" name="full-access" class="custom-control-input"
                            value="yes" @if ($role['full-access']=="yes" ) checked @elseif(old('full-access')=="yes" )
                            checked @endif>
                        <label class="custom-control-label" for="fullaccessyes">Sí</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="fullaccessno" name="full-access" class="custom-control-input" value="no"
                            @if ($role['full-access']=="no" ) checked @elseif(old('full-access')=="no" ) checked @endif>
                        <label class="custom-control-label" for="fullaccessno">No</label>
                    </div>

                    <hr>


                    <h3>Lista de Permisos</h3>


                    @foreach($permissions as $permission)


                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="permission_{{$permission->id}}"
                            value="{{$permission->id}}" name="permission[]" @if( is_array(old('permission')) &&
                            in_array("$permission->id", old('permission')) ) checked @elseif(
                        is_array($permission_role) && in_array("$permission->id", $permission_role) ) checked
                        @endif>
                        <label class="custom-control-label" for="permission_{{$permission->id}}">
                            {{ $permission->id }}
                            -
                            {{ $permission->name }}
                            <em>( {{ $permission->description }} )</em>

                        </label>
                    </div>


                    @endforeach
                    <hr>
                    <input class="btn btn-info" type="submit" value="Guardar">

                    <a href="{{route('admin.role.index')}}" class="btn btn-danger">Cancelar</a>


                </div>

            </form>


        </div>
    </div>
</div>
@endsection