@extends('plantilla.admin')


@section('titulo', __('See Product'))

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
            "precioanterior":"{{$producto->precio_anterior}}",
            "porcentaje_descuento":"{{$producto->porcentaje_descuento}}"
        }
    }


    $(function () {
        //Initialize Select2 Elements
        $('#category_id').select2();
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

    <form>
        @csrf

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->

                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">{{__('Automatically generated data')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label>{{__('Visits')}}</label>
                                    <input class="form-control" type="number" id="visitas" name="visitas" readonly
                                        value="{{$producto->visitas}}">

                                </div>
                                <!-- /.form-group -->

                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label>{{__('Sales')}}</label>
                                    <input class="form-control" type="number" id="ventas" name="ventas" readonly
                                        value="{{$producto->ventas}}">
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
                        <h3 class="card-title">{{__('Product data')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label for="nombre">{{__('Name')}}</label>
                                    <input v-model="nombre" readonly @blur="getProduct" @focus='div_aparecer=false'
                                        class="form-control" type="text" name="nombre">

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
                                            <select disabled name="category_id" id="category_id" class="form-control select2" style="width: 100%;">
                                                @foreach($categorias as $categoria)

                                                <!-- if the first search post that -->
                                                @if ($categoria->id == $producto->main_category->sub_category->category_id)
                                                <option value="{{ $categoria->id }}" selected="selected">
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
                                            <select disabled name="sub_category_id" id="sub_category_id" class="form-control select2" style="width: 100%;">
                                                @foreach($sub_categorias as $sub_categoria)

                                                <!-- if the first search post that -->
                                                @if ($sub_categoria->id == $producto->sub_category_id)
                                                <option value="{{ $sub_categoria->id }}" selected="selected">
                                                    {{ $sub_categoria->nombre }}
                                                </option>
                                                @else
                                                <option value="{{ $sub_categoria->id }}">{{ $sub_categoria->nombre }}</option>
                                                @endif
                                                @endforeach

                                            </select>
                                            <input type="text" name="subcategoryid" id="subcategoryid" value="{{$producto->main_category->sub_category_id}}" hidden>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>{{__('Main-Category')}}</label>
                                            <select disabled name="main_category_id" id="main_category_id" class="form-control select2" style="width: 100%;">
                                                @foreach($main_categorias as $main_categoria)

                                                <!-- if the first search post that -->
                                                @if ($main_categoria->id == $producto->main_category_id)
                                                <option value="{{ $main_categoria->id }}" selected="selected">
                                                    {{ $main_categoria->nombre }}
                                                </option>
                                                @else
                                                <option value="{{ $main_categoria->id }}">{{ $main_categoria->nombre }}</option>
                                                @endif
                                                @endforeach

                                            </select>
                                            <input type="text" name="subcategoryid" id="subcategoryid" value="{{$producto->main_category->sub_category_id}}" hidden>
                                        </div>

                                        <div class="col-md-6">
                                            <label>{{__('Quantity')}}</label>
                                            <input readonly class="form-control" type="number" id="cantidad" name="cantidad"
                                                value="{{$producto->cantidad}}">
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
                                        <input readonly v-model="precioanterior" class="form-control" type="number"
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
                                        <input readonly v-model="precioactual" class="form-control" type="number"
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
                                        <input readonly v-model="porcentaje_descuento" class="form-control" type="number"
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

                                    <textarea readonly class="form-control ckeditor" name="descripcion_corta"
                                        id="descripcion_corta" rows="3">
                                    {!!$producto->descripcion_corta!!}
                                    </textarea>
                                </div>
                                <!-- /.form group -->

                                <div class="form-group">
                                    <label>{{__('Long description')}}:</label>

                                    <textarea readonly class="form-control ckeditor" name="descripcion_larga"
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

                                    <textarea readonly class="form-control ckeditor" name="especificaciones"
                                        id="especificaciones" rows="3">
                                        {!!$producto->especificaciones!!}
                                    </textarea>
                                </div>
                                <!-- /.form group -->

                                <div class="form-group">
                                    <label>{{__('Data of interest')}}:</label>

                                    <textarea readonly class="form-control ckeditor" name="datos_de_interes"
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
                                    <select disabled name="estado" id="estado" class="form-control select2" style="width: 100%;">
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
                            <div class="col-sm-6">
                                <!-- checkbox -->
                                <div class="form-group clearfix">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" disabled class="custom-control-input" id="activo" name="activo"
                                            @if ($producto->activo=='Si')
                                        checked
                                        @endif>
                                        <label class="custom-control-label" for="activo">{{__('Active')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" disabled class="custom-control-input" id="sliderprincipal"
                                            name="sliderprincipal" @if($producto->sliderprincipal=='Si')
                                        checked
                                        @endif>
                                        <label class="custom-control-label" for="sliderprincipal">{{__('Appears on the main Slider')}}</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.row -->

                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                        <a class="btn btn-danger" href="{{ route('cancelar','admin.product.index') }}">{{__('Cancel')}}</a>

                        <a href="{{route('admin.product.edit',$producto->slug)}}" class="btn btn-outline-success float-right">{{__('Edit')}}</a>
                    </div>
                </div>
                <!-- /.card -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

    </form>

</div>

@endsection