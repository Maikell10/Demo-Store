@extends('plantilla.admin')

@section('titulo',__('Questions and Answers Administration'))

@section('breadcrumb')
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('scripts')
<script>
    $('#slidComment>a').addClass('active');
    
</script>
@endsection

@section('contenido')

<!-- /.row -->
<div id="confirmareliminar" class="row">
    <!-- applocate for use in javascript -->
    <input type="text" value="{{session('applocate')}}" hidden id="applocate">
    <span id="urlbase" hidden>{{route('admin.comment.index')}}</span>
    @include('custom.modal_eliminar')
    <div class="col-12">
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title">{{ __('Products with questions') }}</h3>
            </div>

            <div class="card-body table-responsive">

                <table id="tableData" class="table table-hover">
                    <thead>
                        <tr class="bg-gradient-green text-center">
                            <th>{{__('Image')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Questions')}}</th>
                            <th>{{__('Answers')}}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $index => $producto)

                        @if ($producto[0]->users[0]->id === Auth::user()->id || Auth::user()->id === 1)

                        <tr class="text-center">
                            <td>
                                @if ($producto[0]->images->count() <= 0) <img style="height:100px;width:100px"
                                    src="/imagenes/boxed-bg.jpg" class="rounded-circle">
                                    @else
                                    <img style="height:100px;width:100px" src="{{$producto[0]->images->random()->url}}"
                                        class="rounded-circle">
                                    @endif
                            </td>
                            <td class="align-middle">{{$producto[0]->nombre}}</td>
                            <td class="align-middle">
                                <div class="position-relative p-3">
                                    {{$cant_coments[$index]}}
                                    @php
                                        $cant_alert = 0;
                                    @endphp
                                    @foreach ($producto[0]->comments as $comment)
                                        @if ($comment->status != 'VIEW' && $comment->parent_id == null)
                                            @php
                                                $cant_alert = $cant_alert + 1;
                                            @endphp
                                        @endif
                                    @endforeach
                                    @if ($cant_alert != 0)
                                    <span class="badge badge-danger navbar-badge" style="font-size: 1rem" data-toggle="tooltip" data-placement="bottom" title="{{__('New Questions')}}">{{$cant_alert}}</span>
                                    @endif
                                </div>
                            </td>
                            <td class="align-middle">{{$cant_answers[$index]}}</td>

                            <td class="text-nowrap align-middle">
                                <a class="btn btn-primary" href="{{route('admin.comment.show',$producto[0]->slug)}}">{{__('See Questions')}} <i
                                        class="far fa-eye"></i></a>
                            </td>
                        </tr>

                        @endif

                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-gradient-secondary text-center">
                            <th>{{__('Image')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Questions')}}</th>
                            <th>{{__('Answers')}}</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection