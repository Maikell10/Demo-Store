@extends('plantilla.admin')

@section('titulo', __('Providers'))

@section('breadcrumb')
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('scripts')
<script>
    $('#slidShopp').addClass('menu-open');
    $('#slidShopp>a').addClass('active');
    $('#slidShopp>ul>li>#menuShopp2').addClass('active');

    
</script>
@endsection

@section('contenido')

<div class="position-fixed mr-3" style="z-index: 100; bottom:0; right:0; margin-bottom: 60px">
    <a href="{{route('admin.providers.create')}}" class="btn btn-primary img-circle hover_zoom_a"><i
            class="fas fa-plus"></i></a>
</div>
<!-- applocate for use in javascript -->
<input type="text" value="{{session('applocate')}}" hidden id="applocate">

@include('custom.modal_eliminar_provider')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-success card-outline">

                    <div class="card-header">
                        <h3 class="card-title">{{ __('Providers Section') }}</h3>

                        <div class="card-tools">
                            <a href="{{route('admin.providers.create')}}" class="btn btn-primary">{{__('Add')}} <i
                                    class="fas fa-plus"></i></a>
                        </div>
                    </div>

                    <div class="card-body table-responsive">

                        <table id="tableData" class="table table-hover">
                            <thead>
                                <tr class="bg-gradient-green text-center">
                                    <th>{{__('User')}}</th>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Document')}}</th>
                                    <th>{{__('Number')}}</th>
                                    <th>{{__('Phone')}}</th>
                                    <th>Email</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($providers as $provider)
                                <tr class="text-center">
                                    <td class="align-middle"><span class="badge badge-info">{{$provider->user->name}}</span></td>
                                    <td class="align-middle">{{$provider->name}}</td>
                                    <td class="align-middle">{{$provider->document}}</td>
                                    <td class="align-middle">{{$provider->number}}</td>
                                    <td class="align-middle">{{$provider->phone}}</td>
                                    <td class="align-middle">{{$provider->email}}</td>
                                    <td class="align-middle text-nowrap">
                                        <a href="{{route('admin.providers.show',$provider->id)}}"
                                            class="hover_zoom mr-2" data-toggle="tooltip" data-placement="bottom"
                                            title="{{ __('See Provider') }}"><i
                                                class="far fa-eye fa-2x text-primary"></i></a>

                                        <a href="{{route('admin.providers.edit',$provider->id)}}"
                                            class="hover_zoom mr-2" data-toggle="tooltip" data-placement="bottom"
                                            title="{{ __('Edit Provider') }}"><i
                                                class="fas fa-pencil-alt fa-2x text-warning"></i></a>

                                        <span  data-toggle="tooltip" data-placement="bottom"
                                        title="{{ __('Delete Provider') }}">
                                            <a href="{{route('admin.providers')}}" data-toggle="modal" data-id="{{$provider->id}}" data-target="#modal_eliminar_provider" class="hover_zoom" ><i class="fas fa-times-circle fa-2x text-danger"></i></a>
                                        </span>
                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="bg-gradient-secondary text-center">
                                    <th>{{__('User')}}</th>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Document')}}</th>
                                    <th>{{__('Number')}}</th>
                                    <th>{{__('Phone')}}</th>
                                    <th>Email</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div><!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->


<div class="modal fade" id="modal_eliminar" tabindex="-1" role="dialog" aria-labelledby="modal_eliminarLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_eliminarLabel">Deseas eliminar este registro?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <form :action="urlaeliminar" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-primary">Sí</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection