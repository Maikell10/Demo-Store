@extends('plantilla.tienda')

@section('titulo', $user->name.' | TuMiniMercado')

@section('estilos')

<link rel="stylesheet" type="text/css" href="{{ asset('asset/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('asset/styles/responsive.css') }}">

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
                                            @if ($user->social_image() != 'no hay img')
                                            <img src="{{$user->social_image()}}"
                                                class="profile-user-img img-fluid img-circle elevation-2"
                                                alt="User Image"
                                                style="height: 100px; width: 100px; object-fit: cover">
                                            @else
                                            @if (isset($user->image->url))
                                            <img src="{{ $user->image->url }}"
                                                class="profile-user-img img-fluid img-circle elevation-2"
                                                alt="User Image"
                                                style="height: 100px; width: 100px; object-fit: cover">
                                            @else
                                            <img src="{{ asset('adminlte/dist/img/avatardefault.png') }}"
                                                class="profile-user-img img-fluid img-circle elevation-2"
                                                alt="User Image">
                                            @endif
                                            @endif
                                        </div>

                                        @if ($user->verified == 1)
                                            <h3 class="profile-username text-center">{{ $user->name }} <img src="{{asset('asset/images/verified-account.png')}}" style="width: 30px" data-toggle="tooltip" data-placement="right" title="{{ __('Verified') }}" /></h3>
                                        @else
                                            <h3 class="profile-username text-center">{{ $user->name }}</h3>
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
                                                {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}
                                            </font>
                                        </h5>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->

                                <!-- Store Route -->
                                @if ($user->sale == 1)
                                <div class="card card-warning card-outline">
                                    <div class="card-body box-profile">
                                        <a href="{{ url('commerce/'.$user->name.'') }}"
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
                                        <h3 class="font-weight-bold p-1 ml-3 mt-2">{{ __('Activity') }}</h3>
                                    </div><!-- /.card-header -->
                                    <div class="card-body">
                                        <div id="activity">
                                            
                                            @if ($activities != '[]')
                                            @foreach ($activities as $activity)

                                            <!-- Post Ratings -->
                                            @if ($activity['type'] == 'rating')
                                            <div class="post">
                                                <div class="user-block">
                                                    @if ($user->social_image() != 'no hay img')
                                                    <img src="{{$user->social_image()}}"
                                                        class="img-circle img-bordered-sm elevation-2"
                                                        alt="User Image"
                                                        style="max-height: 40px; width: 40px; object-fit: cover">
                                                    @else
                                                    @if (isset($user->image->url))
                                                    <img src="{{ $user->image->url }}"
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
                                                        <a href="{{route('profile.user',$user->name)}}">{{ $user->name }}</a>
                                                    </span>
                                                    <span class="description text-purple">{{__('Product Rating')}} -
                                                        {{ \Carbon\Carbon::parse($activity['created_at'])->diffForHumans() }}</span>
                                                </div>
                                                <!-- /.user-block -->
                                                <p>
                                                    <a href="{{route('profile.user',$user->name)}}" class="alert-link">{{ $user->name }}</a>
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
                                                    @if ($user->social_image() != 'no hay img')
                                                    <img src="{{$user->social_image()}}"
                                                        class="img-circle img-bordered-sm elevation-2"
                                                        alt="User Image"
                                                        style="max-height: 40px; width: 40px; object-fit: cover">
                                                    @else
                                                    @if (isset($user->image->url))
                                                    <img src="{{ $user->image->url }}"
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
                                                        <a href="{{route('profile.user',$user->name)}}">{{ $user->name }}</a>
                                                    </span>
                                                    <span class="description text-orange">{{__('Question')}} -
                                                        {{ \Carbon\Carbon::parse($activity['created_at'])->diffForHumans() }}</span>
                                                </div>
                                                <!-- /.user-block -->
                                                <p>
                                                    <a href="{{route('profile.user',$user->name)}}" class="alert-link">{{ $user->name }}</a> {{__('asked a question about the product:')}} <a
                                                        href="{{ url('store/show-product/'.$activity['body']->products->slug.'') }}"
                                                        class="alert-link">{{$activity['body']->products->nombre}}</a>
                                                </p>
                                            </div>
                                            @endif

                                            <!-- Post Rating Stores -->
                                            @if ($activity['type'] == 'rating_store')
                                            <div class="post">
                                                <div class="user-block">
                                                    @if ($user->social_image() != 'no hay img')
                                                    <img src="{{$user->social_image()}}"
                                                        class="img-circle img-bordered-sm elevation-2"
                                                        alt="User Image"
                                                        style="max-height: 40px; width: 40px; object-fit: cover">
                                                    @else
                                                    @if (isset($user->image->url))
                                                    <img src="{{ $user->image->url }}"
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
                                                        <a href="{{route('profile.user',$user->name)}}">{{ $user->name }}</a>
                                                    </span>
                                                    <span class="description text-success">{{__('Seller Rating')}} -
                                                        {{ \Carbon\Carbon::parse($activity['created_at'])->diffForHumans() }}</span>
                                                </div>
                                                <!-- /.user-block -->
                                                <p>
                                                    <a href="{{route('profile.user',$user->name)}}" class="alert-link">{{ $user->name }}</a> {{__('rated the seller:')}} <a
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

                                            @else
                                            <h2 class="font-weight-bold text-muted">{{__('There is no Activity yet')}}</h2>
                                            @endif
                                            <!-- /.post -->

                                        </div>
                                        <!-- /.tab-pane -->
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

@endsection