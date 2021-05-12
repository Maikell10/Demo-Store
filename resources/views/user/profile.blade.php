@extends('plantilla.tienda')

@section('titulo','Perfil | TuMiniMercado')

@section('estilos')

<link rel="stylesheet" type="text/css" href="{{ asset('asset/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('asset/styles/responsive.css') }}">

@endsection

@section('scripts')
<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    $('#menuProfile').addClass('active');
</script>
@endsection

@section('contenido')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (session('datos'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{session('datos')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session('fail'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{session('fail')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="super_container_inner">
    <div class="container-fluid mt-3">
        <div class="card">
            <div class="card-header text-center bg-white">
                <h1 class="h1">{{__('Profile')}}</h1>
            </div>
            <div class="card-body">

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4 col-xl-3">

                                <!-- Profile Image -->
                                <div class="card card-success card-outline">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            <a class="" href="#" role="button" data-toggle="modal"
                                                data-target="#profilePictureModal">
                                                @if (auth()->user()->social_image() != 'no hay img')
                                                <img src="{{auth()->user()->social_image()}}"
                                                    class="profile-user-img img-fluid img-circle elevation-2"
                                                    alt="User Image"
                                                    style="height: 100px; width: 100px; object-fit: cover"
                                                    data-toggle="tooltip" data-placement="bottom"
                                                    title="{{ __('Change your profile picture') }}">
                                                @else
                                                @if (isset(Auth::user()->image->url))
                                                <img src="{{ Auth::user()->image->url }}"
                                                    class="profile-user-img img-fluid img-circle elevation-2"
                                                    alt="User Image"
                                                    style="height: 100px; width: 100px; object-fit: cover"
                                                    data-toggle="tooltip" data-placement="bottom"
                                                    title="{{ __('Change your profile picture') }}">
                                                @else
                                                <img src="{{ asset('adminlte/dist/img/avatardefault.png') }}"
                                                    class="profile-user-img img-fluid img-circle elevation-2"
                                                    alt="User Image" data-toggle="tooltip" data-placement="bottom"
                                                    title="{{ __('Change your profile picture') }}">
                                                @endif
                                                @endif
                                            </a>
                                        </div>

                                        @if (Auth::user()->verified == 1)
                                            <h3 class="profile-username text-center">{{ Auth::user()->name }} <img src="{{asset('asset/images/verified-account.png')}}" style="width: 30px" data-toggle="tooltip" data-placement="right" title="{{ __('Verified') }}" /></h3>
                                        @else
                                            <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
                                        @endif

                                        <ul class="list-group list-group-unbordered mb-3">
                                            <li class="list-group-item">
                                                <b>{{ __('Shopping') }}</b> <a class="float-right">{{$sales_count}}</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>{{ __('Positive Ratings') }}</b> <a
                                                    class="float-right">{{$positive_rating}}</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>{{ __('Neutral Ratings') }}</b> <a
                                                    class="float-right">{{$neutral_rating}}</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>{{ __('Negative Ratings') }}</b> <a
                                                    class="float-right">{{$negative_rating}}</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>{{ __('Comments') }}</b> <a
                                                    class="float-right">{{$comments->count()}}</a>
                                            </li>
                                        </ul>

                                        <h5 class="profile-username text-center h6">
                                            {{__('Joined to TuMiniMercado On:')}} <font class="font-weight-bold">
                                                {{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('d/m/Y') }}
                                            </font>
                                        </h5>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->

                                <!-- Store Route -->
                                @if (Auth::user()->sale == 1)
                                <div class="card card-warning card-outline">
                                    <div class="card-body box-profile">
                                        <a href="{{ url('commerce/'.Auth::user()->name.'') }}"
                                            class="btn btn-warning btn-lg btn-block">{{__('See Store')}}</a>
                                    </div>
                                </div>
                                @endif
                                <!-- /.card -->

                            </div>
                            <!-- /.col -->
                            <div class="col-md-8 col-xl-9" id="apiProfileUser">
                                <div class="card">
                                    <div class="card-header p-2">
                                        <ul class="nav nav-pills">
                                            <li class="nav-item"><a class="nav-link active" href="#activity"
                                                    data-toggle="tab">{{ __('Activity') }}</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#settings"
                                                    data-toggle="tab">{{ __('Settings') }}</a></li>
                                        </ul>
                                    </div><!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="active tab-pane" id="activity">
                                                
                                                @if ($activities != '[]')
                                                @foreach ($activities as $activity)

                                                <!-- Post Ratings -->
                                                @if ($activity['type'] == 'rating')
                                                <div class="post">
                                                    <div class="user-block">
                                                        @if (auth()->user()->social_image() != 'no hay img')
                                                        <img src="{{auth()->user()->social_image()}}"
                                                            class="img-circle img-bordered-sm elevation-2"
                                                            alt="User Image"
                                                            style="max-height: 40px; width: 40px; object-fit: cover">
                                                        @else
                                                        @if (isset(Auth::user()->image->url))
                                                        <img src="{{ Auth::user()->image->url }}"
                                                            class="img-circle img-bordered-sm elevation-2"
                                                            alt="User Image"
                                                            style="max-height: 40px; width: 40px; object-fit: cover">
                                                        @else
                                                        <img src="{{ asset('adminlte/dist/img/avatardefault.png') }}"
                                                            class="img-circle img-bordered-sm elevation-2"
                                                            alt="User Image">
                                                        @endif
                                                        @endif

                                                        <span class="username">
                                                            <a href="{{route('profile.user',Auth::user()->name)}}">{{ Auth::user()->name }}</a>
                                                        </span>
                                                        <span class="description text-purple">{{__('Product Rating')}} -
                                                            {{ \Carbon\Carbon::parse($activity['created_at'])->diffForHumans() }}</span>
                                                    </div>
                                                    <!-- /.user-block -->
                                                    <p>
                                                        <a href="{{route('profile.user',Auth::user()->name)}}" class="alert-link">{{ Auth::user()->name }}</a>
                                                        {{__('rated the product:')}} <a
                                                            href="{{ url('store/show-product/'.$activity['body']->products->slug.'') }}"
                                                            class="alert-link">{{$activity['body']->products->nombre}}</a> {{__('with')}}
                                                        <font class="font-weight-bold">{{$activity['body']->rating}} <i class="fa fa-star"></i></font>
                                                    </p>
                                                </div>
                                                @endif

                                                <!-- Post Comments -->
                                                @if ($activity['type'] == 'comment')
                                                <div class="post">
                                                    <div class="user-block">
                                                        @if (auth()->user()->social_image() != 'no hay img')
                                                        <img src="{{auth()->user()->social_image()}}"
                                                            class="img-circle img-bordered-sm elevation-2"
                                                            alt="User Image"
                                                            style="max-height: 40px; width: 40px; object-fit: cover">
                                                        @else
                                                        @if (isset(Auth::user()->image->url))
                                                        <img src="{{ Auth::user()->image->url }}"
                                                            class="img-circle img-bordered-sm elevation-2"
                                                            alt="User Image"
                                                            style="max-height: 40px; width: 40px; object-fit: cover">
                                                        @else
                                                        <img src="{{ asset('adminlte/dist/img/avatardefault.png') }}"
                                                            class="img-circle img-bordered-sm elevation-2"
                                                            alt="User Image">
                                                        @endif
                                                        @endif

                                                        <span class="username">
                                                            <a href="{{route('profile.user',Auth::user()->name)}}">{{ Auth::user()->name }}</a>
                                                        </span>
                                                        <span class="description text-orange">{{__('Question')}} -
                                                            {{ \Carbon\Carbon::parse($activity['created_at'])->diffForHumans() }}</span>
                                                    </div>
                                                    <!-- /.user-block -->
                                                    <p>
                                                        <a href="{{route('profile.user',Auth::user()->name)}}" class="alert-link">{{ Auth::user()->name }}</a> {{__('asked a question about the product:')}} <a
                                                            href="{{ url('store/show-product/'.$activity['body']->products->slug.'') }}"
                                                            class="alert-link">{{$activity['body']->products->nombre}}</a>
                                                    </p>
                                                </div>
                                                @endif

                                                <!-- Post Rating Stores -->
                                                @if ($activity['type'] == 'rating_store')
                                                <div class="post">
                                                    <div class="user-block">
                                                        @if (auth()->user()->social_image() != 'no hay img')
                                                        <img src="{{auth()->user()->social_image()}}"
                                                            class="img-circle img-bordered-sm elevation-2"
                                                            alt="User Image"
                                                            style="max-height: 40px; width: 40px; object-fit: cover">
                                                        @else
                                                        @if (isset(Auth::user()->image->url))
                                                        <img src="{{ Auth::user()->image->url }}"
                                                            class="img-circle img-bordered-sm elevation-2"
                                                            alt="User Image"
                                                            style="max-height: 40px; width: 40px; object-fit: cover">
                                                        @else
                                                        <img src="{{ asset('adminlte/dist/img/avatardefault.png') }}"
                                                            class="img-circle img-bordered-sm elevation-2"
                                                            alt="User Image">
                                                        @endif
                                                        @endif

                                                        <span class="username">
                                                            <a href="{{route('profile.user',Auth::user()->name)}}">{{ Auth::user()->name }}</a>
                                                        </span>
                                                        <span class="description text-success">{{__('Seller Rating')}} -
                                                            {{ \Carbon\Carbon::parse($activity['created_at'])->diffForHumans() }}</span>
                                                    </div>
                                                    <!-- /.user-block -->
                                                    <p>
                                                        <a href="{{route('profile.user',Auth::user()->name)}}" class="alert-link">{{ Auth::user()->name }}</a> {{__('rated the seller:')}} <a
                                                            href="{{ url('commerce/'.$activity['body']->store->name.'') }}"
                                                            class="alert-link">{{$activity['body']->store->name}}</a>
                                                            {{__('with')}} 
                                                            @if ($activity['body']->rating == '+')
                                                            <font class="font-weight-bold text-primary">{{__('Positive')}}</font>
                                                            @endif
                                                            @if ($activity['body']->rating == '-')
                                                            <font class="font-weight-bold text-danger">{{__('Negative')}}</font>
                                                            @endif
                                                            @if ($activity['body']->rating == 'N')
                                                            <font class="font-weight-bold text-yellow">Neutral</font>
                                                            @endif
                                                    </p>
                                                </div>
                                                @endif

                                                @endforeach
                                                @endif
                                                <!-- /.post -->

                                            </div>
                                            <!-- /.tab-pane -->

                                            <div class="tab-pane" id="settings">
                                                <form class="form-horizontal" action="{{ route('profile.updateUser') }}"
                                                    method="POST" id="updateUserForm">
                                                    @csrf
                                                    <div class="form-group row">
                                                        <input type="hidden" name="inputProfile" value="user">

                                                        <label for="inputName"
                                                            class="col-md-12 col-form-label">{{__('Name')}}</label>

                                                        <div class="input-group col-md-12">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1"><i
                                                                        class="fa fa-user"></i></span>
                                                            </div>
                                                            <input type="hidden" id="inputNameH"
                                                                value="{{ Auth::user()->name }}">
                                                            <input type="text"
                                                                class="form-control @error('inputName') is-invalid @enderror"
                                                                id="inputName" name="inputName"
                                                                placeholder="{{__('Name')}}" v-model="inputName">


                                                            @error('inputName')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                    <div class="form-group row">
                                                        <label for="password"
                                                            class="col-md-12 col-form-label">{{__('Password')}}</label>

                                                        <div class="input-group  col-md-12">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1"><i
                                                                        class="fa fa-lock"></i></span>
                                                            </div>
                                                            <input type="password"
                                                                class="form-control @error('password') is-invalid @enderror"
                                                                id="password" name="password"
                                                                placeholder="{{__('Password')}}">

                                                            @error('password')
                                                            @foreach ($errors->all() as $error)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $error }}</strong>
                                                            </span>
                                                            @endforeach
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="password-confirm"
                                                            class="col-md-12 col-form-label">{{ __('Confirm Password') }}</label>

                                                        <div class="input-group col-md-12">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1"><i
                                                                        class="fa fa-lock"></i></span>
                                                            </div>
                                                            <input id="password-confirm" type="password"
                                                                class="form-control @error('password-confirm') is-invalid @enderror"
                                                                name="password_confirmation" autocomplete="new-password"
                                                                placeholder="{{ __('Confirm Password') }}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" v-model="inputCheckbox"
                                                                        id="inputCheckbox" @click='setCheck()'>
                                                                    {{__('I agree to the')}} <a
                                                                        href="{{url('terminos')}}">{{__('Terms and Conditions')}}</a>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <button type="submit" disabled @click='updateUser()'
                                                                id="btnConfig"
                                                                class="btn btn-success btn-block">{{__('Edit')}}</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.tab-pane -->
                                        </div>
                                        <!-- /.tab-content -->
                                    </div><!-- /.card-body -->
                                </div>
                                <!-- /.nav-tabs-custom -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->

            </div>
        </div>
    </div>
</div>


<!-- Modal Picture -->
<div class="modal fade" id="profilePictureModal" tabindex="-1" aria-labelledby="profilePictureModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profilePictureModalLabel">{{__('Change your profile picture')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="imagenes" id="imagenes" accept="image/*"
                            style="cursor: pointer">
                        <label class="custom-file-label" for="imagenes">{{__('Choose file')}}</label>
                    </div>
                    <br>
                    <div class="description mt-3">
                        Límite de 15,048 MB permitido.
                        <br>
                        Tipos permitidos: jpeg, jpg, png, gif, svg.
                        <br>
                    </div>

                    <input type="submit" value="{{__('Upload Photo')}}" class="btn btn-outline-success btn-block mt-3">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection