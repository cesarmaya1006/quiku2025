<div class="col-12">
    <div class="row">
        @foreach ($pqr->tipoPqr->asociacionargumento as $argumento)
            <div class="col -12 col-md-10">
                <div class="resultado-busqueda card card-success bg-legal1 collapsed-card card-mini-sombra">
                    <div class="card-header">
                        <div class="user-block">
                            <span class="username"><a href="#">Argumento</a></span>
                            <span
                                class="description text-white"> {{ $argumento->temaEspecifico->tema_->area['area'] . '->' . $argumento->temaEspecifico->tema_['tema'] . '->' . $argumento->temaEspecifico['tema'] }}</span>
                        </div>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-plus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <p><strong>Texto:</strong></p>
                                <div class="textoCopiar">{!! $argumento['texto'] !!} </div>
                            </div>
                        </div>
                        <div class="row">
                            @if ($argumento->criterios->count() > 0)
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <h6>Criterios Juridicos</h6>
                                    </div>
                                    <div class="col-12 table-responsive" style="font-size:0.8em;">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th style="white-space:nowrap">Autor(es)</th>
                                                    <th style="white-space:nowrap">Criterios jurídicos de aplicación
                                                    </th>
                                                    <th style="white-space:nowrap">Criterios jurídicos de no aplicación
                                                    </th>
                                                    <th style="white-space:nowrap">Notas de la Vigencia</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($argumento->criterios as $criterio)
                                                    <tr>
                                                        <td style="white-space:nowrap">' + criterio['autores'] + '</td>
                                                        @if ($criterio['criterio_si'] != null)
                                                            <td>{{ $criterio['criterio_si'] }}</td>
                                                        @else
                                                            <td class="text-center">---</td>
                                                        @endif
                                                        @if ($criterio['criterio_no'] != null)
                                                            <td>{{ $criterio['criterio_no'] }}</td>
                                                        @else
                                                            <td class="text-center">---</td>
                                                        @endif
                                                        @if ($criterio['notas'] != null)
                                                            <td>{{ $criterio['notas'] }}</td>
                                                        @else
                                                            <td class="text-center">---</td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                                <div class="col-12 text-center">
                                    <p><strong>Sin criterios jurídicosss</strong></p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer ">
                        <div class="row">
                            <div class="col-12">
                                <button class="btn btn-info btn-xs pl-4 pr-4 agregarTexto">Agregar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
