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
    Parametros - Criterios
@endsection
<!-- ************************************************************* -->
@section('cuerpoPagina')
    <div class="card">
        @include('includes.error-form')
        @include('includes.mensaje')
        <div class="card-header">
            <div class="row mb-3">
                <div class="col-12 col-md-6 col-lg-6 text-md-left text-lg-left pl-2">
                    <h5>Editar Criterio</h5>
                </div>
                <div class="col-12 col-md-6 col-lg-6 text-md-right text-lg-right pl-2 pr-md-5 pr-lg-5">
                    <a href="{{ route('wiku_criterios-index', ['id' => $id, 'wiku' => $wiku]) }}"
                        class="btn btn-success btn-xs btn-sm text-center pl-3 pr-3" style="font-size: 0.9em;"><i
                            class="fas fa-reply mr-2"></i> Volver</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form
                        action="{{ route('wiku_criterios-actualizar', ['id_criterios' => $criterio->id, 'id' => $id, 'wiku' => $wiku]) }}"
                        class="form-horizontal row" method="POST" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            @include('intranet.parametros.wiku.criterios.form')
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-xs btn-sombra pl-4 pr-4">Actualizar</button>
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
    <script src="{{ asset('js/intranet/parametros/criterios.js') }}"></script>
@endsection
<!-- ************************************************************* -->
