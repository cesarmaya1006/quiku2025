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
    Parametros - Referéncias
@endsection
<!-- ************************************************************* -->
@section('cuerpoPagina')
    <div class="card">
        @include('includes.error-form')
        @include('includes.mensaje')
        <div class="card-header">
            <div class="row mb-3">
                <div class="col-12 col-md-6 col-lg-6 text-md-left text-lg-left pl-2">
                    <h5>Nueva Referéncia</h5>
                </div>
                <div class="col-12 col-md-6 col-lg-6 text-md-right text-lg-right pl-2 pr-md-5 pr-lg-5">
                    <a href="{{ route('admin-referencia-index') }}" class="btn btn-success btn-sm text-center pl-3 pr-3"
                        style="font-size: 0.9em;"><i class="fas fa-reply mr-2"></i> Volver</a>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin-referencia-guardar') }}" class="form-horizontal row" method="POST"
                        autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <div class="card-body">
                            @include('intranet.parametros.referencias.form')
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm btn-sombra pl-4 pr-4">Guardar</button>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('script_pagina')
<script src="{{ asset('js/intranet/marcas/marcas.js') }}"></script>
@endsection
<!-- ************************************************************* -->
