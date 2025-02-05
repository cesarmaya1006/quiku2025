@extends("intranet.layout.app")
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')
    @include('includes.funciones_php')
@endsection
<!-- Pagina CSS -->
@section('css_pagina')
    <link rel="stylesheet" href="{{ asset('css/intranet/parametros/cambios.css') }}">
@endsection
<!-- ************************************************************* -->
@section('tituloPagina')
    Parametros - Cambios en Argumentos
@endsection
<!-- ************************************************************* -->
@section('cuerpoPagina')
    <div class="card">
        @include('includes.error-form')
        @include('includes.mensaje')
        <div class="card-header">
            <div class="row mb-3">
                <div class="col-12 col-md-6 col-lg-6 text-md-left text-lg-left pl-2">
                    <h5>Comparación entre argumentos</h5>
                </div>
                <div class="col-12 col-md-6 col-lg-6 text-md-right text-lg-right pl-2 pr-md-5 pr-lg-5">
                    <a href="{{ route('wiku-index') }}" class="btn btn-success btn-xs btn-sm text-center pl-3 pr-3"
                        style="font-size: 0.9em;"><i class="fas fa-reply mr-2"></i> Volver</a>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12 col-md-6 p-3" style="border-right: 2px solid black">
                    <div class="row">
                        <div class="col-12 text-center"><strong><h6>Argumento Original</h6></strong></div>
                        <div class="col-12 mt-3 ">
                            <div class="row">
                                <div class="col-12"><p><strong>Área de conocimiento: </strong> {{ $argumento->temaEspecifico->tema_->area->area }}</p></div>
                                <div class="col-12"><p><strong>Tema: </strong> {{ $argumento->temaEspecifico->tema_->tema }}</p></div>
                                <div class="col-12"><p><strong>Tema Específico: </strong> {{ $argumento->temaespecifico->tema }}</p></div>
                                <div class="col-12"><p><strong>Fecha de Creación: </strong> {{ $argumento->fecha }}</p></div>
                                <div class="col-12"><p><strong>Tipo: </strong> {{ $argumento->publico ? 'Privado' : 'Publico' }}</p></div>
                                <div class="col-12"><p><strong>Autor(es): </strong> @if ($argumento->autorInst != null)
                                                                {{ $argumento->autorInst->institucion . ';' }}
                                                            @endif
                                                            @if ($argumento->autor != null)
                                                                {{ $argumento->autor->nombre1 .' ' .$argumento->autor->nombre2 .' ' .$argumento->autor->apellido1 .' ' .$argumento->autor->apellido2 }}

                                                            @endif</p></div>
                                <div class="col-12"><p style="text-align: justify;"><strong>Texto Principal: </strong> {!! $argumento->texto !!}</p></div>
                                <div class="col-12"><p><strong>Descripción del articulo: </strong> {{ $argumento->descripcion }}</p></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 p-3" style="border-left: 2px solid black">
                    <div class="row">
                        <div class="col-12 text-center"><strong><h6>Argumento Modificado</h6></strong></div>
                        <div class="col-12 mt-3 ">
                            <div class="row">
                                <div class="col-12"><p><strong>Área de conocimiento: </strong> {{ $argumento->cambios->where('wikuargumento_id',$argumento->id)->last()->temaEspecifico->tema_->area->area }}</p></div>
                                <div class="col-12"><p><strong>Tema: </strong> {{ $argumento->cambios->where('wikuargumento_id',$argumento->id)->last()->temaEspecifico->tema_->tema }}</p></div>
                                <div class="col-12"><p><strong>Tema Específico: </strong> {{ $argumento->cambios->where('wikuargumento_id',$argumento->id)->last()->temaespecifico->tema }}</p></div>
                                <div class="col-12"><p><strong>Fecha de Creación: </strong> {{ $argumento->cambios->where('wikuargumento_id',$argumento->id)->last()->fecha }}</p></div>
                                <div class="col-12"><p><strong>Tipo: </strong> {{ $argumento->cambios->where('wikuargumento_id',$argumento->id)->last()->publico ? 'Privado' : 'Publico' }}</p></div>
                                <div class="col-12"><p><strong>Autor(es): </strong> @if ($argumento->cambios->where('wikuargumento_id',$argumento->id)->last()->autorInst != null)
                                                                {{ $argumento->cambios->where('wikuargumento_id',$argumento->id)->last()->autorInst->institucion . ';' }}
                                                            @endif
                                                            @if ($argumento->cambios->where('wikuargumento_id',$argumento->id)->last()->autor != null)
                                                                {{ $argumento->cambios->where('wikuargumento_id',$argumento->id)->last()->autor->nombre1 .' ' .$argumento->cambios->where('wikuargumento_id',$argumento->id)->last()->autor->nombre2 .' ' .$argumento->cambios->where('wikuargumento_id',$argumento->id)->last()->autor->apellido1 .' ' .$argumento->cambios->where('wikuargumento_id',$argumento->id)->last()->autor->apellido2 }}

                                                            @endif</p></div>
                                <div class="col-12"><p style="text-align: justify;"><strong>Texto Principal: </strong> {!! $argumento->cambios->where('wikuargumento_id',$argumento->id)->last()->texto !!}</p></div>
                                <div class="col-12"><p><strong>Descripción del articulo: </strong> {{ $argumento->cambios->where('wikuargumento_id',$argumento->id)->last()->descripcion }}</p></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12 mt-3 mb-4 text-center">
                    <h5>Campos Cambiados</h5>
                </div>
                <div class="col-12">
                    <p style="text-align: justify;"><strong>Motivo de la solicitud: </strong>{{$argumento->cambios->where('wikuargumento_id',$argumento->id)->last()->observacion}}</p>
                </div>
                <div class="col-12 mt-2 mb-3">
                    <h6>Campos Cambiados:</h6>
                </div>
                <div class="col-12">
                    <ul>
                        @if ($argumento->temaEspecifico->tema_->area->area!=$argumento->cambios->where('wikuargumento_id',$argumento->id)->last()->temaEspecifico->tema_->area->area)
                            <li>
                                <p><strong>Área</strong></p>
                            </li>
                        @endif
                        @if ($argumento->temaEspecifico->tema_->tema!=$argumento->cambios->where('wikuargumento_id',$argumento->id)->last()->temaEspecifico->tema_->tema)
                            <li>
                                <p><strong>Tema</strong></p>
                            </li>
                        @endif
                        @if ($argumento->temaespecifico->tema!=$argumento->cambios->where('wikuargumento_id',$argumento->id)->last()->temaespecifico->tema)
                            <li>
                                <p><strong>Tema Específico</strong></p>
                            </li>
                        @endif
                        @if ($argumento->fecha!=$argumento->cambios->where('wikuargumento_id',$argumento->id)->last()->fecha)
                            <li>
                                <p><strong>Fecha de creación</strong></p>
                            </li>
                        @endif
                        @if ($argumento->publico!=$argumento->cambios->where('wikuargumento_id',$argumento->id)->last()->publico)
                            <li>
                                <p><strong>Tipo de Argumento</strong></p>
                            </li>
                        @endif
                        @if ($argumento->autorInst!=$argumento->cambios->where('wikuargumento_id',$argumento->id)->last()->autorInst)
                            <li>
                                <p><strong>Autor (es) Institucional (es)</strong></p>
                            </li>
                        @endif
                        @if ($argumento->autor!=$argumento->cambios->where('wikuargumento_id',$argumento->id)->last()->autor)
                            <li>
                                <p><strong>Autor(es) persona natural</strong></p>
                            </li>
                        @endif
                        @if ($argumento->texto!=$argumento->cambios->where('wikuargumento_id',$argumento->id)->last()->texto)
                            <li>
                                <p><strong>Texto Principal</strong></p>
                            </li>
                        @endif
                        @if ($argumento->descripcion!=$argumento->cambios->where('wikuargumento_id',$argumento->id)->last()->descripcion)
                            <li>
                                <p><strong>Descripción del articulo</strong></p>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <hr>
            <form action="{{ route('wiku_argumentos_cambios_aceptar', ['id' => $argumento->id]) }}" class="form-horizontal row" method="POST" autocomplete="off">
                @csrf
                @method('put')
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="aceptacion" id="aceptacion2" value="si" checked>
                        <label class="form-check-label" for="aceptacion2">
                          Aceptar Cambios
                        </label>
                      </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="aceptacion" id="aceptacion1" value="no">
                        <label class="form-check-label" for="aceptacion1">
                          Rechazar Cambios
                        </label>
                      </div>
                </div>
                <div class="col-12 form-group">
                    <label class="requerido" for="exampleFormControlInput1" class="form-label">Notas</label>
                    <div class="input-group">
                        <span class="input-group-text">Notas de aceptacion o rechazo</span>
                        <textarea class="form-control form-control-sm" name="edicion" rows="8" style="resize: none;" required></textarea>
                      </div>
                </div>
                <div class="col-12 mb-5 mt-4">
                    <button class="btn btn-primary btn-sobra btn-xs pl-5 pr-5" type="submit">Guardar</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modales -->
    <!-- Button trigger modal -->
    <!-- Modal -->

@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('script_pagina')
    <script src="{{ asset('js/intranet/parametros/cambios.js') }}"></script>
@endsection
<!-- ************************************************************* -->
