@extends('plantilla.tienda')

@if (isset($category))
@section('titulo', $category->nombre.' | '.__('See the Category').' | TuMiniMercado')
@else
@section('titulo', __('See All Categories').' | TuMiniMercado')
@endif

@section('estilos')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('asset/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('asset/styles/responsive.css') }}">

<!-- Ekko Lightbox -->
<link rel="stylesheet" href="{{ asset('adminlte/plugins/ekko-lightbox/ekko-lightbox.css') }}">

<style>
    /*--------- single product details -----------*/

    input:focus {
        outline: none;
    }

    .small-img-row {
        display: flex;
    }

    .small-img-col {
        flex-basis: 24%;
        cursor: pointer;
    }
</style>
@endsection

@section('scripts')
<!-- Select2 -->
<script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Ekko Lightbox -->
<script src="{{ asset('adminlte/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>

<script>
</script>
@endsection


@section('contenido')

<div class="super_container_inner">

    <div class="products">



        <!------------- single category details ---------------->
        @if (isset($category))

        <div class="container">
            <a href="{{ url('store/show-category/'.$category->slug.'') }}" class="text-success">{{$category->nombre}}</a>
        </div>

        <div class="container mt-3">

            <h1 class="font-weight-bold"><i class="nav-icon fas fa-shapes text-success"></i> {{__('All Products in')}} {{$category->nombre}}</h1>

            @if (!isset($productos[0]->id))
                <br><br><br>
                <div class="mt-5">
                    <h2>{{__('There are no products available in this category')}}</h2>
                </div>
            @endif

            <div class="row row-cols-2 row-cols-md-4">
                @foreach ($productos as $producto)
    
                <div class="col mb-4">
                    <a href="{{ url('store/show-product/'.$producto->slug.'') }}">
                        <div class="card border-success h-100">
    
    
                            @if ($producto->images->count() <= 0) <div class="product_image" style="height: 200px">
                                <img class="card-img-top img-thumbnail" src="/imagenes/boxed-bg.jpg" alt=""
                                    style="object-fit: contain; height: 100%">
                        </div>
    
                        @else
                        <div class="product_image" style="height: 200px">
                            <img class="card-img-top img-thumbnail" src="{{$producto->images->random()->url}}" alt=""
                                style="object-fit: contain; height: 100%">
                        </div>
                        @endif
                    </a>
    
                    <div class="card-header h5 bg-transparent">{{$producto->nombre}}</div>
                    <div class="card-body text-success p-2 ml-2">
                        <h5 class="card-title"></h5>
    
    
                        @if ($producto->estado == 'En Oferta')
                        <div class="product_price text-right">
                            <p class="card-text">
                                <del class="text-muted text-black-50">
                                    US${{number_format($producto->precio_anterior,2)}}
                                </del>US${{number_format($producto->precio_actual,2)}}
                            </p>
                        </div>
                        @else
                        <div class="product_price text-right">
                            <p class="card-text">
                                US${{number_format($producto->precio_actual,2)}}
                            </p>
                        </div>
                        @endif
    
                    </div>
    
                    <div class="card-footer">
                        <small class="text-muted">{{__('See all in')}} <a href="{{ url('store/show-sub-category/'.$producto->main_category->sub_category->slug.'') }}"
                                class="text-success">{{$producto->main_category->sub_category->nombre}}</a></small>
                    </div>
    
                </div>
            </div>
    
            @endforeach
        </div>

        <div class="float-right m-2">
            {{$productos->appends($_GET)->links()}}
        </div>
            


        </div>
        @endif

        <!------------- all categories ---------------->
        @if (isset($categories))
        <div class="container mt-3">
            <h1 class="font-weight-bold"><i class="nav-icon fas fa-list-alt text-success"></i> {{__('All Categories')}}</h1>

            <div class="row mt-4">
                <div class="col-md-3">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">


                        <a class="nav-link active h5" id="v-pills-{{$categories[0]->id}}-tab" data-toggle="pill"
                            href="#v-pills-{{$categories[0]->id}}" role="tab"
                            aria-controls="v-pills-{{$categories[0]->id}}"
                            aria-selected="true">{{$categories[0]->nombre}}</a>

                        @for ($i = 1; $i < count($categories); $i++) <a class="nav-link h5"
                            id="v-pills-{{$categories[$i]->id}}-tab" data-toggle="pill"
                            href="#v-pills-{{$categories[$i]->id}}" role="tab"
                            aria-controls="v-pills-{{$categories[$i]->id}}" aria-selected="false">
                            {{$categories[$i]->nombre}}</a>
                            @endfor


                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-{{$categories[0]->id}}" role="tabpanel"
                            aria-labelledby="v-pills-{{$categories[0]->id}}-tab">

                            <div class="text-center">
                                <a class="h2 font-weight-bold nav-link text-success" href="{{ url('/store/show-category/'.$categories[0]->slug.'') }}">{{__('See all in')}} {{$categories[0]->nombre}}</a>
                            </div>

                            <div class="row row-cols-1 row-cols-md-2">

                                @foreach ($categories[0]->subCategories as $subCategory)
                                <div class="col mb-4">
                                    <div class="card border-success h-100">
                                        <div class="card-header h4">{{$subCategory->nombre}}</div>
                                        <div class="card-body text-success">
                                            <h5 class="card-title"></h5>
                                            <p class="card-text" style="margin-bottom: -10px">
                                                @isset($sub_categories[($subCategory->id)-1])
                                                @foreach ($sub_categories[($subCategory->id)-1]->mainCategories as $mainCategory)
                                                    <a class="btn btn-outline-success mb-2" style="white-space: break-spaces;text-align: left" href="{{ url('store/show-main-category/'.$mainCategory->slug.'') }}">{{$mainCategory->nombre}}</a>
                                                @endforeach
                                                @endisset
                                                </p>
                                        </div>
                                        <div class="card-footer">
                                            <small class="text-muted">{{__('See all in')}} 
                                                <a class="text-success font-weight-bold" href="{{ url('store/show-sub-category/'.$subCategory->slug.'') }}">
                                                    {{$subCategory->nombre}}
                                                </a>
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                @endforeach

                            </div>
                        </div>

                        @for ($i = 1; $i < count($categories); $i++) <div class="tab-pane fade"
                            id="v-pills-{{$categories[$i]->id}}" role="tabpanel"
                            aria-labelledby="v-pills-{{$categories[$i]->id}}-tab">

                            <div class="text-center">
                                <a class="h2 font-weight-bold nav-link text-success" href="{{ url('/store/show-category/'.$categories[$i]->slug.'') }}">{{__('See all in')}} {{$categories[$i]->nombre}}</a>
                            </div>

                            <div class="row row-cols-1 row-cols-md-2">

                                @foreach ($categories[$i]->subCategories as $subCategory)
                                
                                
                                <div class="col mb-4">
                                    <div class="card border-success h-100">
                                        <div class="card-header h4">{{$subCategory->nombre}}</div>
                                        <div class="card-body text-success">
                                            <h5 class="card-title"></h5>
                                            <p class="card-text" style="margin-bottom: -10px">
                                            @isset($sub_categories[($subCategory->id)-1])
                                            @foreach ($sub_categories[($subCategory->id)-1]->mainCategories as $mainCategory)
                                                <a class="btn btn-outline-success mb-2" style="white-space: break-spaces;text-align: left" href="{{ url('store/show-main-category/'.$mainCategory->slug.'') }}">{{$mainCategory->nombre}}</a>
                                            @endforeach
                                            @endisset
                                            </p>
                                            
                                        </div>
                                        <div class="card-footer">
                                            <small class="text-muted">{{__('See all in')}} 
                                                <a class="text-success font-weight-bold" href="{{ url('store/show-sub-category/'.$subCategory->slug.'') }}">
                                                    {{$subCategory->nombre}}
                                                </a>
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                @endforeach

                            </div>
                    </div>
                    @endfor



                </div>
            </div>


        </div>

    </div>
    @endif
</div>
</div>

@endsection