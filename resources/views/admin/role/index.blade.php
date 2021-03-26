@extends('plantilla.admin')

@section('titulo','Administración de Roles')

@section('breadcrumb')
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('scripts')
<script>
    $('#slidRole').addClass('menu-open');
    $('#slidRole>a').addClass('active');
    $('#slidRole>ul>li>#menuRole1').addClass('active');
</script>
@endsection

@section('contenido')

<!-- /.row -->
<div id="confirmareliminar" class="row">

    <span id="urlbase" hidden>{{route('admin.role.index')}}</span>
    @include('custom.modal_eliminar')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('List of Roles') }}</h3>

                <div class="card-tools">

                    <form>
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="nombre" class="form-control float-right" placeholder="Buscar"
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

                @can('haveaccess', 'role.create')
                <a href="{{route('admin.role.create')}}" class="m-2 float-right btn btn-primary">Crear <i class="fas fa-plus"></i></a>
                @endcan

                @include('custom.message')

                <table class="table table-head-fixed table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Full-Access</th>
                            <th scope="col" colspan="3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                        <tr>
                            <th scope="row">{{$role->id}}</th>
                            <td>{{$role->name}}</td>
                            <td>{{$role->slug}}</td>
                            <td>{{$role->description}}</td>
                            <td>{{$role['full-access']}}</td>
                            <td class="text-center">
                                @can('haveaccess', 'role.show')
                                <a class="btn btn-info" href="{{route('admin.role.show',$role->id)}}"><i
                                        class="far fa-eye"></i></a>
                                @endcan
                            </td>
                            <td class="text-center">
                                @can('haveaccess', 'role.edit')
                                <a class="btn btn-success" href="{{route('admin.role.edit',$role->id)}}"><i
                                        class="far fa-edit"></i></a>
                                @endcan
                            </td>
                            <td class="text-center">
                                @can('haveaccess', 'role.destroy')
                                <form action="{{route('admin.role.destroy',$role->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="float-right m-2">
                    {{$roles->appends($_GET)->links()}}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection