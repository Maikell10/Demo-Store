@extends('plantilla.admin')

@section('titulo','Crear Rol')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.role.index')}}">Roles</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('scripts')
<script>
    $('#slidRole').addClass('menu-open');
    $('#slidRole>a').addClass('active');
    $('#slidRole>ul>li>#menuRole2').addClass('active');
</script>
@endsection

@section('contenido')

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Crear Rol</h2>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>

        <div class="card-body">
            @include('custom.message')

            <form action="{{ route('admin.role.store')}}" method="POST">
                @csrf

                <div class="container">

                    <h3>Data Requerida</h3>

                    <div class="form-group">
                        <input type="text" class="form-control" id="name" placeholder="Nombre" name="name"
                            value="{{ old('name')}}">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="slug" placeholder="Slug" name="slug"
                            value="{{ old('slug')}}">
                    </div>

                    <div class="form-group">

                        <textarea class="form-control" placeholder="Descripción" name="description" id="description"
                            rows="3">{{ old('description')}}</textarea>
                    </div>

                    <hr>

                    <h3>Full Access</h3>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="fullaccessyes" name="full-access" class="custom-control-input"
                            value="yes" @if (old('full-access')=="yes" ) checked @endif>
                        <label class="custom-control-label" for="fullaccessyes">Sí</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="fullaccessno" name="full-access" class="custom-control-input" value="no"
                            @if (old('full-access')!="yes" ) checked @endif>
                        <label class="custom-control-label" for="fullaccessno">No</label>
                    </div>

                    <hr>


                    <h3>Lista de Permisos</h3>


                    @foreach($permissions as $permission)


                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="permission_{{$permission->id}}"
                            value="{{$permission->id}}" name="permission[]" @if( is_array(old('permission')) &&
                            in_array("$permission->id", old('permission')) )
                        checked
                        @endif
                        >
                        <label class="custom-control-label" for="permission_{{$permission->id}}">
                            {{ $permission->id }}
                            -
                            {{ $permission->name }}
                            <em>( {{ $permission->description }} )</em>

                        </label>
                    </div>


                    @endforeach
                    <hr>
                    <input class="btn btn-primary" type="submit" value="Guardar">


                </div>

            </form>


        </div>
    </div>
</div>
@endsection