<input type="hidden" name="tipo" value="actualizacion">
<input type="hidden" name="wikuargumento_id" value="{{$argumento->id}}">
<div class="row mt-3">
    @if ($temasEspecifico->count() > 0)
        <div class="form-group col-12 col-md-6">
            <label class="requerido" for="area_id">Área</label>
            <select class="form-control form-control-sm" id="area_id" data_url="{{ route('cargar_temas') }}" required>
                <option value="">---Seleccione---</option>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}" {{ $area->id == $argumento->temaEspecifico->tema_->area_id ? 'selected' : ''}}>
                        {{ $area->area }}</option>
                @endforeach
            </select>
            <small id="helpId" class="form-text text-muted">Área</small>
        </div>
        <div class="form-group col-12 col-md-6">
            <label class="requerido" for="tema_id">Tema</label>
            <select class="form-control form-control-sm" id="tema_id" data_url="{{ route('cargar_temasespec') }}"
                required>
                    <option value="">---Seleccione---</option>
                    @foreach ($argumento->temaEspecifico->tema_->area->temas as $tema)
                        <option value="{{ $tema->id }}"
                            {{ $tema->id == $argumento->temaEspecifico->tema_id ? 'selected' : '' }}>
                            {{ $tema->tema }}</option>
                    @endforeach
            </select>
            <small id="helpId" class="form-text text-muted">Tema</small>
        </div>
        <div class="form-group col-12 col-md-6">
            <label class="requerido" for="wikutemaespecifico_id">Tema Específico</label>
            <select class="form-control form-control-sm" name="wikutemaespecifico_id" id="wikutemaespecifico_id"
                required>
                    <option value="">---Seleccione---</option>
                    @foreach ($argumento->temaEspecifico->tema_->temasespecificos as $temaespecif)
                        <option value="{{ $temaespecif->id }}" {{ $temaespecif->id == $argumento->wikutemaespecifico_id ? 'selected' :'' }}>
                            {{ $temaespecif->tema }}</option>
                    @endforeach
                
            </select>
            <small id="helpId" class="form-text text-muted">Tema Específico</small>
        </div>
    @endif
</div>
<hr>
<div class="row">
    <div class="form-check col-12 col-md-3">
        <input class="form-check-input" type="checkbox" value="1" name="publico" id="publico" {{ $argumento->publico?'checked':''}}>
        <label class="form-check-label" for="publico">
            Publico
        </label>
        <span>
            <p class="text-justify" id="advertencia" style="font-size:0.8em;">Al marcar el elemento como público
                autoriza
                expresamente el uso sin ninguna
                restricción ni derechos de autor para cualquier usuario de Quiku dentro o fuera de su organización.
            </p>
        </span>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label class="requerido" for="fecha">Fecha de creación</label>
        <input type="date" class="form-control form-control-sm" name="fecha" id="fecha" max="{{ date('Y-m-d') }}"
            value="{{ old('fecha', $argumento->fecha ?? date('Y-m-d')) }}" required>
        <small id="helpId" class="form-text text-muted">Fecha de creación</small>
    </div>
    <div class="col-12 col-md-6">
        <div class="row">
            <div class="col-12 d-none" id="cajainstitucion">
                <label id="labelinstitucion" class="requerido" for="wikuautorinstitu_id">Autor
                    Institucional</label>
                <div class="input-group mb-3">
                    <select class="form-control form-control-sm" id="wikuautorinstitu_id" name="wikuautorinstitu_id"
                        data_url="{{ route('cargar_temas') }}">
                        <option value="">---Seleccione---</option>
                        @foreach ($autoresInst as $autorI)
                            <option 
                                value="{{ $autorI->id }}"
                                {{$argumento->wikuautorinstitu_id==$autorI->id?'selected':''}}
                                >
                                {{ $autorI->institucion }}
                            </option>
                        @endforeach
                    </select>
                    <div class="input-group-append d-flex align-items-center">
                        <a class="btn btn-info btn-sm" id="nuevoAutorInst"><i class="fa fa-plus-circle"
                                aria-hidden="true" style="cursor: pointer;"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-12" id="cajaautorpersona">
                <label id="labelautorpersona" class="requerido" for="wikuautores_id">Autor</label>
                <div class="input-group mb-3">
                    <select class="form-control form-control-sm" id="wikuautores_id" name="wikuautores_id"
                        data_url="{{ route('cargar_temas') }}">
                        <option value="">---Seleccione---</option>
                        @foreach ($autores as $autor)
                            <option value="{{ $autor->id }}" {{$argumento->wikuautores_id==$autor->id?'selected':''}}>
                                {{ $autor->nombre1 . ' ' . $autor->nombre2 . ' ' . $autor->apellido1 . ' ' . $autor->apellido2 }}
                            </option>
                        @endforeach
                    </select>
                    <div class="input-group-append d-flex align-items-center">
                        <a class="btn btn-info btn-sm" id="nuevoAutor"><i class="fa fa-plus-circle" aria-hidden="true"
                                style="cursor: pointer;"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex flex-row justify-content-around">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="autortipo" id="checkinstitucion"
                        value="checkinstitucion">
                    <label class="form-check-label" for="checkinstitucion">
                        Autor Institucional
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="autortipo" id="checkautorpersona"
                        value="checkautorpersona" checked>
                    <label class="form-check-label" for="checkautorpersona">
                        Autor persona natural
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-12 col-md-6 form-group">
        <label class="requerido" for="texto">Texto Principal</label>
        <textarea name="texto" id="texto" class="form-control form-control-sm textoPrincipal" cols="30" rows="5"
            style="resize: none;" required>{{ $argumento->texto }}</textarea>
        <small id="helpId" class="form-text text-muted">Texto Principal</small>
    </div>
    <div class="col-12 col-md-6 form-group">
        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" id="descripcion" class="form-control form-control-sm" cols="30" rows="5"
            style="resize: none;">{{ $argumento->descripcion }}</textarea>
        <small id="helpId" class="form-text text-muted">Descripción</small>
    </div>
</div>
<div class="row">
    <div class="col-12"><label class="requerido" for="observacion">Motivo de la solicitud</label></div>
    <div class="col-12">
        <textarea name="observacion" id="observacion" class="form-control form-control-sm" cols="30" rows="5" style="resize: none;" required></textarea>
    </div>
</div>
