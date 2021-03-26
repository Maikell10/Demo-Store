<!--Modal-->
<div class="modal fade" id="productsModal" tabindex="-1" aria-labelledby="productsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="languageModalLabel">Seleccione un Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body table-responsive">

                <div class="row mb-1">
                    <div class="col-md-8">
                        <h5 class="text-muted">Si no encuentra el Producto debe crearlo primero</h5>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{route('admin.product.create')}}" class="btn btn-outline-primary" target="__blank">Crear Producto</a>
                    </div>
                </div>

                <table id="tblproductos" class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>Opciones</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Category')}}</th>
                            <th>{{__('Quantity')}}</th>
                            <th>{{__('Image')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr class="text-center">
                            <td class="align-middle text-nowrap">
                                <button class="btn btn-warning" v-on:click="agregarDetalle('{{$product->id}}')"><span class="fa fa-plus"></span></button>
                                <a href="{{url('admin/product/' . $product->slug . '')}}" class="btn btn-primary" target="__blank"><i class="fas fa-eye"></i></a>
                            </td>
                            <td class="align-middle">{{$product->nombre}}</td>
                            <td class="align-middle">{{$product->main_category->nombre}}</td>
                            <td class="align-middle">{{$product->cantidad}}</td>
                            <td class="align-middle p-0">
                                @if ($product->images->count() <= 0) <img style="height:60px;width:60px"
                                src="/imagenes/boxed-bg.jpg" class="rounded-circle">
                                @else
                                <img style="height:60px;width:60px" src="{{$product->images->random()->url}}"
                                    class="rounded-circle">
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="text-center">
                            <th>Opciones</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Category')}}</th>
                            <th>{{__('Quantity')}}</th>
                            <th>{{__('Image')}}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" type="button" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- fin Modal-->