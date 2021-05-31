@extends('plantilla.tienda')

@section('titulo',__('Contact') . ' | TuMiniMercado')

@section('estilos')

<link rel="stylesheet" type="text/css" href="{{ asset('asset/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('asset/styles/responsive.css') }}">

@endsection

@section('contenido')


<div class="super_container_inner">
    <div class="container mt-3">
        <div class="card">
            <div class="card-header text-center bg-white">
                <h1 class="h1">{{__('Contact')}}</h1>
            </div>
            <div class="card-body">
                <div class="footer_social">
                    <div class="footer_title text-center">{{__('Our Whatsapp')}}</div>
                    <ul
                        class="footer_social_list d-flex flex-row align-items-start justify-content-center">
                        <li><a href="https://wa.link/60mgmc" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                        </li>
                        <img class="ml-3" style="margin-top: -20px" width="100px" src="{{ asset('asset/images/wa.link_60mgmc.png') }}" alt="whatsapp qr">
                    </ul>
                </div>

                <div class="footer_social">
                    <div class="footer_title text-center">{{__('Our Email')}}</div>
                    <ul
                        class="footer_social_list d-flex flex-row align-items-start justify-content-center">
                        <li><a href="mailto:help@tuminimercado.com"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                        </li>
                    </ul>
                </div>

                <div class="footer_social">
                    <div class="footer_title text-center">{{__('Social Media')}}</div>
                    <ul
                        class="footer_social_list d-flex flex-row align-items-start justify-content-center">
                        <li><a href="https://www.facebook.com/tuminimercado.fb" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        </li>
                        <li><a href="https://www.youtube.com/channel/UCur6d-L6SMHuW5b9tZzIGqQ" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
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

@endsection