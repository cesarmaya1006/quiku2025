<div class="col-12 col-md-6 form-group">
    <label for="categoria_id">Categoría</label>
    <select class="form-control form-control-sm" name="categoria_id" id="categoria_id">
        @foreach ($categorias as $categoria)
            <option value="{{ $categoria->id }}" {{ isset($producto) ? ($categoria->id == $producto->categoria_id ? 'selected' : '') : '' }}>
                {{ $categoria->categoria }}</option>
        @endforeach
    </select>
    <small id="helpId" class="form-text text-muted">Producto</small>
</div>
<div class="col-12 col-md-6 form-group">
    <label for="producto">Producto</label>
    <input type="text" class="form-control form-control-sm" name="producto" id="producto" aria-describedby="helpId"
        value="{{ old('producto', $producto->producto ?? '') }}" placeholder="Nombre de producto" required>
    <small id="helpId" class="form-text text-muted">Producto</small>
</div>
