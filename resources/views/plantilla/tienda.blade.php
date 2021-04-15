<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('titulo')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="description" content="TuMiniMercado | Tu Solución Empresarial, de Necesidades y Lujos">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('asset/images/LogoTM3.svg') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">

    @yield('estilos')
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- Bootstrap 4 -->
    <link href="{{ asset('asset/styles/bootstrap-4.1.2/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css"
        href="{{ asset('asset/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}">

    <style>
        a:hover {
            text-decoration: none;
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            background-color: var(--green);
        }
        
        div > .content-wrapper{
            min-height: 10px;
        }
    </style>

    
</head>

<body class="hold-transition sidebar-collapse">
    <div id="" style="overflow-y: scroll">
        <div class="wrapper">
            <nav class="main-header navbar fixed-top navbar-expand navbar-light bg-white shadow-sm" id="main_nav">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-sm-inline-block">
                        <div class="logo">
                            <div class="d-flex flex-row align-items-center justify-content-start"
                                style="margin-top: -18px;margin-left: 10px">
                                <div>
                                    <a href="{{ url('/') }}" class="nav-link">
                                        <img width="210px" src="{{ asset('asset/images/LogoEntero3.svg') }}"
                                            alt="TuMiniMercado Logo">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>

                <div id="api_search_autocomplete_store" class="header_search ml-auto col-sm" style="position: relative;">
                    <!-- SEARCH FORM -->
                    <form action="{{url('store/show-product')}}" id="header_search_form" method="GET">
                        <input type="search" class="search_input col-sm" placeholder="{{__('Search')}}" name="main_search" id="main_search" v-model="palabra_a_buscar" v-on:keyup="autoComplete" v-on:keyup.enter="SubmitForm" value="{{request()->main_search}}">

                        <input type="text" value="{{request()->main_search}}" id="value_at" hidden>

                        <button class="header_search_button mr-3" id="miboton" ref="SubmitButonSearch" type="submit">
                            <img src="{{ asset('asset/images/search.png') }}" alt="">
                        </button>
                    </form>
                    
                    <div class="panel-footer" v-if="resultados.length" style="position: absolute;z-index: 3;left: 15px;width: -webkit-fill-available;margin-right: 35px;">
                        <ul class="list-group search_box" style="max-height: 350px;margin-bottom: 10px;overflow-y: auto;">
                            <li class="list-group-item" v-for="resultado in resultados">
                                <a href="" class="drompdown-item text-dark d-block" v-on:click.prevent="select(resultado)">
                                    <span v-html="resultado.name_negrita"></span>
                                    <p class="small" v-html="resultado.category_negrita"></p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>



                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">

                </ul>
                <div class="d-flex flex-row align-items-center justify-content-start ml-auto mr-1" id="">

                    <!-- Search Icon -->
                    <div class="cart mr-2" id="searchIcon">
                        <a href="#" onclick="searchNavVisible()">
                            <div><img class="svg" src="{{ asset('asset/images/search.svg') }}"
                                    alt="https://www.flaticon.com/authors/freepik">
                            </div>
                        </a>
                    </div>

                    <!-- Cart -->
                    <div class="cart mr-2"><a href="{{url('store/cart')}}">
                            <div><img class="svg" src="{{ asset('asset/images/cart.svg') }}"
                                    alt="https://www.flaticon.com/authors/freepik">
                                    @if (session()->get('hjwebajjasxwk8164qds4.as84') != null)
                                    <div>{{sizeof(session()->get('hjwebajjasxwk8164qds4.as84'))}}</div>
                                    @else
                                        
                                    @endif
                            </div>
                        </a></div>

                    <!-- User -->
                    @guest
                        
                    @if (Route::has('register'))
                    <div class="cart d-flex flex-row align-items-center justify-content-start">
                        <a href="{{url('/login')}}" data-toggle="tooltip" data-placement="bottom" title="{{ __('Login') }}">
                        <div>
                            <img class="svg" src="{{ asset('asset/images/btn-in.svg') }}"
                                alt="https://www.flaticon.com/authors/freepik">
                        </div>
                        </a>
                    </div>
                    @endif
                    @else
                    
                    <div class="cart d-flex flex-row align-items-center justify-content-start mr-1 nav-item dropdown">
                        @php
                            if($cant_dm_new > 9){
                                $cant_dm_new = '9+';
                            }
                        @endphp
                        <span data-toggle="tooltip" data-placement="bottom" title="{{ __('New Messages') }}">
                        <a href="#" role="button" data-toggle="modal" data-target="#dmModal">
                            <div>
                                <img class="svg" src="{{ asset('asset/images/chat.svg') }}"
                                    alt="https://www.flaticon.com/authors/freepik">
                                    @if ($cant_dm_new != 0)
                                    <div>{{$cant_dm_new}}</div>
                                    @endif
                            </div>
                        </a>
                        </span>
                    </div>

                    <div class="cart d-flex flex-row align-items-center justify-content-start">
                        @if ($user['id'] != '1')
                        <a href="{{url('/profile')}}" data-toggle="tooltip" data-placement="bottom" title="{{ __('See Profile') }}">
                            @else
                            <a href="{{url('/admin')}}" data-toggle="tooltip" data-placement="bottom" title="{{ __('See Profile') }}">
                        @endif
                                <div>
                                    <img class="svg" src="{{ asset('asset/images/user.svg') }}"
                                        alt="https://www.flaticon.com/authors/freepik">
                                </div>
                            </a>
                    </div>
                    @endguest

                </div>

            </nav>

            <!-- SEARCH navbar -->
            <nav class="main-header navbar fixed-top navbar-expand navbar-white navbar-light" id="searchNav" hidden>
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>

                <div id="api_search_autocomplete_store_small" class="col-sm" style="position: relative;">
                    <!-- SEARCH FORM -->
                    <form action="{{url('store/show-product')}}" id="header_search_form" method="GET">
                        <input type="search" class="search_input col-sm" placeholder="Búsqueda" name="main_search" id="main_search" v-model="palabra_a_buscar" v-on:keyup="autoComplete" v-on:keyup.enter="SubmitForm" value="{{request()->main_search}}">

                        <input type="text" value="{{request()->main_search}}" id="value_at" hidden>

                        <button class="header_search_button mr-3" id="miboton" ref="SubmitButonSearch" type="submit">
                            <img src="{{ asset('asset/images/search.png') }}" alt="">
                        </button>
                    </form>
                    
                    <div class="panel-footer" v-if="resultados.length" style="position: absolute;z-index: 3;left: 15px;width: -webkit-fill-available;margin-right: 35px;">
                        <ul class="list-group search_box" style="max-height: 350px;margin-bottom: 10px;overflow-y: auto;">
                            <li class="list-group-item" v-for="resultado in resultados">
                                <a href="" class="drompdown-item text-dark d-block" v-on:click.prevent="select(resultado)">
                                    <span v-html="resultado.name_negrita"></span>
                                    <p class="small" v-html="resultado.category_negrita"></p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- /.navbar search -->


            <!-- navbar bg-dark -->
            <nav class="main-header navbar bg-dark" style="height: 50px;margin-top: 70px;z-index: 20" id="navbar2">
                <ul class="navbar-nav flex-row ml-5" style="margin-top: -5px">
                    <li class="nav-item mr-2">
                        <a href="{{ url('store/show-product') }}" class="btn btn-outline-light">{{__('Products')}}</a>
                    </li>
                    <li class="nav-item mr-2">
                        <a href="{{ url('store/show-category') }}" class="btn btn-outline-light">{{__('Categories')}}</a>
                    </li>

                </ul>
                <ul class="navbar-nav flex-row ml-auto">
                    <li class="nav-item dropdown mr-4" id="languageDD">
                        @if (config('app.locale') == 'es')
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="modal" data-target="#languageModal">
                            Español
                        </a>

                        @else

                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="modal" data-target="#languageModal">
                            English
                        </a>
                        @endif
                    </li>
                    
                    <li class="nav-item mr-4">
                        @if ($arr_conex_client_t != 0)
                        <img class="svg svgFlag"
                        
                            src="{{ asset('asset/flags/'.$arr_conex_client_t[0]['country'].'.svg') }}"
                            alt="Flag">
                        @else
                        <!------------- NO HAY IP ---------------->
                        <img class="svg svgFlag" src="{{ asset('asset/flags/Venezuela.svg') }}" alt="Flag">

                        @endif
                    </li>
                </ul>
            </nav>

            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4" style="position: fixed;top: 0;bottom: 0">
                <!-- Brand Logo -->
                <a href="{{ url('/') }}" class="brand-link">
                    <img src="{{ asset('asset/images/LogoEntero3.svg') }}" alt="TuMiniMercado Logo"
                        class="brand-image " style="width: 200px; max-height: 70px;margin-top: -15px">

                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user (optional) -->
                    <div class="user-panel ">
                        <nav class="mt-2">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                                data-accordion="false">
                                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

                                @guest
                                <li class="nav-item has-treeview">
                                    <a class="nav-link" href="{{ route('login') }}"><i class="nav-icon fas fa-user"></i>
                                        {{ __('Login') }}
                                    </a>
                                </li>
                                @if (Route::has('register'))
                                <li class="nav-item has-treeview">
                                    <a class="nav-link" href="{{ route('register') }}"><i
                                            class="nav-icon fas fa-check"></i>
                                        {{ __('Register') }}
                                    </a>
                                </li>
                                @endif
                                @else
                                <li class="nav-item has-treeview menu-open">
                                    <a href="#" class="nav-link">
                                        <div class="image p-1 mr-1" style="margin-left: -5px">
                        
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
                                        <i class="right fas fa-angle-left" style="margin-top: 10px"></i>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @if (App\User::select('role_id')->where('users.id', Auth::user()->id)->join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.user_id', Auth::user()->id)->first()->role_id == '3')
                                        <li class="nav-item">
                                            <a href="{{ url('user') }}" class="nav-link">
                                                <i class="fas fa-cogs nav-icon"></i>
                                                {{ __('Administration') }}
                                            </a>
                                        </li>
                                        @endif

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
                                @endguest

                            </ul>
                        </nav>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-3">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">

                            <li class="nav-item has-treeview">
                                <a class="nav-link" href="{{ url('/store/show-product') }}"><i
                                        class="nav-icon fas fa-shapes"></i>
                                        {{__('Products')}}
                                </a>
                            </li>

                            <li class="nav-item has-treeview">
                                <a class="nav-link" href="{{ url('/store/show-category') }}"><i
                                        class="nav-icon fas fa-list-alt"></i>
                                        {{__('Categories')}}
                                </a>
                            </li>


                        </ul>
                    </nav>

                    <div class="user-panel mt-3"></div>
                    <br><br><br><br>

                    <!-- Contact Info -->
                    <nav class="mt-5 mb-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <div class="menu_contact">
                                <div class="menu_phone d-flex flex-row align-items-center justify-content-start">
                                    <div>
                                        <div><img class="svg svgP"
                                                src="{{ asset('asset/images/envelope.svg') }}"
                                                alt="{{ asset('asset/images/phone.svg') }}"></div>
                                    </div>
                                    <div class="text-white-50">
                                        <p class="text-mail">ceo@tuminimercado.com</p>
                                    </div>
                                </div>
                                <div class="menu_social">
                                    <ul
                                        class="menu_social_list d-flex flex-row align-items-start justify-content-start">
                                        <li><a href="https://www.facebook.com/tuminimercado.fb" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                                        <li><a href="https://twitter.com/TuMiniMercado1" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                        <li><a href="https://www.instagram.com/tu_minimercado/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </ul>
                    </nav>

                </div>
                <!-- /.sidebar -->
            </aside>



            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <!-- Main content -->
                <section class="">

                    <main class="">
                        @yield('contenido')
                    </main>

                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Footer -->
            <footer class="main-footer">
                <footer class="footer">
                    <div class="footer_content">
                        <div class="container">
                            <div class="row">

                                <!-- About -->
                                <div class="col-lg-4 footer_col">
                                    <div class="footer_about">
                                        <div class="footer_logo">
                                            <a href="{{ url('/') }}" class="nav-link">
                                                <div class="d-flex flex-row align-items-center justify-content-start ml-4"
                                                    style="margin-top: -10px">
                                                    <div><img width="280px"
                                                            src="{{ asset('asset/images/LogoEntero3.svg') }}"
                                                            alt="TuMiniMercado Logo" class="brand-image"></div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="footer_about_text">
                                            <p>Tu solución empresarial donde puedes adquirir un sitio donde administrar,
                                                gestionar y vender para tu propio negocio, o encontrar lo que necesites.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Footer Links -->
                                <div class="col-lg-4 footer_col">
                                    <div class="footer_menu">
                                        <div class="footer_title">{{__('Support')}}</div>
                                        <ul class="footer_list">
                                            <!--
                                            <li>
                                                <a href="#">
                                                    <div>{{__('Customer Service')}}<div class="footer_tag_1">online now</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div>{{__('User Service')}}</div>
                                                </a>
                                            </li>
                                            -->
                                            <li>
                                                <a href="{{url('/terminos')}}">
                                                    <div>{{__('Terms and Conditions')}}</div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{url('/politicas')}}">
                                                    <div>{{__('Privacy policies')}}</div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div>{{__('Contact')}}</div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Footer Contact -->
                                <div class="col-lg-4 footer_col">
                                    <!-- Eliminar el Style -->
                                    <div class="footer_contact" style="padding-top: 22px">
                                        <!--
                                        <div class="footer_title">{{__('Stay in contact')}}</div>
                                        <div class="newsletter">
                                            <form action="#" id="newsletter_form" class="newsletter_form">
                                                <input type="email" class="newsletter_input"
                                                    placeholder="{{__('Subscribe to our newsletter')}}" required="required">
                                                <button class="newsletter_button">+</button>
                                            </form>
                                        </div>
                                        -->
                                        <div class="footer_social">
                                            <div class="footer_title">Social</div>
                                            <ul
                                                class="footer_social_list d-flex flex-row align-items-start justify-content-start">
                                                <li><a href="https://www.facebook.com/tuminimercado.fb" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                                </li>
                                                <li><a href="#"><i class="fa fa-youtube-play"
                                                            aria-hidden="true"></i></a>
                                                </li>
                                                <!-- <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a> 
                                                </li> -->
                                                <li><a href="https://twitter.com/TuMiniMercado1" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a> 
                                                </li>
                                                <li><a href="https://www.instagram.com/tu_minimercado/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>



                <div class="float-right d-none d-sm-block">
                    <b>Version</b> 1.0.1
                </div>
                <strong>Copyright &copy; 2019-2020 <a href="{{ url('/') }}">TuMiniMercado</a>.</strong> {{__('All rights reserved.')}}
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
    </div>


    @include('custom.modal_language')
    @include('custom.modal_dm')
    

    <!-- jQuery -->
    <script src="{{ asset('asset/js/jquery-3.2.1.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
    <!-- Sweet Alert 2 -->
    <script src="{{ asset('js/sweetalert.js') }}"></script>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/all.js') }}" defer></script>

    @yield('scripts')

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip({});
            //$('.dropdown-toggle').dropdown();


            if ({!! json_encode(session("mensajeInfo")) !!}) {
                Swal.fire({
                    text: {!! json_encode(session("mensajeInfo")) !!},
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 3000,
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
            //$('#main_nav').attr('hidden',true);
            $('#main_nav').fadeOut(800);
            //$('#searchNav').removeAttr('hidden')
            var myVar = setTimeout(myTimer, 700);

            function myTimer() {
                $('#main_nav').attr('hidden',true);
                $('#main_nav').attr('display','none');
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
                $('#main_nav').fadeIn(800).removeAttr('hidden');
                $("#main_nav").css("display","");
                $('.content-wrapper').css("opacity","1")
            };
        });
    </script>
</body>

</html>