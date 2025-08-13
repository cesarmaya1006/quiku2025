@extends('theme.back.plantilla')
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')
    @include('includes.funciones_php')
@endsection
<!-- Pagina CSS -->
@section('estilosHojas')
    <!--<link rel="stylesheet" href="{{ asset('css/intranet/index.css') }}"> -->
@endsection
<!-- ************************************************************* -->
@section('tituloHoja')
    Analítica
@endsection
<!-- ************************************************************* -->
@section('cuerpo_pagina')
    <div class="card">
        @include('includes.error-form')
        @include('includes.mensaje')
        <div class="card-header">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h1 class="m-0">DashBoard Analítica</h1>
                </div>
                <div class="col-12 col-sm-6">
                    <a href="{{ route('analitica-cantidad') }}"
                       class="btn btn-info btn-sm btn-sombra pl-3 pr-3 float-end"
                       style="font-size: 0.9em;">
                       <i class="fas fa-plus-circle mr-2"></i> Analítica especifica
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body pb-3">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-12">
                        <h3>Cantidad de PQRs por tipo</h3>
                    </div>
                </div>
                <div class="row">
                    @foreach ($tipospqr as $tipopqr)
                    <div class="col-lg-3 col-6">
                        <div class="small-box {{$tipopqr->bg_color}}">
                            <div class="inner">
                                <h3>{{$tipopqr->pqrs->count()}}</h3>
                                <p>PQR por {{$tipopqr->tipo}}</p>
                            </div>
                            <div class="icon">
                                <i class="far fa-folder-open"></i>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <hr>
                <div class="row mt-5 mb-4">
                    <div class="col-12 col-md-6">
                        <div id="cantPqrs" style="height: 300px; width: 100%;"></div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div id="cantMeses" style="height: 300px; width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">

        </div>

    </div>
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('scripts_pagina')
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script type="text/javascript">
        $(function() {
            var chart = new CanvasJS.Chart("cantPqrs", {
                theme: "theme2",
                animationEnabled: true,
                title: {
                    text: "Pqr's por cantidad general"
                },
                data: [{
                    type: "pie",
                    indexLabel: "{label} ({y})",
                    dataPoints: <?php echo json_encode($data, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();
        });
        $(function() {
            var chart = new CanvasJS.Chart("cantMeses", {
                theme: "light2",
                title: {
                    text: "Prq por Meses"
                },
                axisX:{
                    title: "Mes"
                },
                data: [{
                    type: "line",
                    yValueFormatString: "#,##0.0#",
                    toolTipContent: "{y}",
                    dataPoints: <?php echo json_encode($data_mes, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();
        });
    </script>
    <!-- <script src="{{ asset('js/canvas/jquery-1.11.1.min.js') }}"></script> -->
    <!-- <script src="{{ asset('js/canvas/jquery.canvasjs.min.js') }}"></script> -->
    <!-- <script src="{{ asset('js/intranet/analitica/analitica.js') }}"></script> -->
@endsection
<!-- ************************************************************* -->
