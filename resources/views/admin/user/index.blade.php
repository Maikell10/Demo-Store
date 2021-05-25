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

<!-- /.row -->
<div id="confirmareliminar" class="row">
    <span id="urlbase" hidden>{{route('admin.role.index')}}</span>
    @include('custom.modal_eliminar')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('List of Users') }}</h3>

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

            <div class="card-body table-responsive p-0">

                @include('custom.message')



                <table class="table table-head-fixed table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{__('Name')}}</th>
                            <th scope="col">Email</th>
                            <th scope="col">Rol(es)</th>
                            <th scope="col" colspan="3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{$user->id}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>@isset($user->roles[0]->name)
                                {{$user->roles[0]->name}}
                                @endisset</td>
                            <td class="text-center">
                                @can('view',[$user, ['user.show','userown.show'] ])
                                <a class="btn btn-info" href="{{route('admin.user.show',$user->id)}}"><i
                                        class="far fa-eye"></i></a>
                                @endcan
                            </td>
                            <td class="text-center">
                                @can('view', [$user, ['user.edit','userown.edit'] ])
                                <a class="btn btn-success" href="{{route('admin.user.edit',$user->id)}}"><i
                                        class="far fa-edit"></i></a>
                                @endcan
                            </td>
                            <td class="text-center">
                                @can('haveaccess', 'user.destroy')
                                <form action="{{route('admin.user.destroy',$user->id)}}" method="POST">
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
                    {{$users->appends($_GET)->links()}}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection