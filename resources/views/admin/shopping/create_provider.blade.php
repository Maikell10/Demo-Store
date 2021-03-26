@extends('plantilla.admin')

@section('titulo', __('Create Provider'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.providers')}}">{{__('Providers')}}</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('scripts')
<!-- InputMask -->
<script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
<script>
    $('#slidShopp').addClass('menu-open');
    $('#slidShopp>a').addClass('active');

    function mayus(e) {
        e.value = e.value.toUpperCase();
    }

    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();
        $('[data-mask]').inputmask()
    })
    
</script>
@endsection

@section('contenido')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-success card-outline">

                    <div class="card-header">
                        <h3 class="card-title">{{ __('Providers Section') }}</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>

                    <form action="{{route('admin.providers.store')}}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="container">

                                <h1>{{__('Create Provider')}}</h1>

                                <div class="form-group">
                                    <label for="name">{{__('Name')}}</label>
                                    <input v-model="name" @blur="getCategory" @focus='div_aparecer=false'
                                        class="form-control" type="text" name="name" id="name"
                                        onkeyup="mayus(this);">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="document">{{__('Document')}}</label>
                                                <select class="form-control select2 select2-danger"
                                                    data-dropdown-css-class="select2-success" style="width: 100%;"
                                                    name="document" id="document">
                                                    <option selected="selected">RIF</option>
                                                    <option>CI</option>
                                                    <option>RUC</option>
                                                    <option>DNI</option>
                                                </select>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="number">{{__('Number')}}</label>
                                                <input v-model="number" class="form-control" type="text" name="number"
                                                    id="number" onkeyup="mayus(this);">
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone">{{__('Phone')}}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                    </div>
                                                    <input v-model="phone" class="form-control" type="text" name="phone"
                                                    id="phone" data-inputmask='"mask": "+99 (999) 999-9999"' data-mask>
                                                </div>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input v-model="email" class="form-control" type="email" name="email"
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

                            <input :disabled="deshabilitar_boton==1" type="submit" value="{{__('Save')}}"
                                class="btn btn-primary float-right">
                        </div>

                    </form>

                </div><!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

@endsection