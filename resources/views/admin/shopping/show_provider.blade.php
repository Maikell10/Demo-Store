@extends('plantilla.admin')

@section('titulo', __('See Provider'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.providers')}}">{{__('Providers')}}</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('scripts')
<script>
    $('#slidShopp').addClass('menu-open');
    $('#slidShopp>a').addClass('active');

    function mayus(e) {
        e.value = e.value.toUpperCase();
    }

    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();
    })
    
</script>
@endsection

@section('contenido')

<div class="content" id="apiprovider">

    <span id="editar" hidden>{{$editar}}</span>
    <span id="nametemp" hidden>{{$provider->name}}</span>
    <span id="documenttemp" hidden>{{$provider->document}}</span>
    <span id="numbertemp" hidden>{{$provider->number}}</span>
    <span id="phonetemp" hidden>{{$provider->phone}}</span>
    <span id="emailtemp" hidden>{{$provider->email}}</span>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-success card-outline">

                    <div class="card-header">
                        <h3 class="card-title">{{ __('Providers Section') }}</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="{{__('Collapse')}}">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="container">

                            <h1>{{__('See Provider')}}</h1>

                            <div class="form-group">
                                <label for="name">{{__('Name')}}</label>
                                <input readonly v-model="name"
                                    class="form-control" type="text" name="name" id="name" onkeyup="mayus(this);">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="document">{{__('Document')}}</label>
                                            <input readonly v-model="document" class="form-control" type="text" name="document"
                                                id="document">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="number">{{__('Number')}}</label>
                                            <input readonly v-model="number" class="form-control" type="text" name="number"
                                                id="number">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">{{__('Phone')}}</label>
                                            <input readonly v-model="phone" class="form-control" type="text" name="phone"
                                                id="phone">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input readonly v-model="email" class="form-control" type="email" name="email"
                                                id="email">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <a href="{{route('cancelar','admin.providers')}}" class="btn btn-danger">{{__('Cancel')}}</a>

                        <a href="{{route('admin.providers.edit',$provider->id)}}" class="btn btn-outline-success float-right">{{__('Edit')}}</a>
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