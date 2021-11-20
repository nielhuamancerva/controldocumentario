@extends('layouts.app')

@section('content')
<style>
           html,body{
                    background-image: url("/dist/img/fondo1.jpg");
                    background-size: cover;
                    background-repeat: no-repeat;
                    height: 100%;
                    font-family: 'Numans', sans-serif;
                    }

                .container{
                height: 100%;
                align-content: center;
                }

                .card{
                height: 100%;
                margin-top: 5%;
                margin-bottom: auto;
                width: 400px;
                background-color: rgba(0,0,0,0.5) !important;
                }

                .social_icon span{
                font-size: 60px;
                margin-left: 10px;
                color: #FFC312;
                }

                .social_icon span:hover{
                color: white;
                cursor: pointer;
                }

                .card-header h3{
                color: white;
                }

                .social_icon{
                position: absolute;
                right: 20px;
                top: -45px;
                }

                .input-group-prepend span{
                width: 50px;
                background-color: #FFC312;
                color: black;
                border:0 !important;
                }

                input:focus{
                outline: 0 0 0 0  !important;
                box-shadow: 0 0 0 0 !important;

                }

                .remember{
                color: white;
                }

                .remember input
                {
                width: 20px;
                height: 20px;
                margin-left: 15px;
                margin-right: 5px;
                }

                .login_btn{
                color: black;
                background-color: #FFC312;
                width: 100px;
                }

                .login_btn:hover{
                color: black;
                background-color: white;
                }

                .links{
                color: white;
                }

                .links a{
                margin-left: 4px;
                }
       
        </style>

<div class="container">
    <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Control de Tramite Documentario</h3>
                    <div class="d-flex justify-content-end social_icon">
                        <span><i class="fab fa-facebook-square"></i></span>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                            <div class="input-group form-group">
                               
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                <input id="username" type="text" placeholder="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                   

                        <div class="input-group form-group">

                           
                                    <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label remember" for="remember" >
                                        {{ __('Recuerdar el Ingreso') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                         
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Ingresar') }}
                                        </button>
                                    </div>
                                       
                                    <div class="d-flex justify-content-center links">
                                        No Cuenta con Usuario Llamar al Cel:932276248
                                 
                                    </div>

                                    <div class="d-flex justify-content-center links">
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">Forgot Your Password?</a>
                                        @endif
                                    </div>
                               
                            
                        </div>
                    </form>
                </div>
            </div>
        
    </div>
</div>


@endsection
