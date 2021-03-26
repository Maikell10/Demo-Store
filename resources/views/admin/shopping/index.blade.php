@extends('plantilla.admin')

@section('titulo', __('Purchases'))

@section('breadcrumb')
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('scripts')
<script>
    $('#slidShopp').addClass('menu-open');
    $('#slidShopp>a').addClass('active');
    $('#slidShopp>ul>li>#menuShopp1').addClass('active');

</script>
@endsection

@section('contenido')

@include('custom.modal_eliminar_purchase')

<div class="position-fixed mr-3" style="z-index: 100; bottom:0; right:0; margin-bottom: 60px">
    <a href="{{route('admin.shopping.create')}}" class="btn btn-primary img-circle hover_zoom_a"><i class="fas fa-plus"></i></a>
</div>
<!-- applocate for use in javascript -->
<input type="text" value="{{session('applocate')}}" hidden id="applocate">

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-success card-outline">

                    <div class="card-header">
                        <h3 class="card-title">{{ __('Purchases Section') }}</h3>

                        <div class="card-tools">
                            <a href="{{route('admin.shopping.create')}}" class="btn btn-primary">{{__('Create Purchase')}} <i class="fas fa-plus"></i></a>
                        </div>
                    </div>

                    <div class="card-body table-responsive">

                        <table id="tableData" class="table table-hover dataTable dtr-inline" role="grid">
                            <thead>
                                <tr class="bg-gradient-green text-center">
                                    <th>{{__('User')}}</th>
                                    <th>{{__('Date')}}</th>
                                    <th>{{__('Provider')}}</th>
                                    <th>{{__('Number')}}</th>
                                    <th>{{__('Total Purchase')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchases as $purchase)
                                <tr class="text-center">
                                    <td class="align-middle"><span class="badge badge-info">{{$purchase->user->name}}</span></td>
                                    <td class="align-middle">{{ \Carbon\Carbon::parse($purchase->date)->format('d-m-Y') }}</td>
                                    <td class="align-middle">{{$purchase->provider->name}}</td>
                                    <td class="align-middle">{{$purchase->serie}}-{{$purchase->number}}</td>
                                    <td class="align-middle">${{number_format($purchase->total,2)}}</td>
                                    <td class="align-middle"><span class="badge badge-success">{{$purchase->state}}</span></td>
                                    <td class="align-middle text-nowrap">
                                        <a href="{{route('admin.shopping.show',$purchase->id)}}" class="hover_zoom mr-2" data-toggle="tooltip" data-placement="bottom" title="{{ __('See Purchase') }}"><i class="far fa-eye fa-2x text-primary"></i></a>

                                        <a href="{{route('admin.shopping.edit',$purchase->id)}}" class="hover_zoom mr-2" data-toggle="tooltip" data-placement="bottom" title="{{ __('Edit Purchase') }}"><i class="fas fa-pencil-alt fa-2x text-warning"></i></a>

                                        <span  data-toggle="tooltip" data-placement="bottom"
                                        title="{{ __('Delete Purchase') }}">
                                            <a href="{{route('admin.shopping.index')}}" data-toggle="modal" data-id="{{$purchase->id}}" data-target="#modal_eliminar_purchase" class="hover_zoom" ><i class="fas fa-times-circle fa-2x text-danger"></i></a>
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="bg-gradient-secondary text-center">
                                    <th>{{__('User')}}</th>
                                    <th>{{__('Date')}}</th>
                                    <th>{{__('Provider')}}</th>
                                    <th>{{__('Number')}}</th>
                                    <th>{{__('Total Purchase')}}</th>
                                    <th>{{__('Status')}}</th>
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

@endsection