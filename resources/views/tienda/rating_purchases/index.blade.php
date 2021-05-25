@extends('plantilla.tienda')

@section('titulo', 'Shopping Cart | Ver Tienda | TuMiniMercado')

@section('estilos')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('asset/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('asset/styles/responsive.css') }}">

<!-- Ekko Lightbox -->
<link rel="stylesheet" href="{{ asset('adminlte/plugins/ekko-lightbox/ekko-lightbox.css') }}">

<style>
    .home__image {
        width: 100%;
        -webkit-mask-image: linear-gradient(to bottom, rgba(0, 0, 0, 1), rgba(0, 0, 0, 0));
        z-index: -1;
        margin-bottom: -150px;
        max-height: 200px;
    }

    .products {
        padding-top: 0px;
    }

    .product_name {
        max-width: none;
    }

    .direct-chat-messages::-webkit-scrollbar {
        width: 10px;
    }

    /* Estilos barra (thumb) de scroll */
    .direct-chat-messages::-webkit-scrollbar-thumb {
        background: #4bc57d;
        border-radius: 4px;
    }

    .direct-chat-messages::-webkit-scrollbar-thumb:hover {
        background: #4d8b05;
        box-shadow: 0 0 2px 1px rgba(0, 0, 0, 0.2);
    }

    /* Estilos track de scroll */
    .direct-chat-messages::-webkit-scrollbar-track {
        background: rgb(190, 189, 189);
        border-radius: 4px;
    }

    .direct-chat-messages::-webkit-scrollbar-track:hover,
    .direct-chat-messages::-webkit-scrollbar-track:active {
        background: rgb(153, 152, 152);
    }
</style>
@endsection

@section('scripts')
<!-- Select2 -->
<script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Ekko Lightbox -->
<script src="{{ asset('adminlte/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>

<script>
    $(function () {
        //Initialize Select2 Elements
        //$('#cantidad').select2();


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

    
</script>
@endsection


@section('contenido')

<div class="super_container_inner" id="apiratingfinalclient">
    <input type="text" value="{{config('app.locale')}}" id="lang" hidden>

    <div class="products">
        <div class="container-fluid">
            <img class="home__image" src="{{asset('asset/images/banner.jpg')}}" alt="" />


            <h1 class="home_subtitle font-weight-bold mt-2 mb-5"><i
                    class="nav-icon fas fa-shopping-bag text-success"></i>
                {{__('Purchases')}}
            </h1>
            

            <div class="row m-0">
                <div class="col-md-3">

                    <!-- Nº Order Card -->
                    <div class="card card-success card-outline">
                        <div class="card-body box-profile">
                            
                            <h3 class="profile-username text-center">{{__('Order Nº:')}}</h3>
                            <!-- dia año / dia mes / año / hora / minutos / segundos -->
                            <h3 class="profile-username text-center text-muted">
                                {{$order_id}}
                            </h3>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- Rating Purchase -->
                    <div class="card card-success card-outline">
                        <div class="card-body box-profile text-center">
                            
                            <h3 class="profile-username text-center">{{__('Rate the Seller:')}}</h3>
                            <a href="{{route('tienda.commerce.show', $user_store[0]->name)}}">
                                <h3 class="profile-username text-center text-success">{{$user_store[0]->name}}</h3>
                            </a>
                            <input type="text" id="store_id" value="{{$user_store[0]->id}}" hidden>
                            <input type="text" id="user_id" value="{{$user->id}}" hidden>
                            <input type="text" id="type_rating" value="USER" hidden>
                            <input type="text" id="created_sale" value="{{$request->created}}" hidden>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>

                <div class="col-md-9" v-if="part == '1'">
                    <div class="card card-success card-outline">
                        <div class="card-body">

                            <!-- Post -->
                            <div class="post">
                                <div class="user-block">
                                    @if ($user_store[0]->social_image() != 'no hay img')
                                    <img src="{{$user_store[0]->social_image()}}"
                                        class="img-circle img-bordered-sm elevation-2" alt="User Image"
                                        style="max-height: 40px; width: 40px; object-fit: cover">
                                    @else
                                    @if (isset($user_store[0]->image->url))
                                    <img src="{{ $user_store[0]->image->url }}"
                                        class="img-circle img-bordered-sm elevation-2" alt="User Image"
                                        style="max-height: 40px; width: 40px; object-fit: cover">
                                    @else
                                    <img src="{{ asset('adminlte/dist/img/avatardefault.png') }}"
                                        class="img-circle img-bordered-sm elevation-2" alt="User Image">
                                    @endif
                                    @endif

                                    <span class="username">
                                        <a href="#">
                                            {{ $user_store[0]->name }}
                                        </a>
                                        @if ($user_store[0]->verified == 1)
                                            <img src="{{asset('asset/images/verified-account.png')}}" style="width: 30px;height: 30px;" class="float-none" />
                                        @endif
                                    </span>
                                    <span class="description">{{__('Rate your Purchase for this Seller:')}}</span>
                                </div>
                                <!-- /.user-block -->

                                <div>
                                    <h3>{{__('Did you receive the expected item?')}}</h3>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radioFirst" id="radioFirst1" value="option1" checked v-on:click="option1()">
                                        <label class="form-check-label" for="radioFirst1">
                                            {{__('Yes, I already have the product')}}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radioFirst" id="radioFirst2" value="option2" v-on:click="option2()">
                                        <label class="form-check-label" for="radioFirst2">
                                            {{__('I decided not to buy the item')}}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radioFirst" id="radioFirst3" value="option3" v-on:click="option3()">
                                        <label class="form-check-label" for="radioFirst3">
                                            {{__('There is a problem')}}
                                        </label>
                                    </div>

                                    <div class="form-group w-50" v-if="select == 1">
                                        <label for="selectOption">{{__('Select an option')}}</label>
                                        <select class="form-control" id="selectOption">
                                            <option>{{__('I did not receive what I bought')}}</option>
                                            <option>{{__('I received the product with defects')}}</option>
                                            <option>{{__('I have not received the product')}}</option>
                                            <option>{{__('The seller ran out of products')}}</option>
                                            <option>{{__('The seller never responded')}}</option>
                                            <option>{{__('Other')}}</option>
                                        </select>
                                    </div>

                                    <div class="mt-3">
                                        <button class="btn btn-success btn-lg" v-on:click="FirstPart()">{{__('Continue')}}</button>
                                        <a href="{{route('tienda.purchases.show',$sale[0]->created_at)}}" class="btn btn-outline-secondary">{{__('Cancel')}}</a>
                                    </div>
                                </div>
                                
                            </div>
                            <!-- /.post -->

                        </div><!-- /.card-body -->
                    </div>
                </div>

                <div class="col-md-9" v-if="part == '2'">
                    <div class="card card-success card-outline">
                        <div class="card-body">

                            <!-- Post -->
                            <div class="post">
                                <div class="user-block">
                                    @if ($user_store[0]->social_image() != 'no hay img')
                                    <img src="{{$user_store[0]->social_image()}}"
                                        class="img-circle img-bordered-sm elevation-2" alt="User Image"
                                        style="max-height: 40px; width: 40px; object-fit: cover">
                                    @else
                                    @if (isset($user_store[0]->image->url))
                                    <img src="{{ $user_store[0]->image->url }}"
                                        class="img-circle img-bordered-sm elevation-2" alt="User Image"
                                        style="max-height: 40px; width: 40px; object-fit: cover">
                                    @else
                                    <img src="{{ asset('adminlte/dist/img/avatardefault.png') }}"
                                        class="img-circle img-bordered-sm elevation-2" alt="User Image">
                                    @endif
                                    @endif

                                    <span class="username">
                                        <a href="#">{{ $user_store[0]->name }}</a>
                                        @if ($user_store[0]->verified == 1)
                                            <img src="{{asset('asset/images/verified-account.png')}}" style="width: 30px;height: 30px;" class="float-none" />
                                        @endif
                                    </span>
                                    <span class="description">{{__('Rate your Purchase for this Seller:')}}</span>
                                </div>
                                <!-- /.user-block -->

                                <div>
                                    <h3>{{__('Would you recommend the seller?')}}</h3>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radioSecond" id="radioSecond1" value="si" checked>
                                        <label class="form-check-label" for="radioSecond1">
                                            {{__('Yes')}}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radioSecond" id="radioSecond2" value="no">
                                        <label class="form-check-label" for="radioSecond2">
                                            No
                                        </label>
                                    </div>

                                    <h3 class="mt-3">{{__('Give us your opinion about the seller')}}</h3>

                                    <div class="input-group w-50">
                                        <textarea class="form-control" aria-label="With textarea" rows="4" id="opinion"></textarea>
                                    </div>

                                    <div class="mt-3">
                                        <button class="btn btn-success btn-lg" v-on:click="SecondOption()">{{__('Continue')}}</button>
                                        <button v-on:click="BackFirst()" class="btn btn-outline-secondary">{{__('Cancel')}}</button>
                                    </div>
                                </div>
                                
                            </div>
                            <!-- /.post -->

                        </div><!-- /.card-body -->
                    </div>
                </div>

                <div class="col-md-9" v-if="part == '3'">
                    <div class="card card-success card-outline">
                        <div class="card-body">

                            <!-- Post -->
                            <div class="post">
                                <div class="user-block">
                                    @if ($user_store[0]->social_image() != 'no hay img')
                                    <img src="{{$user_store[0]->social_image()}}"
                                        class="img-circle img-bordered-sm elevation-2" alt="User Image"
                                        style="max-height: 40px; width: 40px; object-fit: cover">
                                    @else
                                    @if (isset($user_store[0]->image->url))
                                    <img src="{{ $user_store[0]->image->url }}"
                                        class="img-circle img-bordered-sm elevation-2" alt="User Image"
                                        style="max-height: 40px; width: 40px; object-fit: cover">
                                    @else
                                    <img src="{{ asset('adminlte/dist/img/avatardefault.png') }}"
                                        class="img-circle img-bordered-sm elevation-2" alt="User Image">
                                    @endif
                                    @endif

                                    <span class="username">
                                        <a href="#">{{ $user_store[0]->name }}</a>
                                        @if ($user_store[0]->verified == 1)
                                            <img src="{{asset('asset/images/verified-account.png')}}" style="width: 30px;height: 30px;" class="float-none" />
                                        @endif
                                    </span>
                                    <span class="description">{{__('Rate your Purchase for this Seller:')}}</span>
                                </div>
                                <!-- /.user-block -->

                                <div>
                                    <h3>{{__('Would you recommend the seller?')}}</h3>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radioThrird" id="radioThrird1" value="si" checked>
                                        <label class="form-check-label" for="radioThrird1">
                                            {{__('Yes')}}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radioThrird" id="radioThrird2" value="no">
                                        <label class="form-check-label" for="radioThrird2">
                                            No
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radioThrird" id="radioThrird2" value="neutro">
                                        <label class="form-check-label" for="radioTrird2">
                                            {{__('Neutral')}}
                                        </label>
                                    </div>

                                    <h3 class="mt-3">{{__('Give us your opinion about the seller')}}</h3>

                                    <div class="input-group w-50">
                                        <textarea class="form-control" aria-label="With textarea" rows="4" id="opinion"></textarea>
                                    </div>

                                    <div class="mt-3">
                                        <button class="btn btn-success btn-lg" v-on:click="SecondOption()">{{__('Continue')}}</button>
                                        <button v-on:click="BackFirst()" class="btn btn-outline-secondary">{{__('Cancel')}}</button>
                                    </div>
                                </div>
                                
                            </div>
                            <!-- /.post -->

                        </div><!-- /.card-body -->
                    </div>
                </div>

                <!-- 
                <div class="col-md-9" v-if="part == '4'">
                    <div class="card card-success card-outline">
                        <div class="card-body">-->

                            <!-- Post -->
                            <!-- <div class="post">
                                <div class="user-block">
                                    @if ($user_store[0]->social_image() != 'no hay img')
                                    <img src="{{$user_store[0]->social_image()}}"
                                        class="img-circle img-bordered-sm elevation-2" alt="User Image"
                                        style="max-height: 40px; width: 40px; object-fit: cover">
                                    @else
                                    @if (isset($user_store[0]->image->url))
                                    <img src="{{ $user_store[0]->image->url }}"
                                        class="img-circle img-bordered-sm elevation-2" alt="User Image"
                                        style="max-height: 40px; width: 40px; object-fit: cover">
                                    @else
                                    <img src="{{ asset('adminlte/dist/img/avatardefault.png') }}"
                                        class="img-circle img-bordered-sm elevation-2" alt="User Image">
                                    @endif
                                    @endif

                                    <span class="username">
                                        <a href="#">{{ $user_store[0]->name }}</a>
                                    </span>
                                    <span class="description">{{__('Rate your Purchase for this Seller:')}}</span>
                                </div>-->
                                <!-- /.user-block -->

                                <!--<div>
                                    <h3>{{__('Rate the Product')}}</h3>

                                    <div class="w-25">
                                        <star-rating v-model="rating" :increment="0.5" text-class="custom-text"></star-rating>
                                    </div>
                                    

                                    <div class="mt-3">
                                        <button class="btn btn-success btn-lg" @click="setRating">{{ __('Publish') }}</button>

                                        <button v-on:click="BackSecond()" class="btn btn-outline-secondary">{{__('Cancel')}}</button>
                                    </div>
                                </div>
                                
                            </div>-->
                            <!-- /.post -->

                        <!--</div>
                    </div>
                </div>-->
                

        </div>
    </div>

</div>

@endsection