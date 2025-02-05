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
    Parametros - Marcas
@endsection
<!-- ************************************************************* -->
@section('cuerpoPagina')
    <div class="card">
        @include('includes.error-form')
        @include('includes.mensaje')
        <div class="card-header">
            <div class="row mb-3">
                <div class="col-12 col-md-6 col-lg-6 text-md-left text-lg-left pl-2">
                    <h5>listado de Marcas</h5>
                </div>
                <div class="col-12 col-md-6 col-lg-6 text-md-right text-lg-right pl-2 pr-md-5 pr-lg-5">
                    <a href="{{ route('admin-marca-crear') }}" class="btn btn-success btn-sm text-center pl-3 pr-3"
                        style="font-size: 0.9em;"><i class="fas fa-plus-circle mr-2"></i> Nueva Marca</a>
                </div>
            </div>
            <hr>
            <div class="row  d-flex justify-content-around">
                <div class="col-10 col-md-7 table-responsive">
                    <table class="table table-striped table-hover table-sm tabla-data display">
                        <thead class="thead-inverse">
                            <tr>
                                <th class="text-center">Categoría</th>
                                <th class="text-center">Producto</th>
                                <th class="text-center">Marca</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($marcas as $marca)
                                <tr>
                                    <td class="text-center">{{ $marca->producto->categoria->categoria }}</td>
                                    <td class="text-center">{{ $marca->producto->producto }}</td>
                                    <td class="text-center">{{ $marca->marca }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin-marca-editar', ['id' => $marca->id]) }}"
                                            class="btn-accion-tabla tooltipsC text-info"> <i class="fa fa-edit"
                                                aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('script_pagina')

@endsection
<!-- ************************************************************* -->
