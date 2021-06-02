@extends('plantilla.admin')

@section('titulo',__('Users Administration'))

@section('breadcrumb')
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('scripts')
<script>
    $('#slidUser>a').addClass('active');
</script>
@endsection

@section('contenido')

@include('custom.modal_eliminar_user')

<!-- /.row -->
<div id="confirmareliminar" class="row">
    <!-- applocate for use in javascript -->
    <input type="text" value="{{session('applocate')}}" hidden id="applocate">

    <span id="urlbase" hidden>{{route('admin.role.index')}}</span>
    @include('custom.modal_eliminar')
    <div class="col-12">
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title">{{ __('List of Users') }}</h3>

                {{-- <div class="card-tools">

                    <form>
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="nombre" class="form-control float-right" placeholder="Buscar"
                                value="{{request()->get('nombre')}}">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>

                </div> --}}
            </div>

            <div class="card-body table-responsive p-0">

                @include('custom.message')

                <div class="card-body table-responsive">
                    <table class="table table-hover dataTable dtr-inline" role="grid" id="tableData">
                        <thead>
                            <tr class="bg-gradient-green text-center">
                                <th>#</th>
                                <th>{{__('Name')}}</th>
                                <th>Email</th>
                                <th>Rol(es)</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr class="text-center">
                                <th scope="row">{{$user->id}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>@isset($user->roles[0]->name)
                                    {{$user->roles[0]->name}}
                                    @endisset</td>
                                <td class="align-middle text-nowrap">

                                    @can('view',[$user, ['user.show','userown.show'] ])
                                    <a class="hover_zoom mr-2" href="{{route('admin.user.show',$user->id)}}"><i class="far fa-eye fa-2x text-primary"></i></a>
                                    @endcan
                                
                                    @can('view', [$user, ['user.edit','userown.edit'] ])
                                    <a class="hover_zoom mr-2" href="{{route('admin.user.edit',$user->id)}}"><i class="fas fa-pencil-alt fa-2x text-warning"></i></a>
                                    @endcan

                                    @can('haveaccess', 'user.destroy')
                                        {{-- <form action="{{route('admin.user.destroy',$user->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                        </form> --}}

                                        <a href="{{route('admin.user.destroy',$user->id)}}" data-toggle="modal" data-id="{{$user->id}}" data-target="#modal_eliminar_user" class="hover_zoom" ><i class="fas fa-times-circle fa-2x text-danger"></i></a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr class="bg-gradient-secondary text-center">
                                <th>#</th>
                                <th>{{__('Name')}}</th>
                                <th>Email</th>
                                <th>Rol(es)</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="float-right m-2">
                    {{$users->appends($_GET)->links()}}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection