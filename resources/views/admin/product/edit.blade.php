@extends('plantilla.admin')


@section('titulo', __('Edit Product'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.product.index')}}">{{__('Products')}}</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('estilos')
<!-- Select2 -->
<link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- Ekko Lightbox -->
<link rel="stylesheet" href="/adminlte/plugins/ekko-lightbox/ekko-lightbox.css">
@endsection

@section('scripts')
<!-- Select2 -->
<script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>

<script src="/adminlte/ckeditor/ckeditor.js"></script>

<!-- Ekko Lightbox -->
<script src="/adminlte/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>

<script>
    window.data = {
        editar: 'Si',
        datos: {
            "nombre":"{{$producto->nombre}}",
            "precioactual":"{{$producto->precio_actual}}",
            "precioanterior":"{{$producto->precio_anterior}}",
            "porcentaje_descuento":"{{$producto->porcentaje_descuento}}"
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

        //usando lightbox
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });
    });

    $('#slidProd').addClass('menu-open');
    $('#slidProd>a').addClass('active');
</script>
@endsection


@section('contenido')

<div id="apiproduct">
    <input type="text" value="{{config('app.locale')}}" id="lang" hidden>
    
    <form action="{{ route('admin.product.update',$producto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

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

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>{{__('Category')}}</label>
                                        <select name="category_id" id="category_id" v-model="selected_category"
                                            v-on:change="loadSubCategories" class="form-control select2"
                                            style="width: 100%;">
                                            @foreach($categorias as $categoria)

                                            <!-- if the first search post that -->
                                            @if ($categoria->id == $producto->main_category->sub_category->category_id)
                                            <option value="{{ $categoria->id }}" selected>
                                                {{ $categoria->nombre }}
                                            </option>
                                            @else
                                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                            @endif
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>{{__('Sub-Category')}}</label>
                                        <select name="sub_category_id" id="sub_category_id" class="form-control select2"
                                            style="width: 100%;">
                                            <option value="">{{__('Select an option')}}</option>

                                            <template v-for="(subcategory, index) in subcategories">
                                                <option v-bind:value="index" v-if="index == {{$producto->main_category->sub_category_id}}" selected>
                                                    @{{ subcategory }}
                                                </option>
                                                <option v-else v-bind:value="index">
                                                    @{{ subcategory }}
                                                </option>
                                            </template>
                                        </select>
                                        <input type="text" name="subcategoryid" id="subcategoryid" value="{{$producto->main_category->sub_category_id}}" hidden>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>{{__('Main-Category')}}</label>
                                        <select name="main_category_id" id="main_category_id" class="form-control select2"
                                            style="width: 100%;" required>
                                            <option value="">{{__('Select an option')}}</option>

                                            <template v-for="(maincategory, index) in maincategories">
                                                <option v-bind:value="index" v-if="index == {{$producto->main_category->id}}" selected>
                                                    @{{ maincategory }}
                                                </option>
                                                <option v-else v-bind:value="index">
                                                    @{{ maincategory }}
                                                </option>
                                            </template>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label>{{__('Quantity')}}</label>
                                        <input class="form-control" type="number" id="cantidad" name="cantidad"
                                            value="{{$producto->cantidad}}">
                                    </div>
                                </div>


                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nombre">{{__('Brand')}}</label>
                                    <input class="form-control" type="text" name="marca" id="marca" value="{{$producto->marca}}">
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
                                    <div class="progress" style="height:25px;border-radius: 3px">
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
                                        id="descripcion_corta" rows="3">
                                    {!!$producto->descripcion_corta!!}
                                    </textarea>
                                </div>
                                <!-- /.form group -->

                                <div class="form-group">
                                    <label>{{__('Long description')}}:</label>

                                    <textarea class="form-control ckeditor" name="descripcion_larga"
                                        id="descripcion_larga" rows="5">
                                        {!!$producto->descripcion_larga!!}
                                    </textarea>
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
                                        id="especificaciones" rows="3">
                                        {!!$producto->especificaciones!!}
                                    </textarea>
                                </div>
                                <!-- /.form group -->

                                <div class="form-group">
                                    <label>{{__('Data of interest')}}:</label>

                                    <textarea class="form-control ckeditor" name="datos_de_interes"
                                        id="datos_de_interes" rows="5">
                                        {!!$producto->datos_de_interes!!}
                                    </textarea>
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
                            <label for="imagenes">{{__('Add Images')}}</label>

                            <input type="file" class="form-control-file" name="imagenes[]" id="imagenes[]" multiple
                                accept="image/*">

                            <div class="description">
                                {{__('An unlimited number of files can be uploaded in this field.')}}
                                <br>
                                {{__('Limit per image of')}} <font class="font-weight-bold">15,048 MB</font>
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





                <div class="card card-primary">
                    <div class="card-header">
                        <div class="card-title">
                            {{__('Image gallery')}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            @foreach ($producto->images as $image)
                            <div id="idimagen-{{$image->id}}" class="col-sm-2">
                                <a href="{{$image->url}}" data-toggle="lightbox" data-title="{{$producto->nombre}}"
                                    data-gallery="gallery">
                                    <img style="width: 150px;height: 150px;" src="{{$image->url}}"
                                        class="img-fluid mb-2" />
                                </a>
                                <br>
                                <a href="{{$image->url}}" v-on:click.prevent="eliminarImagen({{$image}})">
                                    <i class="fas fa-trash-alt" style="color: red"></i>
                                </a>

                                <a href="{{route('admin.ImageRotateLeft',$image)}}" style="margin-left: 90px">
                                    <i class="fas fa-undo text-navy"></i>
                                </a>
                                <a href="{{route('admin.ImageRotateRight',$image)}}" class="ml-1">
                                    <i class="fas fa-redo text-secondary"></i>
                                </a>
                            </div>


                            @endforeach

                        </div>
                    </div>
                </div>









                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">{{__('Administration')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label>{{__('Status')}}</label>
                                    <select name="estado" id="estado" class="form-control select2" style="width: 100%;">
                                        @foreach($estados_productos as $estado)

                                        <!-- if the first search post that -->
                                        @if ($estado == $producto->estado)
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

                            @if (auth()->user()->id == 1)
                            <div class="col-sm-6">
                                <!-- checkbox -->
                                <div class="form-group clearfix">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="activo" name="activo"
                                            @if ($producto->activo=='Si')
                                        checked
                                        @endif>
                                        <label class="custom-control-label" for="activo">{{__('Active')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="sliderprincipal"
                                            name="sliderprincipal" @if ($producto->sliderprincipal=='Si')
                                        checked
                                        @endif>
                                        <label class="custom-control-label" for="sliderprincipal">{{__('Appears on the main Slider')}}</label>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="col-sm-6">
                                <!-- checkbox -->
                                <div class="form-group clearfix">
                                    <label>{{__('Select if the Product is Active or Not')}}</label>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="activo" name="activo"
                                            @if ($producto->activo=='Si')
                                        checked
                                        @endif>
                                        <label class="custom-control-label" for="activo">{{__('Active')}}</label>
                                    </div>
                                </div>

                                <div class="form-group" hidden>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="sliderprincipal"
                                            name="sliderprincipal" @if ($producto->sliderprincipal=='Si')
                                        checked
                                        @endif>
                                        <label class="custom-control-label" for="sliderprincipal">{{__('Appears on the main Slider')}}</label>
                                    </div>
                                </div>
                            </div>
                            @endif
                            

                        </div>
                        <!-- /.row -->

                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                        <a class="btn btn-danger" href="{{ route('cancelar','admin.product.index') }}">{{__('Cancel')}}</a>

                        <input :disabled="deshabilitar_boton==1" type="submit" value="{{__('Save')}}"
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