@extends('plantilla.admin')

@section('titulo',__('Orders Administration'))

@section('breadcrumb')
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('scripts')
<script>
    $('#slidOrder>a').addClass('active');
    
</script>
@endsection

@section('contenido')

<!-- /.row -->
<div id="confirmareliminar" class="row">
    <!-- applocate for use in javascript -->
    <input type="text" value="{{session('applocate')}}" hidden id="applocate">
    <span id="urlbase" hidden>{{route('admin.order.index')}}</span>
    @include('custom.modal_eliminar')
    <div class="col-12">
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title">{{ __('Orders') }}</h3>
            </div>

            <div class="card-body table-responsive">

                <table id="tableData" class="table table-hover">
                    <thead>
                        <tr class="bg-gradient-green text-center">
                            <th>{{__('Client')}}</th>
                            <th>{{__('Created')}}</th>
                            <th>{{__('Updated')}}</th>
                            <th>#</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Total Order')}}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < count($distinct_sale); $i++)
                        <tr class="text-center">
                            @for ($a = 0; $a < count($sales); $a++)
                                @if ($sales[$a]->updated_at == $distinct_sale[$i]->updated_at)
                                    <td class="align-middle"><span class="badge badge-info">{{$sales[$a]->users->name}}</span></td>
                                    @php
                                        $a = count($sales);
                                    @endphp
                                @endif
                            @endfor
                            
                            <td class="align-middle">{{ \Carbon\Carbon::parse($distinct_sale[$i]->created_at)->diffForHumans() }}</td>

                            <td class="align-middle">{{ \Carbon\Carbon::parse($distinct_sale[$i]->updated_at)->diffForHumans() }}</td>
                            
                            @for ($a = 0; $a < count($sales); $a++)
                                @if ($sales[$a]->updated_at == $distinct_sale[$i]->updated_at)
                                    <td class="align-middle">{{strftime("%j%d%G-%H%M%S", strtotime($sales[$a]->created_at) . $sales[$a]->user_id )}}
                                        @if ($sales[$a]->status == 'NOT VIEW')
                                            <span class="badge badge-danger" style="font-size: 0.8rem" data-toggle="tooltip" data-placement="bottom" title="{{__('New Order')}}"><i class="fas fa-exclamation"></i></span>
                                        @endif
                                    </td>

                                    @if ($sales[$a]->state == 'Ordenado')
                                        <td class="align-middle"><span class="badge badge-warning">{{$sales[$a]->state}}</span></td>
                                    @endif
                                    @if ($sales[$a]->state == 'Pagado')
                                        <td class="align-middle"><span class="badge badge-primary">{{$sales[$a]->state}}</span></td>
                                    @endif
                                    @if ($sales[$a]->state == 'Entregado')
                                        <td class="align-middle"><span class="badge badge-secondary">{{$sales[$a]->state}}</span></td>
                                    @endif
                                    @if ($sales[$a]->state == 'Finalizada')
                                        <td class="align-middle"><span class="badge badge-success">{{$sales[$a]->state}}</span></td>
                                    @endif
                                    @if ($sales[$a]->state == 'Cancelada')
                                        <td class="align-middle"><span class="badge badge-danger">{{$sales[$a]->state}}</span></td>
                                    @endif
                                    

                                    @php
                                        $a = count($sales);
                                    @endphp
                                @endif
                            @endfor

                            @php
                                $total = 0;      
                            @endphp
                            @for ($a = 0; $a < count($sales); $a++)
                                @if ($sales[$a]->updated_at == $distinct_sale[$i]->updated_at)
                                    @php
                                        $total = $total + ($sales[$a]->price_sale * $sales[$a]->cantidad);
                                    @endphp
                                @endif
                            @endfor

                            <td class="align-middle">${{ number_format($total,2) }}</td>

                            <td class="align-middle text-nowrap">
                                <a href="{{route('admin.order.show',$distinct_sale[$i]->created_at)}}" class="hover_zoom mr-2" data-toggle="tooltip" data-placement="bottom" title="{{ __('See Order') }}"><i class="far fa-eye fa-2x text-primary"></i></a>
                            </td>
                        </tr>
                        @endfor
                    </tbody>
                    <tfoot>
                        <tr class="bg-gradient-secondary text-center">
                            <th>{{__('Client')}}</th>
                            <th>{{__('Created')}}</th>
                            <th>{{__('Updated')}}</th>
                            <th>#</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Total Order')}}</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection