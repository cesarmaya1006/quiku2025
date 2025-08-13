<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h1 class="m-0">DashBoard Analítica</h1>
            </div>
            <div class="col-12 col-sm-6">
                <a href="{{ route('analitica-cantidad') }}" class="btn btn-info btn-sm btn-sombra pl-3 pr-3 float-end" style="font-size: 0.9em;">
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
