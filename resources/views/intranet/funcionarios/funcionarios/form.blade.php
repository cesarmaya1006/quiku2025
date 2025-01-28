<div class="row">
    <div class="col-12 col-md-3 form-group departamentoGroup">
        <label for="departamento_id" class="requerido">Departamento</label>
        <select id="departamento_id" class="form-control form-control-sm " data_url="{{route('municipio.getMunicipiosByDpto')}}" required>
            <option value="">Elija un Departamento</option>
            @foreach ($departamentos as $id => $departamento)
                <option value="{{ $departamento->id }}"
                    {{ is_array(old('departamento_id')) ? (in_array($id, old('departamento_id')) ? 'selected' : '') : (isset($usuario_edit) ? ($usuario_edit->sede->municipio->departamento_id==$id ? 'selected' : '') : '') }}>
                    {{ $departamento->departamento }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-12 col-md-3 form-group municipioGroup">
        <label for="municipio_id" class="requerido">Municipio</label>
        <select id="municipio_id" class="form-control form-control-sm" data_url="{{route('sede.getSedesByMunicipios')}}" required>
            <option value="">Elija primero un departamento</option>
        </select>
    </div>
    <div class="col-12 col-md-3 form-group municipioGroup">
        <label for="sede_id" class="requerido">Sede</label>
        <select id="sede_id" name="sede_id" class="form-control form-control-sm " required>
            <option value="">Elija primero un Municipio</option>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-3 form-group departamentoGroup">
        <label for="area_id" class="requerido">Área</label>
        <select id="area_id" class="form-control form-control-sm" data_url="{{route('nivel.getNivelesByArea')}}" required>
            <option value="">Elija un Área</option>
            @foreach ($areas as $id => $area)
                <option value="{{ $area->id }}"
                    {{ is_array(old('area_id')) ? (in_array($id, old('area_id')) ? 'selected' : '') : (isset($usuario_edit) ? ($usuario_edit->area_id==$id ? 'selected' : '') : '') }}>
                    {{ $area->area }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-12 col-md-3 form-group municipioGroup">
        <label for="nivel_id" class="requerido">Nivel</label>
        <select id="nivel_id" class="form-control form-control-sm" data_url="{{route('cargo.getCargosByNivel')}}" required>
            <option value="">Elija primero un área</option>
        </select>
    </div>
    <div class="col-12 col-md-3 form-group municipioGroup">
        <label for="cargo_id" class="requerido">Cargo</label>
        <select id="cargo_id" name="cargo_id" class="form-control form-control-sm " required>
            <option value="">Elija primero un Nivel</option>
        </select>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-10 col-md-3 form-group">
        <label for="docutipos_id" class="requerido">Tipo Documento</label>
        <select name="docutipos_id" id="docutipos_id" class="form-control form-control-sm " required>
            <option value="">Tipo de Documento</option>
            @foreach ($tiposdocu as $tipo_docu)
                <option value="{{ $tipo_docu->id }}"
                    {{ is_array(old('docutipos_id')) ? (in_array($tipo_docu->id, old('docutipos_id')) ? 'selected' : '') : (isset($usuario_edit) ? ($usuario_edit->docutipos_id == $tipo_docu->id ? 'selected' : '') : '') }}>
                    {{ $tipo_docu->abreb_id }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-10 col-md-3 form-group">
        <label for="identificacion" class="requerido">N° de Identificación</label>
        <input type="text" class="form-control form-control-sm " id="identificacion" name="identificacion"
            placeholder="N° de Identificación de  del Usuario"
            value="{{ old('identificacion', $usuario_edit->identificacion ?? '') }}" required>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-3 form-group">
        <label for="nombre1" class="requerido">Primer Nombre</label>
        <input type="text" class="form-control form-control-sm " id="nombre1" name="nombre1" placeholder="Primer Nombre" value="{{ old('nombre1', $usuario_edit->empleado->nombre1 ?? '') }}" required>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label for="nombre2" class="requerido">Segundo Nombre</label>
        <input type="text" class="form-control form-control-sm " id="nombre2" name="nombre2" placeholder="Segundo Nombre" value="{{ old('nombre2', $usuario_edit->empleado->nombre2 ?? '') }}" >
    </div>
    <div class="col-12 col-md-3 form-group">
        <label for="apellido1" class="requerido">Primer Apellido</label>
        <input type="text" class="form-control form-control-sm " id="apellido1" name="apellido1" placeholder="Primer Apellido" value="{{ old('apellido1', $usuario_edit->empleado->apellido1 ?? '') }}" required>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label for="apellido2" class="requerido">Segundo Apellido</label>
        <input type="text" class="form-control form-control-sm " id="apellido2" name="apellido2" placeholder="Segundo Apellido" value="{{ old('apellido2', $usuario_edit->empleado->apellido2 ?? '') }}" >
    </div>
    <div class="col-12 col-md-3 form-group">
        <label for="fecha_nacimiento" class="requerido">Fecha de nacimiento</label>
        <input type="date" class="form-control form-control-sm" name="fecha_nacimiento" id="fecha_nacimiento" max="{{date("Y-m-d",strtotime(date('Y-m-d')."- 18 year"))}}" value="{{isset($usuario_edit)?$usuario_edit->empleado->fecha_nacimiento:null}}">
    </div>
    <div class="col-12 col-md-3 form-group">
        <label for="genero" class="requerido">Identidad de género</label>
        <select class="form-select form-control form-control-sm" aria-label="Default select example" id="genero" name="genero" required>
            <option selected>Seleccione su identidad de género</option>
            <option value="Masculino" {{isset($usuario_edit)&& $usuario_edit->empleado->genero == 'Masculino'? 'selected' :''}}>Masculino</option>
            <option value="Femenino" {{isset($usuario_edit)&& $usuario_edit->empleado->genero == 'Femenino'? 'selected' :''}}>Femenino</option>
            <option value="No binario" {{isset($usuario_edit)&& $usuario_edit->empleado->genero == 'No binario'? 'selected' :''}}>No binario</option>
            <option value="Otro" {{isset($usuario_edit)&& $usuario_edit->empleado->genero == 'Otro'? 'selected' :''}}>Otro</option>
        </select>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label for="email" class="requerido">Correo Electrónico</label>
        <input type="email" class="form-control form-control-sm " id="email" name="email" placeholder="Correo Electrónico" value="{{ old('email', $usuario_edit->email ?? '') }}" required>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label for="telefono_celu" class="requerido">Teléfono</label>
        <input type="text" class="form-control form-control-sm " id="telefono_celu" name="telefono_celu" placeholder="Teléfono" value="{{ old('telefono_celu', $usuario_edit->empleado->telefono_celu ?? '') }}" required>
    </div>
    <div class="col-12 col-md-6 form-group">
        <label for="direccion" class="requerido">Dirección</label>
        <input type="text" class="form-control form-control-sm " id="direccion" name="direccion" placeholder="Dirección" value="{{ old('direccion', $usuario_edit->empleado->direccion ?? '') }}" required>
    </div>
    @if (!isset($usuario_edit))
        <div class="col-10 col-md-3 form-group float-none">
            <label for="password" class="requerido">Contraseña</label>
            <input type="password" class="form-control form-control-sm " id="password" name="password" required>
            <small id="helpId" class="form-text text-muted">Contraseña</small>
        </div>
        <div class="col-10 col-md-3 form-group float-left">
            <label for="re_password" class="requerido">Confirmaci&oacute;n Contraseña</label>
            <input type="password" class="form-control form-control-sm " id="re_password" name="re_password" required>
            <small id="helpId" class="form-text text-muted">Confirmaci&oacute;n Contraseña</small>
        </div>
    @endif
</div>
