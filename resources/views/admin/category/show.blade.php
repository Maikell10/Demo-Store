@extends('plantilla.admin')

@section('titulo',__('See Category'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.category.index')}}">{{__('Categories')}}</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('scripts')
<script>
    $('#slidCat').addClass('menu-open');
    $('#slidCat>a').addClass('active');
</script>
@endsection

@section('contenido')


<div id="apicategory">
    <form>
        @csrf

        <span id="editar" hidden>{{$editar}}</span>
        <span id="nombretemp" hidden>{{$cat->nombre}}</span>
        <!-- Default box -->
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title">{{__('Categories Administration')}}</h3>

                
            </div>
            <div class="card-body">


                <div class="container">

                    <h2 class="mb-4">{{__('See Sub-Categories of')}} <font class="font-weight-bold">{{$cat->nombre}}</font></h2>


                    <div class="row row-cols-1 row-cols-md-2">
                        @foreach ($cat->subCategories as $subCategory)
                        <div class="col mb-4">
                            <div class="card border-success h-100">
                                <div class="card-header h4">{{$subCategory->nombre}}</div>
                                <div class="card-body text-success">
                                    <h5 class="card-title"></h5>
                                    <p class="card-text" style="margin-bottom: -10px">
                                        @foreach ($subCategory->mainCategories as $mainCategory)
                                            <a class="btn btn-outline-success mb-2" style="white-space: break-spaces;text-align: left" href="">{{$mainCategory->nombre}}</a>
                                        @endforeach
                                        </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                </div>


            </div>
            <!-- /.card-body -->

            @can('haveaccess', 'category.edit')
            <div class="card-footer">
                <a href="{{route('cancelar','admin.category.index')}}" class="btn btn-danger">{{__('Cancel')}}</a>

                <a href="{{route('admin.category.edit',$cat->slug)}}" class="btn btn-outline-success float-right">{{__('Edit')}}</a>
            </div>
            @endcan
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
    </form>
</div>
@endsection