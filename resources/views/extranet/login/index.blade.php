@extends('extranet.layout.app')
<!-- ************************************************************* -->
@section('cssPagina')
    <link rel="stylesheet" href="{{ asset('css/extranet/login.css') }}">

@endsection
<!-- ************************************************************* -->
@section('cuerpoPagina')
<div class="container index">
        <div class="container mt-3">
            <div class="row d-flex justify-content-center mt-3">
                <div class="col-11 col-md-6">
                    @include('includes.error-form')
                    @include('includes.mensaje')
                </div>
            </div>
            <div class="row justify-content-center" style="font-size: 0.8em;">
                <div class="col-10 col-sm-8 col-md-4 mt-5">
                    <div class="card" style="-webkit-box-shadow: 5px 5px 15px 5px #000000; box-shadow: 5px 5px 15px 5px #000000;border-radius: 10px;">
                        <div class="card-body">
                            <img src="{{ asset('imagenes/sistema/img-logo.png') }}" class="rounded mx-auto d-block" alt="...">
                            <div class="card-text mt-3">
                                <form action="{{ route('login') }}" method="post" autocomplete="off">
                                    @method('post')
                                    @csrf
                                    <div class="form-group form-row">
                                        <div class="col-md-12 mb-3">
                                            <input type="mail" class="form-control form-control-sm" id="email" name="email" placeholder="Correo Electrónico*" required>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="Contraseña*" required>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-around">
                                        <div class="centrar-items">
                                            <button class="mt-2 btn btn-primary" type="submit">Iniciar sesión</button>
                                        </div>
                                        <div class="centrar-items">
                                            <a href="{{ route('extranet.registro_ini') }}" class="mt-2 btn btn-primary">Registrarse</a>
                                        </div>
                                    </div>
                                    <div class="centrar-items mt-4">
                                        <p><a class="card-text h6" href="{{ route('extranet.solicitar_password') }}">Olvidé mi nombre
                                                de usuario o contraseñasss</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
