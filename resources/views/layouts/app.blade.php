<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('titulo')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="description" content="TuMiniMercado | Tu Solución Empresarial, de Necesidades y Lujos">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('asset/images/logo.png') }}">
    <link rel="icon" href="{{ asset('asset/images/LogoTM3.svg') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">

    @yield('estilos')
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-176736541-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-176736541-1');
    </script>

    <!-- Bootstrap 4 -->
    <link href="{{ asset('asset/styles/bootstrap-4.1.2/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css"
        href="{{ asset('asset/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('asset/styles/main_styles.css') }}">

    <style>
        @media only screen and (max-width: 440px) {
            .nav-link .logo {
                margin-left: 30px;
            }
        }

        /* Estilos de footer del sidebar */
        .svg:hover path {
            fill: #4BC57D;
        }

        .svgP {
            max-width: 150%;
            height: 25px;
            margin-left: -20px;
            margin-top: -5px
        }

        .svgP path {
            fill: rgba(56, 196, 21, 0.747);
        }

        .text-mail {
            color: #a7a4a4;
        }

        .text-mail:hover {
            color: #4BC57D;
        }

        .navbar {
            height: 70px;
        }

        .content-wrapper {
            margin-top: 70px;
        }

        .logo {
            margin-left: 15px;
        }

        .form-control {
            height: auto;
            color: rgb(87, 87, 87);
        }
    </style>
</head>

<body class="hold-transition sidebar-collapse">
    <div id="app">
        <div class="wrapper">
            <nav class="main-header navbar fixed-top navbar-expand navbar-light bg-white shadow-sm">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-sm-inline-block">
                        <div class="logo">
                            <a href="{{ url('/') }}" class="nav-link">
                                <div class="d-flex flex-row align-items-center justify-content-start"
                                    style="margin-top: -18px">
                                    <div><img width="210px" src="{{ asset('asset/images/LogoEntero3.svg') }}"
                                            alt="TuMiniMercado Logo"></div>
                                </div>
                            </a>
                        </div>
                    </li>
                </ul>



                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown mr-4" id="languageDD">
                        @if (config('app.locale') == 'es')
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="modal" data-target="#languageModal">
                            Español
                        </a>

                        @else

                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="modal" data-target="#languageModal">
                            English
                        </a>
                        @endif
                    </li>

                    <!-- Authentication Links -->
                    @guest
                    <li class="nav-item d-none d-sm-inline-block">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item d-none d-sm-inline-block">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
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
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-user"></i>
                                        {{ Auth::user()->name }}
                                        <i class="right fas fa-angle-left"></i>
                                    </a>
                                    <ul class="nav nav-treeview">
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
                                                alt="envelope">
                                        </div>
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
                                        <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                        <li><a href="https://www.instagram.com/tu_minimercado/" target="_blank"><i
                                                    class="fa fa-instagram" aria-hidden="true"></i></a></li>
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
                <section class="content">

                    <main class="py-4">
                        @yield('content')
                    </main>

                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                    <b>Version</b> 1.0.1
                </div>
                <strong>Copyright &copy; 2019-2020 <a href="{{ url('/') }}">TuMiniMercado</a>.</strong> {{__('All rights reserved')}}
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
    </div>



    @include('custom.modal_language')

    <!-- jQuery -->
    <script src="{{ asset('asset/js/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
    <!-- Sweet Alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


    <script>
        $(document).ready(function () {
  initSvg();
  /*
    5. Init SVG
  */

  function initSvg() {
    if ($("img.svg").length) {
      jQuery("img.svg").each(function () {
        var $img = jQuery(this);
        var imgID = $img.attr("id");
        var imgClass = $img.attr("class");
        var imgURL = $img.attr("src");
        jQuery.get(imgURL, function (data) {
          // Get the SVG tag, ignore the rest
          var $svg = jQuery(data).find("svg"); // Add replaced image's ID to the new SVG

          if (typeof imgID !== "undefined") {
            $svg = $svg.attr("id", imgID);
          } // Add replaced image's classes to the new SVG


          if (typeof imgClass !== "undefined") {
            $svg = $svg.attr("class", imgClass + " replaced-svg");
          } // Remove any invalid XML tags as per http://validator.w3.org


          $svg = $svg.removeAttr("xmlns:a"); // Replace image with new SVG

          $img.replaceWith($svg);
        }, "xml");
      });
    }
  }
});
    </script>

    @yield('scripts')
</body>

</html>