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
                            <div class="col-md-3">

                                <!-- Profile Image -->
                                <div class="card card-success card-outline">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            <a class="" href="#" role="button" data-toggle="modal" data-target="#profilePictureModal">
                                                @if (auth()->user()->social_image() != 'no hay img')
                                                <img src="{{auth()->user()->social_image()}}" class="profile-user-img img-fluid img-circle elevation-2" alt="User Image"
                                                style="height: 100px; width: 100px; object-fit: cover" data-toggle="tooltip" data-placement="bottom" title="{{ __('Change your profile picture') }}">
                                                @else
                                                @if (isset(Auth::user()->image->url))
                                                <img src="{{ Auth::user()->image->url }}" class="profile-user-img img-fluid img-circle elevation-2" alt="User Image"
                                                    style="height: 100px; width: 100px; object-fit: cover" data-toggle="tooltip" data-placement="bottom" title="{{ __('Change your profile picture') }}">
                                                @else
                                                <img src="{{ asset('adminlte/dist/img/avatardefault.png') }}"
                                                    class="profile-user-img img-fluid img-circle elevation-2" alt="User Image" data-toggle="tooltip" data-placement="bottom" title="{{ __('Change your profile picture') }}">
                                                @endif
                                                @endif
                                            </a>
                                        </div>

                                        <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                                        <ul class="list-group list-group-unbordered mb-3">
                                            <li class="list-group-item">
                                                <b>{{ __('Shopping') }}</b> <a class="float-right">{{$sales_count}}</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>{{ __('Positive Ratings') }}</b> <a class="float-right">{{$positive_rating}}</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>{{ __('Neutral Ratings') }}</b> <a class="float-right">{{$negative_rating}}</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>{{ __('Negative Ratings') }}</b> <a class="float-right">{{$neutral_rating}}</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>{{ __('Comments') }}</b> <a class="float-right">{{$comments}}</a>
                                            </li>
                                        </ul>

                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->

                                <!-- Store Route -->
                                @if (Auth::user()->sale == 1)
                                <div class="card card-warning card-outline">
                                    <div class="card-body box-profile">
                                        <a href="{{route('user')}}" class="btn btn-warning btn-lg btn-block">Ver Tienda</a>
                                    </div>
                                </div>
                                @endif
                                <!-- /.card -->

                            </div>
                            <!-- /.col -->
                            <div class="col-md-9">
                                <div class="card">
                                    <div class="card-header p-2">
                                        <ul class="nav nav-pills">
                                            <li class="nav-item"><a class="nav-link active" href="#activity"
                                                    data-toggle="tab">{{ __('Activity') }}</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#timeline"
                                                    data-toggle="tab">{{ __('Timeline') }}</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#settings"
                                                    data-toggle="tab">{{ __('Settings') }}</a></li>
                                        </ul>
                                    </div><!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="active tab-pane" id="activity">

                                                <!-- Post -->
                                                <div class="post">
                                                    <div class="user-block">
                                                        @if (auth()->user()->social_image() != 'no hay img')
                                                        <img src="{{auth()->user()->social_image()}}" class="img-circle img-bordered-sm elevation-2" alt="User Image"
                                                        style="max-height: 40px; width: 40px; object-fit: cover">
                                                        @else
                                                        @if (isset(Auth::user()->image->url))
                                                        <img src="{{ Auth::user()->image->url }}" class="img-circle img-bordered-sm elevation-2" alt="User Image"
                                                            style="max-height: 40px; width: 40px; object-fit: cover">
                                                        @else
                                                        <img src="{{ asset('adminlte/dist/img/avatardefault.png') }}"
                                                            class="img-circle img-bordered-sm elevation-2" alt="User Image">
                                                        @endif
                                                        @endif

                                                        <span class="username">
                                                            <a href="#">{{ Auth::user()->name }}</a>
                                                        </span>
                                                        <span class="description">Calificación Vendedor - 5:35 PM hoy</span>
                                                    </div>
                                                    <!-- /.user-block -->
                                                    <p>
                                                        <a href="#" class="alert-link">{{ Auth::user()->name }}</a> calificó <font class="text-primary">positivo</font> al vendedor <a href="#" class="alert-link">Test</a>
                                                    </p>
                                                </div>
                                                <!-- /.post -->

                                                <!-- Post -->
                                                <div class="post">
                                                    <div class="user-block">
                                                        @if (auth()->user()->social_image() != 'no hay img')
                                                        <img src="{{auth()->user()->social_image()}}" class="img-circle img-bordered-sm elevation-2" alt="User Image"
                                                        style="max-height: 40px; width: 40px; object-fit: cover">
                                                        @else
                                                        @if (isset(Auth::user()->image->url))
                                                        <img src="{{ Auth::user()->image->url }}" class="img-circle img-bordered-sm elevation-2" alt="User Image"
                                                            style="max-height: 40px; width: 40px; object-fit: cover">
                                                        @else
                                                        <img src="{{ asset('adminlte/dist/img/avatardefault.png') }}"
                                                            class="img-circle img-bordered-sm elevation-2" alt="User Image">
                                                        @endif
                                                        @endif

                                                        <span class="username">
                                                            <a href="#">{{ Auth::user()->name }}</a>
                                                        </span>
                                                        <span class="description">Calificación Producto - 5:31 PM hoy</span>
                                                    </div>
                                                    <!-- /.user-block -->
                                                    <p>
                                                        <a href="#" class="alert-link">{{ Auth::user()->name }}</a> calificó <font class="text-primary">positivo</font> el producto: <a href="#" class="alert-link">iPhone 11 128 GB</a> del vendedor <a href="#" class="alert-link">Test</a>
                                                    </p>
                                                </div>
                                                <!-- /.post -->

                                                <!-- Post -->
                                                <div class="post">
                                                    <div class="user-block">
                                                        @if (auth()->user()->social_image() != 'no hay img')
                                                        <img src="{{auth()->user()->social_image()}}" class="img-circle img-bordered-sm elevation-2" alt="User Image"
                                                        style="max-height: 40px; width: 40px; object-fit: cover">
                                                        @else
                                                        @if (isset(Auth::user()->image->url))
                                                        <img src="{{ Auth::user()->image->url }}" class="img-circle img-bordered-sm elevation-2" alt="User Image"
                                                            style="max-height: 40px; width: 40px; object-fit: cover">
                                                        @else
                                                        <img src="{{ asset('adminlte/dist/img/avatardefault.png') }}"
                                                            class="img-circle img-bordered-sm elevation-2" alt="User Image">
                                                        @endif
                                                        @endif

                                                        <span class="username">
                                                            <a href="#">{{ Auth::user()->name }}</a>
                                                        </span>
                                                        <span class="description">Compra Realizada - 5:30 PM hoy</span>
                                                    </div>
                                                    <!-- /.user-block -->
                                                    <p>
                                                        <a href="#" class="alert-link">{{ Auth::user()->name }}</a> compró el producto: <a href="#" class="alert-link">iPhone 11 128 GB</a> al vendedor <a href="#" class="alert-link">Test</a>
                                                    </p>
                                                </div>
                                                <!-- /.post -->
                                                
                                            </div>
                                            <!-- /.tab-pane -->
                                            <div class="tab-pane" id="timeline">
                                                <!-- The timeline -->
                                                <div class="timeline timeline-inverse">
                                                    
                                                    <!-- timeline time label -->
                                                    <div class="time-label">
                                                        <span class="bg-warning">
                                                            {{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('d/m/Y') }}
                                                        </span>
                                                    </div>
                                                    <!-- /.timeline-label -->
                                                    <!-- timeline item -->
                                                    <div>
                                                        <i class="fas fa-user bg-success"></i>

                                                        <div class="timeline-item">
                                                            <span class="time"><i class="far fa-clock"></i>{{ \Carbon\Carbon::parse(Auth::user()->created_at)->diffForHumans() }}</span>

                                                            <h3 class="timeline-header"><a href="#">{{ Auth::user()->name }}</a>
                                                                {{ __('Created the Account') }}</h3>
                                                        </div>
                                                    </div>
                                                    <!-- END timeline item -->

                                                    <div>
                                                        <i class="far fa-clock bg-gray"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.tab-pane -->

                                            <div class="tab-pane" id="settings">
                                                <form class="form-horizontal">
                                                    <div class="form-group row">
                                                        <label for="inputName" class="col-sm-2 col-form-label">{{__('Name')}}</label>
                                                        <div class="col-sm-10">
                                                            <input type="email" class="form-control" id="inputName"
                                                                placeholder="{{__('Name')}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputEmail"
                                                            class="col-sm-2 col-form-label">Email</label>
                                                        <div class="col-sm-10">
                                                            <input type="email" class="form-control" id="inputEmail"
                                                                placeholder="Email">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputName2"
                                                            class="col-sm-2 col-form-label">Name</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="inputName2"
                                                                placeholder="Name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputExperience"
                                                            class="col-sm-2 col-form-label">Experience</label>
                                                        <div class="col-sm-10">
                                                            <textarea class="form-control" id="inputExperience"
                                                                placeholder="Experience"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputSkills"
                                                            class="col-sm-2 col-form-label">Skills</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="inputSkills"
                                                                placeholder="Skills">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="offset-sm-2 col-sm-10">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox"> I agree to the <a
                                                                href="{{url('terminos')}}">terms and conditions</a>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="offset-sm-2 col-sm-10">
                                                            <button type="submit" class="btn btn-danger">Submit</button>
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



<!-- Modal Lnaguage -->
<div class="modal fade" id="profilePictureModal" tabindex="-1" aria-labelledby="profilePictureModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profilePictureModalLabel">{{__('Change your profile picture')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('profile.upload.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="imagenes" id="imagenes" accept="image/*" style="cursor: pointer">
                        <label class="custom-file-label" for="imagenes">{{__('Choose file')}}</label>
                    </div>
                    <br>
                    <div class="description mt-3">
                        Límite de 2048 MB permitido.
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