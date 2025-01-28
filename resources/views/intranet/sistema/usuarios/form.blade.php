<div class="row">
    <div class="col-12 col-md-3 form-group">
        <label for="rol_id" class="requerido">Rol de Usuario</label>
        <select name="rol_id[]" id="rol_id_form" class="form-control form-control-sm " required {{ isset($usuario_edit) ? 'disabled' : '' }}>
            <option value="">Elija un Rol</option>
            @foreach ($roles as $id => $name)
                <option value="{{ $id }}"
                    {{ is_array(old('rol_id')) ? (in_array($id, old('rol_id')) ? 'selected' : '') : (isset($usuario_edit) ? ($usuario_edit->roles->firstWhere('id', $id) ? 'selected' : '') : '') }}>
                    {{ $name }}</option>
            @endforeach
        </select>
    </div>

</div>
<div class="formFuncionariosCrear d-none">
    @include('intranet.funcionarios.funcionarios.form')
</div>
<div class="formUsuariosCrear d-none">
    @include('intranet.usuarios.usuarios.form')
</div>
