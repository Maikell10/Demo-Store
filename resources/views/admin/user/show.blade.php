@extends('plantilla.admin')

@section('titulo','Ver Usuario')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.user.index')}}">Usuarios</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('contenido')

<!-- /.row -->
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Ver Usuario</h2>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                    title="{{__('Collapse')}}">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>

        <div class="card-body">
            @include('custom.message')

            <form>

                <div class="container">

                    <h3>Data Requerida</h3>

                    <div class="form-group">
                        <input readonly type="text" class="form-control" id="name" placeholder="Nombre" name="name"
                            value="{{ old('name',$user->name)}}">
                    </div>
                    <div class="form-group">
                        <input readonly type="text" class="form-control" id="email" placeholder="Email" name="email"
                            value="{{ old('email',$user->email)}}">
                    </div>

                    <div class="form-group">
                        <select disabled name="roles" id="roles" class="form-control">
                            <option value="">No Role Assigned</option>
                            @foreach ($roles as $role)
                            <option value="{{$role->id}}" @isset($user->roles[0]->name)
                                @if ($role->name == $user->roles[0]->name)
                                selected
                                @endif
                                @endisset

                                >{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <hr>
                    <a href="{{route('admin.user.edit',$user->id)}}" class="btn btn-success">Editar</a>

                    <a href="{{route('admin.user.index')}}" class="btn btn-danger">Cancelar</a>


                </div>

            </form>


        </div>
    </div>
</div>
@endsection