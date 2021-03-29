<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('titulo')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('asset/images/LogoTM3.svg') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <!-- overlayScrollbars -->

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">


    @yield('estilos')
    
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <link href="{{ asset('asset/styles/admin.css') }}" rel="stylesheet">

</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar fixed-top navbar-expand navbar-white navbar-light" id="mainHeader">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item  d-sm-inline-block">
                    @if (Auth::user()->id == 1)
                    <a href="{{url('admin')}}" class="nav-link"><i class="fas fa-home"></i></a>
                    @else
                    <a href="{{url('user')}}" class="nav-link"><i class="fas fa-home"></i></a>
                    @endif
                </li>
            </ul>

            <div id="api_search_autocomplete" style="position: relative;" class="w-100">
                <!-- SEARCH FORM -->
                <form class="form-inline ml-3">
                    <div class="input-group input-group-sm w-100" id="mainSearchButtonAdmin">
                        <input class="form-control form-control-navbar" type="search" placeholder="{{__('Search')}}"
                            aria-label="Search" name="nombre" v-model="palabra_a_buscar" v-on:keyup="autoComplete"
                            v-on:keyup.enter="SubmitForm">
                        <div class="input-group-append">
                            <button id="miboton" ref="SubmitButonSearch" class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <div class="panel-footer" v-if="resultados.length" style="position: absolute;z-index: 3;left: 15px;">
                    <ul class="list-group">
                        <li class="list-group-item" v-for="resultado in resultados">
                            <a href="#" class="drompdown-item text-dark" v-on:click.prevent="select(resultado)">
                                <span v-html="resultado.name_negrita"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Right navbar links ml-auto-->
            <ul class="navbar-nav">
                <div class="input-group-append" id="searchButtonAdmin">
                    <button id="miboton" class="btn" type="submit" onclick="searchNavVisible()">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="margin-top: -10px;">
                        @if (auth()->user()->social_image() != 'no hay img')
                        <img src="{{auth()->user()->social_image()}}" class="img-circle elevation-2" alt="User Image"
                        style="height: 40px; width: 40px; object-fit: cover">
                        @else
                        @if (isset(Auth::user()->image->url))
                        <img src="{{ Auth::user()->image->url }}" class="img-circle elevation-2" alt="User Image"
                            style="height: 40px; width: 40px; object-fit: cover">
                        @else
                        <img src="{{ asset('adminlte/dist/img/avatardefault.png') }}"
                            class="img-circle elevation-2" alt="User Image" style="height: 40px; width: 40px; object-fit: cover">
                        @endif
                        @endif
                        <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#languageModal">
                            {{ __('Preferred language') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest

                <!-- Messages Dropdown Menu -->
                @php
                    $cant_dm = 0;
                    $cant_dm_f = 0;
                    if($direct_m != '[]'){
                        $cant_dm = count($direct_m);
                    }
                    $cant_dm_f = $cant_dm;
                    if ($cant_dm_f > 5) {
                        $cant_dm_f = 5;
                    }
                @endphp
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">{{$cant_dm}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                        <span class="dropdown-item dropdown-header">{{$cant_dm}} {{__('Unread Messages')}}</span>

                        @for ($i = 0; $i < $cant_dm_f; $i++)
                        <a href="{{route('admin.order.show',$direct_m[$i]->date_order)}}" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                @if ($direct_m[$i]->users->social_image() != 'no hay img')
                                <img src="{{$direct_m[$i]->users->social_image()}}" class="img-size-50 mr-3 img-circle elevation-2"
                                    alt="User Image" style="height: 50px; width: 50px; object-fit: cover">
                                @else
                                @if (isset($direct_m[$i]->users->image->url))
                                <img src="{{ $direct_m[$i]->users->image->url }}" class="img-size-50 mr-3 img-circle elevation-2"
                                    alt="User Image" style="height: 50px; width: 50px; object-fit: cover">
                                @else
                                <img src="{{ asset('adminlte/dist/img/avatardefault.png') }}"
                                    class="img-size-50 mr-3 img-circle elevation-2" alt="User Image">
                                @endif
                                @endif
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        {{$direct_m[$i]->users->name}}
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">{{\Illuminate\Support\Str::limit($direct_m[$i]->body ?? '',30,' ...')}}</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>{{ \Carbon\Carbon::parse($direct_m[$i]->created_at)->diffForHumans() }}</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        @endfor
                        
                        @if ($cant_dm > 5)
                        <a href="#" class="dropdown-item dropdown-footer" data-toggle="tooltip" data-placement="top" title="{{__('There are 6 or More Messages')}}">...</a>
                        <div class="dropdown-divider"></div>
                        @endif

                        @if ($cant_dm != 0)
                        <a href="#" class="dropdown-item dropdown-footer">{{__('See All Messages')}}</a>
                        @endif
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        @php
                            $t_notifications = 0;
                        @endphp

                        @if ($notifications[0][0] != 0)
                            @php
                                $t_notifications = $t_notifications + $notifications[0][0];
                            @endphp
                        @endif

                        @if ($notifications[1][0] != 0)
                            @php
                                $t_notifications = $t_notifications + $notifications[1][0];
                            @endphp
                        @endif

                        @if ($t_notifications != 0)
                            <span class="badge badge-warning navbar-badge">{{$t_notifications}}</span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">{{$t_notifications}} {{__('Notifications')}}</span>

                        <!--
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        -->

                        @if ($notifications[0][0] != 0)
                        <div class="dropdown-divider"></div>
                        <a href="{{route('admin.comment.index')}}" class="dropdown-item">
                            <i class="far fa-comment mr-2"></i> {{$notifications[0][0]}} {{__('New Questions')}}
                            <span class="float-right text-muted text-sm">{{ \Carbon\Carbon::parse($notifications[0][1])->diffForHumans() }}</span>
                        </a>
                        @endif

                        @if ($notifications[1][0] != 0)
                        <div class="dropdown-divider"></div>
                        <a href="{{route('admin.order.index')}}" class="dropdown-item">
                            <i class="fas fa-shopping-bag mr-2"></i> {{$notifications[1][0]}} {{__('New Orders')}}
                            <span class="float-right text-muted text-sm">{{ \Carbon\Carbon::parse($notifications[1][1][0])->diffForHumans() }}</span>
                        </a>
                        @endif
                        
                        <div class="dropdown-divider"></div>
                        @if ($notifications[0][0] != 0)
                        <a href="{{route('user.notifications')}}" class="dropdown-item dropdown-footer">{{__('See All Notifications')}}</a>
                        @endif
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- SEARCH navbar -->
        <nav class="main-header navbar fixed-top navbar-expand navbar-white navbar-light" id="searchNav" hidden>
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <div id="api_search_autocomplete" style="position: relative;" class="col-sm">
                <!-- SEARCH FORM -->
                <form class="form-inline ml-3">
                    <div class="input-group input-group-md col-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search"
                            aria-label="Search" name="nombre" v-model="palabra_a_buscar" v-on:keyup="autoComplete"
                            v-on:keyup.enter="SubmitForm">
                        <div class="input-group-append">
                            <button id="miboton" ref="SubmitButonSearch" class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </nav>
        <!-- /.navbar search -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="position: fixed;top: 0;bottom: 0">
            <!-- Brand Logo -->
            <a href="{{ url('/') }}" class="brand-link ml-3">
                <img src="{{ asset('asset/images/LogoTM3.svg') }}" alt="TuMiniMercado Logo" class="brand-image"
                    style="max-height: 70px;margin-top: -15px">
                <span class="brand-text font-weight-light">
                    <img src="{{ asset('asset/images/TituloLogo2.svg') }}" alt="TuMiniMercado Logo"
                        class="brand-image" style="width:160px;max-height: 60px;margin-top: -6px;">
                </span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-1">
                    <nav class="">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <div class="image p-0 mr-1" style="margin-left: -5px">
                    
                                        @if (auth()->user()->social_image() != 'no hay img')
                                        <img src="{{auth()->user()->social_image()}}" class="img-circle elevation-2" alt="User Image"
                                        style="height: 40px; width: 40px; object-fit: cover">
                                        @else
                                        @if (isset(Auth::user()->image->url))
                                        <img src="{{ Auth::user()->image->url }}" class="img-circle elevation-2" alt="User Image"
                                            style="height: 40px; width: 40px; object-fit: cover">
                                        @else
                                        <img src="{{ asset('adminlte/dist/img/avatardefault.png') }}"
                                            class="img-circle elevation-2" alt="User Image">
                                        @endif
                                        @endif
                                        
                                    </div>
                                    
                                    {{ Auth::user()->name }}
                                    <i class="right fas fa-angle-left mt-2" style="margin-right: -17px"></i>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('profile') }}" class="nav-link" id="menuProfile">
                                            <i class="fas fa-id-card nav-icon"></i>
                                            {{ __('See Profile') }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('store/purchases') }}" class="nav-link" id="menuPurchases">
                                            <i class="fas fa-shopping-bag nav-icon"></i>
                                            {{ __('Purchases') }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                            <i class="fas fa-times nav-icon"></i>
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

                        <!-- Categorías -->
                        @can('haveaccess', 'category.index')
                        <li class="nav-item has-treeview" id="slidCat">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>
                                    {{__('Categories')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin.category.index')}}" class="nav-link" id="menuCat1">
                                        <i class="fas fa-chevron-right nav-icon"></i>
                                        <p>{{__('List of Categories')}}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.category.create')}}" class="nav-link" id="menuCat2">
                                        <i class="fas fa-chevron-right nav-icon"></i>
                                        <p>{{__('Create Category')}}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan

                        <!-- Productos -->
                        @can('haveaccess', 'product.index')
                        <li class="nav-item has-treeview" id="slidProd">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>
                                    {{__('Products')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin.product.index')}}" class="nav-link" id="menuProd1">
                                        <i class="fas fa-chevron-right nav-icon"></i>
                                        <p>{{__('List of Products')}}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.product.create')}}" class="nav-link" id="menuProd2">
                                        <i class="fas fa-chevron-right nav-icon"></i>
                                        <p>{{__('Create Product')}}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan

                        <!-- Comments -->
                        @can('haveaccess', 'store.full')
                        <li class="nav-item" id="slidComment">
                            <a href="{{route('admin.comment.index')}}" class="nav-link">
                                <i class="nav-icon far fa-comment"></i>
                                <p>
                                    {{__('Questions')}}
                                </p>
                            </a>
                        </li>
                        @endcan


                        <!-- Compras -->
                        @can('haveaccess', 'store.full')
                        <li class="nav-item has-treeview" id="slidShopp">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-store"></i>
                                <p>
                                    {{__('Purchases')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin.shopping.index')}}" class="nav-link" id="menuShopp1">
                                        <i class="fas fa-chevron-right nav-icon"></i>
                                        <p>{{__('Income')}}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.providers')}}" class="nav-link" id="menuShopp2">
                                        <i class="fas fa-chevron-right nav-icon"></i>
                                        <p>{{__('Providers')}}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan


                        <!-- Ordenes -->
                        @can('haveaccess', 'store.full')
                        <li class="nav-item" id="slidOrder">
                            <a href="{{route('admin.order.index')}}" class="nav-link">
                                <i class="nav-icon fas fa-shopping-bag"></i>
                                <p>
                                    {{__('Orders')}}
                                </p>
                            </a>
                        </li>

                        <li class="nav-item" id="slidSale">
                            <a href="{{route('admin.sale.index')}}" class="nav-link">
                                <i class="nav-icon fas fa-hand-holding-usd"></i>
                                <p>
                                    {{__('Sales')}}
                                </p>
                            </a>
                        </li>
                        @endcan
                        



                        @can('haveaccess', 'user.index')

                        <div class="user-panel mt-3"></div>
                        <li class="nav-header">ADMIN</li>

                        @can('haveaccess', 'role.index')
                        <!-- Roles -->
                        <li class="nav-item has-treeview" id="slidRole">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p>
                                    Roles
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin.role.index')}}" class="nav-link" id="menuRole1">
                                        <i class="fas fa-chevron-right nav-icon"></i>
                                        <p>{{__('List of Roles')}}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.role.create')}}" class="nav-link" id="menuRole2">
                                        <i class="fas fa-chevron-right nav-icon"></i>
                                        <p>{{__('Create Role')}}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan

                        <!-- Usuarios -->
                        <li class="nav-item" id="slidUser">
                            <a href="{{route('admin.user.index')}}" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    {{__('Users')}}
                                </p>
                            </a>
                        </li>

                        <div class="user-panel mt-3 "></div>

                        @endcan


                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>@yield('titulo')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                @if ( Auth::user()->name == 'admin')
                                <li class="breadcrumb-item"><a href="{{route('admin')}}">{{__('Home')}}</a></li>
                                @else
                                <li class="breadcrumb-item"><a href="{{route('user')}}">{{__('Home')}}</a></li>
                                @endif
                                @yield('breadcrumb')
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                @if (session('datos'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('datos')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                @if (session('cancelar'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{session('cancelar')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li> {{ $error }} </li>

                        @endforeach
                    </ul>
                </div>
                @endif

                @yield('contenido')

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0.1
            </div>
            <strong>Copyright &copy; 2020 <a href="{{ url('/') }}">TuMiniMercado</a>.</strong> {{__('All rights reserved.')}}
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->




    @include('custom.modal_language')

    <!-- jQuery -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>
    <!-- Sweet Alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!-- ChartJS -->
    <script src="{{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    
    <!-- Select2 -->
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>

    @yield('scripts')
    <script src="{{ asset('js/app_admin.js') }}" defer></script>

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip({});

            if ({!! json_encode(session("datos")) !!}) {
                Swal.fire({
                    text: {!! json_encode(session("datos")) !!},
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 4500,
                    timerProgressBar: true,
                    toast: true,
                    position: 'top-end',
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
            }

            if ({!! json_encode(session("cancelar")) !!}) {
                Swal.fire({
                    text: {!! json_encode(session("cancelar")) !!},
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 4500,
                    timerProgressBar: true,
                    toast: true,
                    position: 'top-end',
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
            }
        });
        
        function searchNavVisible(){
            //$('#mainHeader').attr('hidden',true);
            $('#mainHeader').fadeOut(800);
            //$('#searchNav').removeAttr('hidden')
            var myVar = setTimeout(myTimer, 700);

            function myTimer() {
                $('#mainHeader').attr('hidden',true);
                $('#mainHeader').attr('display','none');
                $('#searchNav').fadeIn(800).removeAttr('hidden');
                $("#searchNav").css("display","");
                $('.content-wrapper').css("opacity","0.3")
            };
        }

        $('.content-wrapper').click(function(){
            $('#searchNav').fadeOut(800);
            var myVar = setTimeout(myTimer, 700);

            function myTimer() {
                $('#searchNav').attr('hidden',true);
                $('#searchNav').attr('display','none');
                $('#mainHeader').fadeIn(800).removeAttr('hidden');
                $("#mainHeader").css("display","");
                $('.content-wrapper').css("opacity","1")
            };
        });
    </script>

    
</body>

</html>