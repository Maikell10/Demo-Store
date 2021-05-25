@extends('plantilla.admin')


@section('titulo', 'Crear Producto')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.product.index')}}">{{__('Products')}}</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('scripts')

<script src="/adminlte/ckeditor/ckeditor.js"></script>

<script>
    window.data = {
        editar: 'No',
        datos: {
            "nombre":"",
            "precioanterior":"",
            "porcentaje_descuento":""
        }
    }

    $(function () {
        //Initialize Select2 Elements
        //$('#category_id').select2();
        $('#sub_category_id').select2();
        $('#main_category_id').select2();

        $('#estado').select2();

        //Initialize Select2 Elements
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        });
    });

    $('#slidProd').addClass('menu-open');
    $('#slidProd>a').addClass('active');
    $('#slidProd>ul>li>#menuProd2').addClass('active');
</script>
@endsection


@section('contenido')

<div id="apiproduct">
    <!-- applocate for use in javascript -->
    <input type="text" value="{{session('applocate')}}" hidden id="lang">

    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">{{__('Product data')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label for="nombre">{{__('Name')}}</label>
                                    <input v-model="nombre" @blur="getProduct" @focus='div_aparecer=false'
                                        class="form-control" type="text" name="nombre" id="nombre">

                                    <label for="slug">Slug</label>
                                    <div v-if="div_aparecer" v-bind:class="div_clase_slug">
                                        @{{div_mensaje_slug}}
                                    </div>
                                    <input readonly v-model="generarSlug" class="form-control" type="text" name="slug"
                                        id="slug">

                                </div>
                                <!-- /.form-group -->

                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>{{__('Category')}}</label>
                                            <select name="category_id" id="category_id" class="form-control select2"
                                                style="width: 100%;" required>
                                                <option value="" selected="selected">{{__('Select one')}}</option>
                                                @foreach($categorias as $categoria)

                                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>

                                                @endforeach

                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label>{{__('Sub-Category')}}</label>
                                            <select name="sub_category_id" id="sub_category_id"
                                                class="form-control select2" style="width: 100%;" v-if="subcategories.length != 0" required>
                                                <option value="">{{__('Select one')}}</option>
                                                <option v-for="(subcategory, index) in subcategories"
                                                    v-bind:value="index">
                                                    @{{ subcategory }}
                                                </option>
                                            </select>

                                            <select name="sub_category_id" id="sub_category_id"
                                                class="form-control select2" style="width: 100%;" v-else disabled required>
                                                <option value="">{{__('Select one')}}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>{{__('Main-Category')}}</label>
                                            <select name="main_category_id" id="main_category_id"
                                                class="form-control select2" style="width: 100%;" v-if="maincategories.length != 0" required>
                                                <option value="">{{__('Select one')}}</option>
                                                <option v-for="(maincategory, index) in maincategories"
                                                    v-bind:value="index">
                                                    @{{ maincategory }}
                                                </option>
                                            </select>

                                            <select name="main_category_id" id="main_category_id"
                                                class="form-control select2" style="width: 100%;" v-else disabled required>
                                                <option value="">{{__('Select one')}}</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label>{{__('Quantity')}}</label>
                                            <input class="form-control" type="number" id="cantidad" name="cantidad"
                                                value="0">
                                        </div>
                                    </div>


                                </div>
                                <!-- /.form-group -->

                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nombre">{{__('Brand')}}</label>
                                    <input class="form-control" type="text" name="marca" id="marca">
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">

                    </div>
                </div>

                <!-- /.card -->


                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">{{__('Prices Section')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">

                                    <label>{{__('Previous price')}}</label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input v-model="precioanterior" class="form-control" type="number"
                                            id="precioanterior" name="precioanterior" min="0" value="0" step=".01">
                                    </div>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{__('Actual price')}}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input v-model="precioactual" v-on:keyup="process()" class="form-control" type="number"
                                            id="precioactual" name="precioactual" min="0" value="0" step=".01">
                                    </div>
                                    <br>
                                    <span id="descuento">

                                        @{{generarDescuento}}

                                    </span>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('Discount rate')}}</label>
                                    <div class="input-group">
                                        <input v-model="porcentaje_descuento" class="form-control" type="number"
                                            id="porcentaje_descuento" name="porcentaje_descuento" step="any" min="0"
                                            max="100" value="0">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>

                                    <br>
                                    <div class="progress">
                                        <div id="barraprogreso" class="progress-bar" role="progressbar"
                                            v-bind:style="{width: porcentaje_descuento+'%'}" aria-valuenow="0"
                                            aria-valuemin="0" aria-valuemax="100">
                                            @{{porcentaje_descuento}}%</div>
                                    </div>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->

                        </div>
                        <!-- /.row -->

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">

                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{__('Product descriptions')}}</h3>
                            </div>
                            <div class="card-body">
                                <!-- Date dd/mm/yyyy -->
                                <div class="form-group">
                                    <label>{{__('Short description')}}:</label>

                                    <textarea class="form-control ckeditor" name="descripcion_corta"
                                        id="descripcion_corta" rows="3"></textarea>
                                </div>
                                <!-- /.form group -->

                                <div class="form-group">
                                    <label>{{__('Long description')}}:</label>

                                    <textarea class="form-control ckeditor" name="descripcion_larga"
                                        id="descripcion_larga" rows="5"></textarea>
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.col-md-6 -->


                    <div class="col-md-6">

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">{{__('Specifications and other data')}}</h3>
                            </div>
                            <div class="card-body">
                                <!-- Date dd/mm/yyyy -->
                                <div class="form-group">
                                    <label>{{__('Specifications')}}:</label>

                                    <textarea class="form-control ckeditor" name="especificaciones"
                                        id="especificaciones" rows="3"></textarea>
                                </div>
                                <!-- /.form group -->

                                <div class="form-group">
                                    <label>{{__('Data of interest')}}:</label>

                                    <textarea class="form-control ckeditor" name="datos_de_interes"
                                        id="datos_de_interes" rows="5"></textarea>
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.col-md-6 -->

                </div>
                <!-- /.row -->


                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">{{__('Images')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="form-group">
                            <label for="imagenes">{{__('Add images')}}</label>

                            <input type="file" class="form-control-file" name="imagenes[]" id="imagenes[]" multiple
                                accept="image/*">

                            <div class="description">
                                {{__('An unlimited number of files can be uploaded in this field.')}}
                                <br>
                                {{__('Limit per image of')}} 15,048 MB.
                                <br>
                                {{__('Allowed types: jpeg, jpg, png, gif, svg.')}}
                                <br>
                            </div>
                        </div>

                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">

                    </div>
                </div>
                <!-- /.card -->

                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Status</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">

                                    <select name="estado" id="estado" class="form-control select2" style="width: 100%;">
                                        @foreach($estados_productos as $estado)

                                        <!-- if the first search post that -->
                                        @if ($estado == 'Nuevo')
                                        <option value="{{ $estado }}" selected="selected">
                                            {{ $estado }}
                                        </option>
                                        @else
                                        <option value="{{ $estado }}">{{ $estado }}</option>
                                        @endif
                                        @endforeach
                                    </select>

                                </div>
                                <!-- /.form-group -->

                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6" hidden>
                                <!-- checkbox -->
                                <div class="form-group clearfix">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="activo" name="activo" checked>
                                        <label class="custom-control-label" for="activo">{{__('Active')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="sliderprincipal"
                                            name="sliderprincipal">
                                        <label class="custom-control-label" for="sliderprincipal">{{__('Appears on the main Slider')}}</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.row -->

                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                        <a class="btn btn-danger" href="{{ route('cancelar','admin.product.index') }}">Cancelar</a>

                        <input :disabled="deshabilitar_boton==1" type="submit" value="Guardar"
                            class="btn btn-primary float-right">
                    </div>
                </div>
                <!-- /.card -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

    </form>

</div>

@endsection