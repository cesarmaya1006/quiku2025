@extends('intranet.layout.app')
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')
    @include('includes.funciones_php')
@endsection
<!-- Pagina CSS -->
@section('css_pagina')
    <!--<link rel="stylesheet" href="{{ asset('css/intranet/index.css') }}"> -->
    <script type="text/javascript" src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
@endsection
<!-- ************************************************************* -->
@section('tituloPagina')
    Analítica
@endsection
<!-- ************************************************************* -->
@section('cuerpoPagina')
    <div class="card">
        @include('includes.error-form')
        @include('includes.mensaje')
        <div class="card-header">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h1 class="m-0">Analítica específica de PQR's</h1>
                </div>
                <div class="col-12 col-sm-6">

                </div>
            </div>
        </div>
        <div class="card-body pb-3">
            <form
                action="{{ route('analitica-cargar_graficos') }}"
                class="form-horizontal row"
                method="POST"
                autocomplete="off"
                id="formBusquedaAnalitica">
                @csrf
                @method('post')
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12"><h6><strong>Especificacion de Rangos</strong></h6></div>
                        <div class="form-group col-12 col-md-4">
                            <label class="requerido" for="esp_rango">Especificacion</label>
                            <select id="esp_rango" class="form-control form-control-sm" name="esp_rango" required>
                                <option value="">--- Elija tipo especificación ---</option>
                                <option value="1">Tiempo contra Área de conocimiento</option>
                                <option value="2">Tiempo contra caracterización de PQR</option>
                                <option value="3">Tiempo contra empleados</option>
                                <option value="4">Área de conocimiento contra Caracterizaciones de PQR</option>
                                <option value="5">Área de conocimiento contra Empleados</option>
                                <option value="6">Caracterización de PQR contra Empleados</option>
                                <option value="7">Empleados por estado de pqr</option>
                                <option value="8">Empleados por tiempos de respuesta</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="form-group col-12 col-md-2">
                            <label class="requerido" for="motivo_sub_id">Tipo de gráfico</label>
                            <select id="tipoGrafico" class="form-control form-control-sm" name="tipoGrafico">
                                <option value="column">Barras</option>
                                <option value="line">Lineas</option>
                                <option value="area">Áreas</option>
                                <option value="pie">Torta de datos</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="row d-none" id="caja_tiempo">
                        <div class="col-12 d-flex">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="anno_mes" id="anno_mes_1" value="anno" checked>
                                <label class="form-check-label" for="anno_mes_1">
                                    Por año
                                </label>
                            </div>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="anno_mes" id="anno_mes_2" value="anno_mes">
                                <label class="form-check-label" for="anno_mes_2">
                                    Por año / mes
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-md-1 form-group">
                                    <label for="anno_busqueda">Año Busqueda</label>
                                    <select class="form-control form-control-sm" id="anno_busqueda" name="anno_busqueda" required>
                                        @for ($i = $annoini; $i <= date('Y'); $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-12 col-md-1 form-group d-none" id="caja_mes">
                                    <label for="mes">Mes Busqueda</label>
                                    <select class="form-control form-control-sm" id="mes_busqueda" name="mes_busqueda">
                                        @foreach ($meses as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="d-none" id="hr_caja_tiempo">
                    <div class="row d-none" id="caja_area_conocimiento">
                        <div class="col-12"><h6><strong>Por tipo Motivo y sub-motivo</strong></h6></div>
                        <div class="col-12">
                            <div class="row">
                                <div class="form-check col-12 col-md-2">
                                    <input class="form-check-input check_clase" type="checkbox" value="" id="tipopqrCheck">
                                    <label class="form-check-label" for="tipopqrCheck">Tipo</label>
                                </div>
                                <div class="form-check col-12 col-md-2">
                                    <input class="form-check-input check_clase" type="checkbox" value="" id="motivoCheck">
                                    <label class="form-check-label" for="motivoCheck">Motivo</label>
                                </div>
                                <div class="form-check col-12 col-md-2">
                                    <input class="form-check-input check_clase" type="checkbox" value="" id="subMotivoCheck">
                                    <label class="form-check-label" for="subMotivoCheck">Sub-Motivo</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12 col-md-6 d-none" id="tipo_pqr">
                                    <label class="requerido" for="tipo_p_q_r_id">Tipo</label>
                                    <select id="tipo_p_q_r_id" class="form-control form-control-sm" name="tipo_p_q_r_id"
                                        data_url="{{ route('admin-funcionario-asignacion_particular-cargar_motivo') }}">
                                        <option value="">---Seleccione---</option>
                                        @foreach ($tipos_pqr as $tipo_pqr)
                                            <option value="{{ $tipo_pqr->id }}">{{ $tipo_pqr->tipo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-12 col-md-6 d-none" id="motivo_pqr">
                                    <label class="requerido" for="motivo_id">Motivo</label>
                                    <select id="motivo_id" class="form-control form-control-sm" name="motivo_id"
                                        data_url="{{ route('admin-funcionario-asignacion_particular-cargar_sub_motivo') }}">
                                        <option value="">---Seleccione---</option>
                                    </select>
                                </div>
                                <div class="form-group col-12 col-md-6 d-none" id="sub_motivo_pqr">
                                    <label class="requerido" for="motivo_sub_id">Sub-Motivo</label>
                                    <select id="motivo_sub_id" class="form-control form-control-sm" name="motivo_sub_id">
                                        <option value="">---Seleccione---</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="d-none" id="hr_caja_area_conocimiento">
                    <div class="row d-none" id="caja_caracterizacion">
                        <div class="col-12"><h6><strong>Por caracterización de producto</strong></h6></div>
                        <div class="col-12">
                            <div class="row">
                                <div class="form-check col-12 col-md-2" id="cajacategoriasCheck">
                                    <input class="form-check-input check_clase" type="checkbox" value="" id="categoriasCheck">
                                    <label class="form-check-label" for="categoriasCheck">Categorias</label>
                                </div>
                                <div class="form-check col-12 col-md-2" id="cajaproductosCheck">
                                    <input class="form-check-input check_clase" type="checkbox" value="" id="productosCheck">
                                    <label class="form-check-label" for="productosCheck">Productos</label>
                                </div>
                                <div class="form-check col-12 col-md-2" id="cajamarcasCheck">
                                    <input class="form-check-input check_clase" type="checkbox" value="" id="marcasCheck">
                                    <label class="form-check-label" for="marcasCheck">Marcas</label>
                                </div>
                                <div class="form-check col-12 col-md-2" id="cajareferenciasCheck">
                                    <input class="form-check-input check_clase" type="checkbox" value="" id="referenciasCheck">
                                    <label class="form-check-label" for="referenciasCheck">Referencias</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12 col-md-6 d-none" id="categorias">
                                    <label class="requerido" for="categoria_id">Categoría de producto</label>
                                    <select id="categoria_id" class="form-control form-control-sm"
                                        data_url="{{ route('admin-funcionario-asignacion_particular-cargar_producto') }}"
                                        name="categoria_id">
                                        <option value="">---Seleccione---</option>
                                        @foreach ($categorias as $categoria)
                                            <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-12 col-md-6 d-none" id="productos">
                                    <label class="requerido" for="producto_id">Productos</label>
                                    <select id="producto_id" class="form-control form-control-sm" name="producto_id"
                                        data_url="{{ route('admin-funcionario-asignacion_particular-cargar_marca') }}">
                                        <option value="">---Seleccione primero una categoría---</option>
                                    </select>
                                </div>
                                <div class="form-group col-12 col-md-6 d-none" id="marcas">
                                    <label class="requerido" for="marca_id">Marcas</label>
                                    <select id="marca_id" class="form-control form-control-sm" name="marca_id"
                                        data_url="{{ route('admin-funcionario-asignacion_particular-cargar_referencia') }}">
                                        <option value="">---Seleccione primero un producto---</option>
                                    </select>
                                </div>
                                <div class="form-group col-12 col-md-6 d-none" id="referencias">
                                    <label class="requerido" for="referencia_id">Referencias</label>
                                    <select id="referencia_id" class="form-control form-control-sm" name="referencia_id">
                                        <option value="">---Seleccione primero una marca---</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="d-none" id="hr_caja_caracterizacion">
                    <div class="row d-none" id="caja_empleados">
                        <div class="col-12"><h6><strong>Por empleado</strong></h6></div>
                        <div class="col-12">
                            <div class="row">
                                <div class="form-check col-12 col-md-2" id="cajaempleadosCheck">
                                    <input class="form-check-input check_empleado" type="checkbox" value="" id="empleadosCheck">
                                    <label class="form-check-label" for="empleadosCheck">Empleados</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12 col-md-6 d-none" id="empleados">
                                    <label class="requerido" for="empleado_id">Empleados</label>
                                    <select
                                        id="empleado_id"
                                        class="form-control form-control-sm"
                                        name="empleado_id">
                                        <option value="">---Seleccione---</option>
                                        @foreach ($empleados as $empleado)
                                            <option value="{{ $empleado->id }}">{{ $empleado->nombre1 . ' ' . $empleado->nombre2 . ' ' . $empleado->apellido1 . ' ' . $empleado->apellido2}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="d-none" id="hr_caja_empleados">
                    <div class="row mt-3 mb-5">
                        <div class="col-12"><button class="btn btn-info btn-xs btn-sombra pl-5 pr-5">Cargar Graficos</button></div>
                    </div>
                </div>
            </form>
            <hr>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="d-none ml-2 mr-2" id="chartContainer" style="height: 600px; width: 100%;"></div>
                    </div>
                </div>
            </div>
            <hr class="d-none mt-3 mb-4" id="hr_tablas">
            <div class="row cajaTabla d-none" id="cajaTabla">
                <div class="col-12 text-center">
                    <h4 id="titulo_tabla"></h4>
                </div>
                <div class="col-12">
                    <table class="table table-striped table-hover table-sm tabla_data_table">
                        <thead class="thead-inverse">
                            <tr>
                                <th class="text-center" id="tituloTabla1" style="white-space:nowrap;">Item</th>
                                <th class="text-center" id="tituloTabla2" style="white-space:nowrap;">Mes</th>
                                <th class="text-center" id="tituloTabla3" style="white-space:nowrap;">Cantidad</th>
                            </tr>
                        </thead>
                        <tbody id="bodyTabla">
                            <tr>
                                <td class="text-center">Columna 1</td>
                                <td class="text-center">Val 1</td>
                                <td class="text-center">Val 1</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">

        </div>

    </div>
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('script_pagina')
<script src="{{ asset('js/intranet/analitica/porcantidad.js') }}"></script>
@endsection
<!-- ************************************************************* -->
