@extends("intranet.layout.app")
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')
    @include('includes.funciones_php')
@endsection
<!-- Pagina CSS -->
@section('css_pagina')
    <link rel="stylesheet" href="{{ asset('css/intranet/index.css') }}">
@endsection
<!-- ************************************************************* -->
@section('tituloPagina')
@endsection
<!-- ************************************************************* -->
@section('cuerpoPagina')
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-8">
                @include('includes.error-form')
                @include('includes.mensaje')
            </div>
        </div>
        Cambiar password

    </div>
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('script_pagina')

@endsection
<!-- ************************************************************* -->
