@extends("extranet.plantilla.app")
<!-- ************************************************************* -->
@section('css_pagina')
    <link rel="stylesheet" href="{{ asset('css/extranet/login.css') }}">
@endsection
@section('cuerpoPagina')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Confirmacion de registro</h5>
                        <div class="card-text mt-5">
                            <div class="row">
                                <div class="col-12">
                                    <h6>Para continuar con el registro, se ha enviado un enlace al correo ingresado. Por
                                        favor verifique el buzón de entrada o revise la carpeta de correo no deseado</h6>
                                </div>
                                <br>
                                <div class="col-12 mt-5">
                                    <a href="{{ route('extranet.index') }}" class="btn btn-primary btn-sm pl-4 pr-4"> Aceptar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script_pagina')

@endsection
