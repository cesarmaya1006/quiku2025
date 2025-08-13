<div class="container-fluid">
    <div class="row">
        @foreach ($roles as $rol)
            <div class="col-12 col-sm-6 col-md-3">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $rol->cantUsers }}</h3>
                        <p>{{ $rol->name }}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-friends"></i>
                    </div>
                    <a href="{{ route('admin.usuario.index') }}" class="small-box-footer">Mas Información <i
                            class="fas fa-user-friends"></i></a>
                </div>
            </div>
        @endforeach
    </div>
    <hr>
    <div class="row mt-4">
        @foreach ($estadospqr as $estado)
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon {{ $estado->bg }} elevation-1"><i class="fas fa-file"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ $estado->estado_funcionario }}</span>
                        <span class="info-box-number">{{ $estado->pqrs->count() }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <hr>
    <div class="row mt-4">
        <div class="col-12">
            <h2>Empleados con mas PQR Activas</h2>
        </div>
        <div class="col-12">
            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        </div>
    </div>
</div>
<script>
    window.onload = function() {

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "10 Empleados con mas PQR Activas"
            },
            axisY: {
                title: "Cant PQRs"
            },
            data: [{
                type: "column",
                yValueFormatString: "#,##0.## Pqrs",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

    }
</script>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
