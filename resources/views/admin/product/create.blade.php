@extends('plantilla.admin')


@section('titulo', 'Crear Producto')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.product.index')}}">Productos</a></li>
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

    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->

                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Datos generados automáticamente</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label>Visitas</label>
                                    <input class="form-control" type="number" id="visitas" name="visitas">

                                </div>
                                <!-- /.form-group -->

                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label>Ventas</label>
                                    <input class="form-control" type="number" id="ventas" name="ventas">
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
                <!-- /.card -->


                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Datos del producto</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label for="nombre">Nombre</label>
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
                                            <label>Categoria</label>
                                            <select name="category_id" id="category_id" class="form-control select2"
                                                style="width: 100%;" required>
                                                <option value="" selected="selected">Selecciona una</option>
                                                @foreach($categorias as $categoria)

                                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>

                                                @endforeach

                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label>Sub-Categoria</label>
                                            <select name="sub_category_id" id="sub_category_id"
                                                class="form-control select2" style="width: 100%;" v-if="subcategories.length != 0" required>
                                                <option value="">Selecciona una</option>
                                                <option v-for="(subcategory, index) in subcategories"
                                                    v-bind:value="index">
                                                    @{{ subcategory }}
                                                </option>
                                            </select>

                                            <select name="sub_category_id" id="sub_category_id"
                                                class="form-control select2" style="width: 100%;" v-else disabled required>
                                                <option value="">Selecciona una</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Categoría Principal</label>
                                            <select name="main_category_id" id="main_category_id"
                                                class="form-control select2" style="width: 100%;" v-if="maincategories.length != 0" required>
                                                <option value="">Selecciona una</option>
                                                <option v-for="(maincategory, index) in maincategories"
                                                    v-bind:value="index">
                                                    @{{ maincategory }}
                                                </option>
                                            </select>

                                            <select name="main_category_id" id="main_category_id"
                                                class="form-control select2" style="width: 100%;" v-else disabled required>
                                                <option value="">Selecciona una</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label>Cantidad</label>
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

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">

                    </div>
                </div>

                <!-- /.card -->


                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Sección de Precios</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">

                                    <label>Precio anterior</label>

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
                                    <label>Precio actual</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input v-model="precioactual" class="form-control" type="number"
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
                                    <label>Porcentaje de descuento</label>
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
                                <h3 class="card-title">Descripciones del producto</h3>
                            </div>
                            <div class="card-body">
                                <!-- Date dd/mm/yyyy -->
                                <div class="form-group">
                                    <label>Descripción corta:</label>

                                    <textarea class="form-control ckeditor" name="descripcion_corta"
                                        id="descripcion_corta" rows="3"></textarea>
                                </div>
                                <!-- /.form group -->

                                <div class="form-group">
                                    <label>Descripción larga:</label>

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
                                <h3 class="card-title">Especificaciones y otros datos</h3>
                            </div>
                            <div class="card-body">
                                <!-- Date dd/mm/yyyy -->
                                <div class="form-group">
                                    <label>Especificaciones:</label>

                                    <textarea class="form-control ckeditor" name="especificaciones"
                                        id="especificaciones" rows="3"></textarea>
                                </div>
                                <!-- /.form group -->

                                <div class="form-group">
                                    <label>Datos de interes:</label>

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
                        <h3 class="card-title">Imágenes</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="form-group">
                            <label for="imagenes">Añadir imágenes</label>

                            <input type="file" class="form-control-file" name="imagenes[]" id="imagenes[]" multiple
                                accept="image/*">

                            <div class="description">
                                Un número ilimitado de archivos pueden ser cargados en este campo.
                                <br>
                                Límite de 15,048 MB por imagen.
                                <br>
                                Tipos permitidos: jpeg, jpg, png, gif, svg.
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
                        <h3 class="card-title">Administración</h3>
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
                            <div class="col-sm-6">
                                <!-- checkbox -->
                                <div class="form-group clearfix">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="activo" name="activo">
                                        <label class="custom-control-label" for="activo">Activo</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="sliderprincipal"
                                            name="sliderprincipal">
                                        <label class="custom-control-label" for="sliderprincipal">Aparece en el Slider
                                            principal</label>
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