@extends('layouts.app')

@section('titulo','Login | TuMiniMercado')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if (session('info'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{session('info')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="card">
                <div class="card-header text-center font-weight-bold h4">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="input-group col-md-6">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fa fa-envelope"></i></span>
                                </div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="input-group col-md-6">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                                </div>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @php
                                $pag = (isset($_GET['pag'])) ? $_GET['pag'] : 0 ;
                                @endphp
                                <input id="pag" type="text" name="pag" required value="{{$pag}}" hidden>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                            </div>
                        </div>

                        <br>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                {{__("Don't have an account with us?")}}

                                <a class="btn btn-success" href="{{ route('register') }}">
                                    {{ __('Register') }}
                                </a>
                            </div>
                        </div>

                        <br>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                {{__('Do you want to register as a')}} <font class="font-weight-bold text-dark h5">{{__('seller')}}</font> {{__('with us?')}}
                            </div>
                            <div class="col-md-8 offset-md-6">
                                <a class="btn btn-link"
                                    href="{{ url('register/store?sale=_sdbajfkenfefef?-weDSFdfdFGTwfLOa&register=_yes') }}">
                                    {{ __('Click Here') }}
                                </a>
                            </div>
                        </div>
                    </form>

                    <div class="form-group row mb-0 mt-2">
                        <div class="col-xl-6 offset-md-4">
                            <p class="mb-2 text-center lead">-o-</p>
                            <a href="{{url('login/facebook')}}" class="btn btn-primary btn-block mb-2"
                                style="background-color: #4267b2;"><img
                                    src="https://img.icons8.com/color/48/000000/facebook.png"
                                    style="width: 30px" />{{__('Log In With ')}}Facebook</a>
                            <a href="{{url('login/google')}}" class="btn btn-light btn-block"><img
                                    src="https://img.icons8.com/color/48/000000/google-logo.png"
                                    style="width: 30px" />{{__('Log In With ')}}Google</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection