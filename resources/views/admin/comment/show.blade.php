@extends('plantilla.admin')

@section('titulo',__('Questions and Answers'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.comment.index')}}">{{__('Questions and Answers Administration')}}</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('scripts')
<script>
    $('#slidComment>a').addClass('active');
    
    $(function () {

        if ($('#applocate').val() != '') {
            if ($('#applocate').val() == 'es') {
                $("#example1").DataTable({
                    "responsive": false,
                    "autoWidth": false,
                    language: {
                        "decimal": "",
                        "emptyTable": "No hay información",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Entradas",
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "search": "Buscar:",
                        "zeroRecords": "Sin resultados encontrados",
                        "paginate": {
                            "first": "Primero",
                            "last": "Ultimo",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        }
                    },
                });
            } else {
                $("#example1").DataTable({
                    "responsive": false,
                    "autoWidth": false,
                });
            }
        }
        
    });
</script>
@endsection

@section('contenido')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <!-- applocate for use in javascript -->
                <input type="text" value="{{session('applocate')}}" hidden id="applocate">

                <div class="card card-success card-outline">
                    <div class="card-header">
                        <h2 class="card-title">{{__('Questions of:')}} {{$producto->nombre}}</h2>
                        
                        @if ($cant_left != 0)
                            @if ($cant_left == 1)
                                <span class="float-right badge badge-pill badge-danger">{{__('There is')}} {{$cant_left}} {{__('without answering')}}</span>
                            @else
                                <span class="float-right badge badge-pill badge-danger">{{__('There are')}} {{$cant_left}} {{__('without answering')}}</span>
                            @endif
                        @endif
                    </div>

                    <div class="card-body">

                        @foreach ($producto->comments as $comment)
                        @if ($comment['parent_id'] == null)
                        <div class="callout callout-success">
                            @if(!isset($comment['answers'][0]['body']))
                            <span class="float-right badge badge-pill badge-danger">!</span>
                            @endif
                            <div class="row p-2">
                                <div class="col-md-12 d-flex">
                                    <img src="https://img.icons8.com/cotton/64/000000/speech-bubble-with-dots.png"
                                        width="40px" height="45px" class="mr-4" />
                                    <div>
                                        <p class="text-justify" style="/*text-indent: 25px*/">
                                            <font class="font-weight-bold mr-2">{{$comment['users']->name}}</font>
                                            {{$comment['body']}}
                                        </p>
                                        <small>{{ \Carbon\Carbon::parse($comment['created_at'])->diffForHumans() }}</small>
                                        <small
                                            hidden>{{ \Carbon\Carbon::parse($comment['created_at'])->format('d/m/Y h:i:s a') }}</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Answers -->
                            @if(!isset($comment['answers'][0]['body']))
                            <div class="row p-2">
                                <div class="col-md-12">
                                    <form action="{{ route('admin.comment.store') }}" method="POST">
                                        @csrf

                                        <div class="input-group">
                                            <input type="text" name="product_id" value="{{$comment['product_id']}}"
                                                hidden>
                                            <input type="text" name="parent_id" value="{{$comment['id']}}" hidden>
                                            <input type="text" name="body" placeholder="{{__('Type an Answer ...')}}"
                                                class="form-control">
                                            <input type="text" name="slug" value="{{$producto->slug}}" hidden>
                                            <span class="input-group-append">
                                                <button type="submit" class="btn btn-success">{{__('Send')}}</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endif

                            @isset($comment['answers'][0]['body'])
                            <div class="row p-3 ml-5">
                                <div class="col-md-12 d-flex">
                                    <img src="https://img.icons8.com/plasticine/64/000000/speech-bubble-with-dots.png"
                                        width="35px" height="40px" class="mr-4" />
                                    <div>
                                        <p class="text-muted text-justify">
                                            <font class="font-weight-bold mr-2 text-success">
                                                {{$producto->users[0]->name}}
                                            </font>{{$comment['answers'][0]['body']}}
                                        </p>
                                        <small>{{ \Carbon\Carbon::parse($comment['answers'][0]['created_at'])->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </div>
                            @endisset
                        </div>
                        @endif
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection