@extends('plantilla.admin')

@section('titulo',__('Categories Administration'))

@section('breadcrumb')
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('scripts')
<script>
    $('#slidCat').addClass('menu-open');
    $('#slidCat>a').addClass('active');
    $('#slidCat>ul>li>#menuCat1').addClass('active');
</script>
@endsection

@section('contenido')

<!-- /.row -->
<div id="confirmareliminar" class="row">
    @include('custom.modal_askCategory')

    <!-- applocate for use in javascript -->
    <input type="text" value="{{session('applocate')}}" hidden id="applocate">
    <span id="urlbase" hidden>{{route('admin.category.index')}}</span>
    @include('custom.modal_eliminar')
    <div class="col-12">
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title mt-3">{{__('Categories Section')}}</h3>

                <a class="m-2 float-right btn btn-primary" href="#" data-toggle="modal" data-target="#askCategoryModal">
                    {{__('Request New Category')}} <i class="fas fa-plus"></i>
                </a>
                
                @can('haveaccess', 'category.create')
                    <a class="m-2 float-right btn btn-primary" href="{{route('admin.category.create')}}">{{__('Create')}} <i class="fas fa-plus"></i></a>
                @endcan
            </div>
            <!-- /.card-header -->
            
            <div class="card-body table-responsive">
                
                <table class="table table-hover" id="tableData">
                    <thead>
                        <tr class="bg-gradient-green text-center">
                            <th>{{__('Name')}}</th>
                            <th>{{__('Description')}}</th>
                            <th>{{__('Sub-Categories')}}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $categoria)
                        <tr>
                            <td class="align-middle">{{$categoria->nombre}}</td>
                            <td class="align-middle">{{$categoria->descripcion}}</td>
                            <td class="align-middle text-center">{{$categoria->subCategories->count()}}</td>

                            <td class="align-middle text-center text-nowrap">
                                <a class="hover_zoom mr-2" data-toggle="tooltip" data-placement="bottom" title="{{ __('See Category') }}" href="{{route('admin.category.show',$categoria->slug)}}"><i class="far fa-eye fa-2x text-primary"></i></a>
                                
                                @can('haveaccess', 'category.edit')
                                <a class="hover_zoom mr-2" data-toggle="tooltip" data-placement="bottom" title="{{ __('Edit Category') }}" href="{{route('admin.category.edit',$categoria->slug)}}"><i class="far fa-edit fa-2x text-success"></i></a>
                                @endcan

                                @can('haveaccess', 'category.destroy')
                                <a class="hover_zoom mr-2" data-toggle="tooltip" data-placement="bottom" title="{{ __('Delete Category') }}" href="{{route('admin.category.index')}}" v-on:click.prevent="deseas_eliminar({{$categoria->id}})"><i class="fas fa-trash-alt fa-2x text-danger"></i></a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr class="bg-gradient-secondary text-center">
                            <th>{{__('Name')}}</th>
                            <th>{{__('Description')}}</th>
                            <th>{{__('Sub-Categories')}}</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<!-- /.row -->

@endsection